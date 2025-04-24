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

        // Stats Cards Data
        $activeServicesCount = $user->services()->where('status', 'active')->count();
        $pendingOrdersCount = Order::whereHas('service', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->where('status', 'pending')->count();
        $lastTransaction = Order::whereHas('service', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->where('status', 'completed')->latest()->first();
        $totalEarnings = Order::whereHas('service', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->where('status', 'completed')->sum('amount');

        // Service Overview Data
        $activeServices = $user->services()->where('status', 'active')->take(3)->get();
        $recentOrders = Order::whereHas('service', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->latest()->take(3)->get();

        // Earnings Over Time (last 30 days)
        $earningsOverTime = Order::selectRaw('DATE(created_at) as date')
            ->selectRaw('SUM(amount) as total_amount')
            ->whereHas('service', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            // ->where('status', 'completed')
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

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
