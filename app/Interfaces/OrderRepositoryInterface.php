<?php

namespace App\Interfaces;

interface OrderRepositoryInterface
{
    public function create(array $data);
    public function find(int $id);
    public function getFreelancerOrders($freelancerId);
    public function getAllWithFilters($search = null, $status = null, $perPage = 10);
    public function getOrdersOverTime($days = 30);
    public function getTotalRevenue();

}