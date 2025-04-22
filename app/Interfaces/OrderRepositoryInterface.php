<?php

namespace App\Interfaces;

interface OrderRepositoryInterface
{
    public function create(array $data);
    public function find(int $id);
    public function getFreelancerOrders($freelancerId);

}