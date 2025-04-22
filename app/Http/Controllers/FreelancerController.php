<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\OrderRepositoryInterface;

class FreelancerController extends Controller
{

    protected $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
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
