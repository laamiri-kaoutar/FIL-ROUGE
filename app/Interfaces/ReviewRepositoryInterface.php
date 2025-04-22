<?php

namespace App\Interfaces;

interface ReviewRepositoryInterface
{
    public function getUserReviews($userId);

    public function getCompletedOrdersWithoutReviews($userId);
}