<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\Review;
use App\Interfaces\ReviewRepositoryInterface;


class ReviewRepository implements ReviewRepositoryInterface
{
    public function getUserReviews($userId)
    {
        return Review::where('user_id', $userId)
            ->with(['service'])
            ->get();
    }

    public function getCompletedOrdersWithoutReviews($userId)
    {
        return  Order::where('user_id', $userId)
            ->where('status', 'completed')
            ->with(['service', 'package'])
            ->get();
    }

    public function getAllWithRelations()
    {
        return Review::with(['user', 'service', 'signals'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function deleteById($id)
    {
        $review = Review::findOrFail($id);
        return $review->delete();
    }


}