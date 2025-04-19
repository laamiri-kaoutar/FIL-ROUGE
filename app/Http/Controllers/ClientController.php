<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Category;
use App\Models\Favorite;
use Illuminate\Http\Request;
use App\Repositories\ServiceRepository;

class ClientController extends Controller
{
    protected $serviceRepository;

    public function __construct(ServiceRepository $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
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
    $user = auth()->user();
    $service = $this->serviceRepository->find($id);

    $favorite = Favorite::where('user_id', $user->id)->where('service_id', $service->id)->first();

    if ($favorite) {
        $favorite->delete();
        $isFavorited = false;
    } else {
        Favorite::create(['user_id' => $user->id, 'service_id' => $service->id]);
        $isFavorited = true;
    }

    return response()->json(['isFavorited' => $isFavorited]);
}

public function storeReview(Request $request, $id)
{
    $request->validate([
        'rating' => 'required|numeric|min:1|max:5',
        'comment' => 'nullable|string|max:1000',
    ]);

    $user = auth()->user();
    $service = $this->serviceRepository->find($id);

    // Check if user has already reviewed this service
    if ($service->reviews()->where('user_id', $user->id)->exists()) {
        return redirect()->back()->with('error', 'You have already reviewed this service.');
    }

    Review::create([
        'service_id' => $service->id,
        'user_id' => $user->id,
        'rating' => $request->rating,
        'comment' => $request->comment,
    ]);

    // Update service rating and reviews_count
    $service->update([
        'rating' => $service->reviews()->avg('rating') ?? 0,
        'reviews_count' => $service->reviews()->count(),
    ]);

    return redirect()->back()->with('success', 'Review submitted successfully!');
}
   
}