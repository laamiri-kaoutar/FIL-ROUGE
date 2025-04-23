<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    public function create(array $data)
    {
        return Order::create($data);
    }

    public function find(int $id)
    {
        return Order::with(['user', 'service', 'package'])->findOrFail($id);
    }

    public function getUserOrders()
    {
        return Order::where('user_id','=', Auth::id())->with(['service.user', 'package'])->get();
    }

    public function getFreelancerOrders($freelancerId)
    {
        return Order::whereHas('service', function ($query) use ($freelancerId) {
            $query->where('user_id', $freelancerId);
        })
        ->with(['service', 'user', 'package'])
        ->get();
    }

    public function getAllWithFilters($search = null, $status = null, $perPage = 10)
    {
        $query = Order::with(['user', 'service', 'package', 'freelancer']);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })
                ->orWhereHas('freelancer', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })
                ->orWhereHas('service', function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%");
                })
                ->orWhere('id', 'like', "%{$search}%");
            });
        }

        if ($status && $status !== 'All Statuses') {
            $query->where('status', $status);
        }

        return $query->orderBy('created_at', 'desc')->paginate($perPage);
    }


}