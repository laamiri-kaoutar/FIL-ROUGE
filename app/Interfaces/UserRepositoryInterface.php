<?php

namespace App\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{
    public function getAllWithFilters($search = null, $status = null, $perPage = 10): LengthAwarePaginator;
    public function updateStatus($userId, $status);
}