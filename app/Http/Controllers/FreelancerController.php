<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\OrderRepositoryInterface;

class FreelancerController extends Controller
{

    protected $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function dashboard()
    {
        $user = Auth::user();

        $activeServicesCount = $user->services()->where('status', 'active')->count();
        $pendingOrdersCount = $this->orderRepository->countPendingOrdersForFreelancer($user->id);
        $lastTransaction = $this->orderRepository->getLastTransactionForFreelancer($user->id);
        $totalEarnings = $this->orderRepository->getTotalEarningsForFreelancer($user->id);

        $activeServices = $user->services()->where('status', 'active')->take(3)->get();
        $recentOrders = $this->orderRepository->getRecentOrdersForFreelancer($user->id);

        $earningsOverTime = $this->orderRepository->getEarningsOverTimeForFreelancer($user->id);
        return view('freelancer.dashboard', compact(
            // 'user',
            'activeServicesCount',
            'pendingOrdersCount',
            'lastTransaction',
            'totalEarnings',
            'activeServices',
            'recentOrders',
            'earningsOverTime'
        ));
    }

    public function orders()
    {
        $freelancerId = auth()->id();
        $orders = $this->orderRepository->getFreelancerOrders($freelancerId);

        return view('freelancer.orders', compact('orders'));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $order = \App\Models\Order::findOrFail($id);

        if ($order->service->user_id !== auth()->id()) {
            return redirect()->route('freelancer.orders')->with('error', 'Unauthorized action.');
        }

        $order->status = $request->status;
        $order->save();

        return redirect()->route('freelancer.orders')->with('success', 'Order status updated successfully.');
    }
}
