<?php

namespace App\Interfaces;


interface UserRepositoryInterface
{
    public function getAllWithFilters($search = null, $status = null, $perPage = 10);
    public function updateStatus($userId, $status);
}