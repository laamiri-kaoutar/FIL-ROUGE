<?php

namespace App\Repositories;

use App\Models\Signal;
use App\Interfaces\SignalRepositoryInterface;

class SignalRepository implements SignalRepositoryInterface
{
    public function getAllWithRelations()
    {
        return Signal::with(['review.user', 'review.service', 'user'])
            // ->selectRaw('review_id')
            ->orderBy('created_at', 'desc')
            // ->groupBy('review_id')
            ->get();
    }

    public function deleteById($id)
    {
        $signal = Signal::findOrFail($id);
        return $signal->delete();
    }

    public function deleteReviewFromSignal($id)
    {
        $signal = Signal::findOrFail($id);
        $review = $signal->review;
       return $review->delete();
    }
}