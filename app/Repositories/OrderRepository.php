<?php

namespace App\Repositories;

use App\Models\Order;
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
}