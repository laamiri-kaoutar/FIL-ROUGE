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
        return Order::where('user_id','=', Auth::id())->with(['service.user', 'package'])->paginate(4);
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

    public function getOrdersOverTime($days = 30)
    {
        return Order::selectRaw('DATE(created_at) as date')
            ->selectRaw('COUNT(*) as order_count')
            ->where('created_at', '>=', now()->subDays($days))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
    }

    public function getTotalRevenue()
    {
        return Order::sum('amount');
    }


    public function countPendingOrdersForFreelancer($freelancerId)
    {
        return Order::whereHas('service', function ($query) use ($freelancerId) {
            $query->where('user_id', $freelancerId);
        })->where('status', 'pending')->count();
    }

    public function getLastTransactionForFreelancer($freelancerId)
    {
        return Order::whereHas('service', function ($query) use ($freelancerId) {
            $query->where('user_id', $freelancerId);
        })->where('status', 'completed')->latest()->first();
    }

    public function getTotalEarningsForFreelancer($freelancerId)
    {
        return Order::whereHas('service', function ($query) use ($freelancerId) {
            $query->where('user_id', $freelancerId);
        })->where('status', 'completed')->sum('amount');
    }

    public function getRecentOrdersForFreelancer($freelancerId, $limit = 3)
    {
        return Order::whereHas('service', function ($query) use ($freelancerId) {
            $query->where('user_id', $freelancerId);
        })->latest()->take($limit)->get();
    }

    public function getEarningsOverTimeForFreelancer($freelancerId, $days = 30)
    {
        return Order::selectRaw('DATE(created_at) as date')
            ->selectRaw('SUM(amount) as total_amount')
            ->whereHas('service', function ($query) use ($freelancerId) {
                $query->where('user_id', $freelancerId);
            })
            // ->where('status', 'completed')
            ->where('created_at', '>=', now()->subDays($days))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
    }



    public function getOrderStatusDistributionForClient($clientId)
    {
        return Order::selectRaw('status, COUNT(*) as count')
            ->where('user_id', $clientId)
            ->groupBy('status')
            ->get();
    }


}