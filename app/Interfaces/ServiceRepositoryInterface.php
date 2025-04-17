<?php

namespace App\Interfaces;

interface ServiceRepositoryInterface
{
    public function create(array $data);
    public function addImage(int $serviceId, array $data);
    public function addPackages(int $serviceId, array $packages);
    public function find(int $id);
    public function all();
    public function getByUserId(int $userId);
    public function update(int $id, array $data);
    public function delete(int $id);
}