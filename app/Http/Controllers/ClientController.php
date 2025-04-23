<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Category;
use App\Models\Favorite;
use Illuminate\Http\Request;
use App\Services\InvoiceService;
use App\Services\PaymentService;
use App\Repositories\OrderRepository;
use App\Repositories\ServiceRepository;
use App\Interfaces\ReviewRepositoryInterface;

class ClientController extends Controller
{
    protected $serviceRepository;
    protected $orderRepository;
    protected $paymentService;
    protected $invoiceService;
    protected $reviewRepository;

    public function __construct(
        ServiceRepository $serviceRepository,
        OrderRepository $orderRepository,
        PaymentService $paymentService,
        InvoiceService $invoiceService,
        ReviewRepositoryInterface $reviewRepository
    ) {
        $this->serviceRepository = $serviceRepository;
        $this->orderRepository = $orderRepository;
        $this->paymentService = $paymentService;
        $this->invoiceService = $invoiceService;
        $this->reviewRepository = $reviewRepository;
    }

    public function services(Request $request)
    {
        $query = $request->input('query');
        $category = $request->input('category');
        $sort = $request->input('sort', 'recommended');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');

        $services = $this->serviceRepository->all($query, $category ? (int)$category : null, $minPrice ? (float)$minPrice : null, $maxPrice ? (float)$maxPrice : null, $sort);
        $categories = Category::all();

        return view('client.services', compact('services', 'categories'));
    }

    public function show($id)
    {
        $service = $this->serviceRepository->find($id);
        return view('client.service-show', compact('service'));
    }

    public function toggleFavorite(Request $request, $id)
    {
        // dd($id);
        $favorite = Favorite::where('user_id', auth()->id())->where('service_id', $id)->first();
        // dd($favorite);

        if ($favorite) {
            $favorite->delete();
            $isFavorited = false;
        } else {
            Favorite::create(['user_id' =>auth()->id(), 'service_id' => $id]);
            $isFavorited = true;
        }
        $referrer = request()->headers->get('referer');

        if (str_contains($referrer, route('client.favorites'))) {
            return redirect()->route('client.favorites')->with('success', 'Removed from favorites successfully!');
        }


        return response()->json(['isFavorited' => $isFavorited]);
    }

    public function storeReview(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);
        $service = $this->serviceRepository->find($id);

        if ($service->reviews()->where('user_id',  auth()->id())->exists()) {
            return redirect()->back()->with('error', 'You have already reviewed this service.');
        }

        Review::create([
            'service_id' => $service->id,
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        $this->serviceRepository->updateRating($id);

        return redirect()->back()->with('success', 'Review submitted successfully!');
    }

    public function editReview($service_id, $review_id)
    {
        $review = Review::findOrFail($review_id);
        if ($review->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return response()->json([
            'rating' => $review->rating,
            'comment' => $review->comment,
        ]);
    }

    public function updateReview(Request $request, $service_id, $review_id)
    {
        $review = Review::findOrFail($review_id);

        if ($review->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $review->update($validated);
        $this->serviceRepository->updateRating($service_id);
        // dd("untell now evry thing is fine ");

        $referrer = request()->headers->get('referer');

        if (str_contains($referrer, route('client.reviews'))) {
            return redirect()->route('client.reviews')->with('success', 'Review updated successfully!');
        }
        return redirect()->route('client.services.show', $service_id)->with('success', 'Review updated successfully!');
    }

    public function deleteReview($service_id, $review_id)
    {
        $review = Review::findOrFail($review_id);
    
        if ($review->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
    
        $review->delete();
        $this->serviceRepository->updateRating($service_id);
        // dd("untell now evry thing is fine ");

        $referrer = request()->headers->get('referer');

        if (str_contains($referrer, route('client.reviews'))) {
            return redirect()->route('client.reviews')->with('success', 'Review updated successfully!');
        }

        return redirect()->route('client.services.show', $service_id)->with('success', 'Review deleted successfully!');
    }

    public function showPaymentPage(Request $request, $service_id)
    {
        $service = $this->serviceRepository->find($service_id);
        $package_id = $request->query('package_id');
        $package = $service->packages()->findOrFail($package_id);
        return view('client.payment', compact('service', 'package'));
    }


    
    public function processPayment(Request $request)
    {
        $request->validate([
            'stripeToken' => 'required',
            'service_id' => 'required|exists:services,id',
            'package_id' => 'required|exists:service_packages,id',
        ]);
        $service = $this->serviceRepository->find($request->service_id);
        $package = $service->packages()->findOrFail($request->package_id);
        // dd(config('services.stripe.secret'));
        try {
            $charge = $this->paymentService->charge($package->price, $request->stripeToken);
            // dd($charge);
            $order = $this->orderRepository->create([ 
                'user_id' => auth()->id(),
                'service_id' => $service->id,
                'package_id' => $package->id,
                'amount' => $package->price,
                'stripe_transaction_id' => $charge->id,
            ]);
            return redirect()->route('client.order_confirmation', $order->id)->with('success', 'Payment completed successfully!');
        } catch (\Exception $e) {
            dd("this is the error : ".$e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function orderConfirmation($order_id)
    {
        $order = $this->orderRepository->find($order_id);
        if ($order->user_id !== auth()->id()) { abort(403, 'Unauthorized action.');}
        return view('client.order-confirmation', compact('order'));
    }
    public function downloadInvoice($order_id)
    {
        $order = $this->orderRepository->find($order_id);
    
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
    
        return $this->invoiceService->generateInvoice($order);
    }

    public function orders()
    {
        $orders = $this->orderRepository->getUserOrders();
        return view('client.orders', compact('orders'));
    }

    public function reviews()
    {
        $reviews = $this->reviewRepository->getUserReviews(auth()->id());
        $completedOrders = $this->reviewRepository->getCompletedOrdersWithoutReviews(auth()->id());

        return view('client.reviews', compact('reviews', 'completedOrders'));
    }
    public function favorites()
    {
        $favorites = auth()->user()->favorites()
            ->with(['user', 'category', 'tags', 'reviews'])
            ->get();
    
        return view('client.favorites', compact('favorites'));
    }
   
}