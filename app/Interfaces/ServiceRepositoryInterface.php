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
    public function delete(int $id);

    // these are all for updating the srvice and it's related infos 
    public function update(int $id, array $data);
    public function deleteImage(int $imageId);
    public function createPackage(int $serviceId, array $data);
    public function updatePackage(int $packageId, array $data);
    public function deletePackage(int $packageId);
    public function createFeature(int $packageId, array $data);
    public function deleteFeature(int $featureId);
    public function getByUserIdWithFilter(int $userId, ?string $query = null);
}