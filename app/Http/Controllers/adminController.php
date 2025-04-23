<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\OrderRepositoryInterface;
use App\Interfaces\ReviewRepositoryInterface;
use App\Interfaces\SignalRepositoryInterface;
use Spatie\Browsershot\Browsershot;


class adminController extends Controller
{
    protected $signalRepository;
    protected $reviewRepository;
    protected $userRepository;
    protected $orderRepository;
    
    public function __construct(SignalRepositoryInterface $signalRepository , ReviewRepositoryInterface $reviewRepository , UserRepositoryInterface $userRepository ,OrderRepositoryInterface $orderRepository)
    {
        $this->signalRepository = $signalRepository;
        $this->reviewRepository = $reviewRepository;
        $this->userRepository = $userRepository;
        $this->orderRepository = $orderRepository;
    }
   public function dashboard(){
    return view('admin.dashboard');

   }

   public function services(){
    return view('admin.services');
   }


   public function signals()
    {
        $signals = $this->signalRepository->getAllWithRelations();
        return view('admin.signals', compact('signals'));
    }

    public function dismissSignal($id)
    {
        $this->signalRepository->deleteById($id);
        return redirect()->route('admin.signals')->with('success', 'Signal dismissed successfully.');
    }

    public function deleteReviewFromSignal($id)
    {
        $this->signalRepository->deleteReviewFromSignal($id);
        return redirect()->route('admin.signals')->with('success', 'Review deleted successfully.');
    }

    public function reviews()
    {
        $reviews = $this->reviewRepository->getAllWithRelations();
        return view('admin.reviews', compact('reviews'));
    }

    public function deleteReview($id)
    {
        $this->reviewRepository->deleteById($id);
        return redirect()->route('admin.reviews')->with('success', 'Review deleted successfully.');
    }

    public function users(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status', 'All Statuses');

        $users = $this->userRepository->getAllWithFilters($search, $status);
        $totalUsers = User::count();
        $totalFreelancers = User::join('roles', 'users.role_id', '=', 'roles.id')
        ->where('roles.name', 'Freelancer')
        ->count();
    
        $totalClients = User::join('roles', 'users.role_id', '=', 'roles.id')
        ->where('roles.name', 'Client')
        ->count();
    
      
        $bannedUsers = User::where('status', 'Banned')->count();

        return view('admin.account-validation', compact('users', 'totalUsers', 'totalFreelancers', 'totalClients', 'bannedUsers'));
    }

    public function suspendUser($id)
    {
        $this->userRepository->updateStatus($id, 'Suspended');
        return redirect()->route('admin.users')->with('success', 'User suspended successfully.');
    }

    public function banUser($id)
    {
        $this->userRepository->updateStatus($id, 'Banned');
        return redirect()->route('admin.users')->with('success', 'User banned successfully.');
    }

    public function unbanUser($id)
    {
        $this->userRepository->updateStatus($id, 'Active');
        return redirect()->route('admin.users')->with('success', 'User unbanned successfully.');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }

    public function orders(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status', 'All Statuses');

        $orders = $this->orderRepository->getAllWithFilters($search, $status);

        return view('admin.orders', compact('orders'));
    }

    public function exportOrders(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status', 'All Statuses');

        $orders = $this->orderRepository->getAllWithFilters($search, $status, PHP_INT_MAX); 
        $html = view('admin.orders-export', compact('orders'))->render();

        $pdf = Browsershot::html($html)
            ->setOption('landscape', false)
            ->setOption('margin', ['top' => '20mm', 'right' => '20mm', 'bottom' => '20mm', 'left' => '20mm'])
            ->pdf();

        return response($pdf)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="orders-report-' . now()->format('Y-m-d-H-i-s') . '.pdf"');
    }
}
