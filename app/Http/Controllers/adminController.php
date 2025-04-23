<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\ReviewRepositoryInterface;
use App\Interfaces\SignalRepositoryInterface;

class adminController extends Controller
{
    protected $signalRepository;
    protected $reviewRepository;
    protected $userRepository;


    public function __construct(SignalRepositoryInterface $signalRepository , ReviewRepositoryInterface $reviewRepository , UserRepositoryInterface $userRepository)
    {
        $this->signalRepository = $signalRepository;
        $this->reviewRepository = $reviewRepository;
        $this->userRepository = $userRepository;
    }
   public function dashboard(){
    return view('admin.dashboard');

   }

   public function services(){
    return view('admin.services');
   }

   
   public function orders(){
    return view('admin.orders');
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
}
