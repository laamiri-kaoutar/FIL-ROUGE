<?php

namespace App\Interfaces;

interface ServiceRepositoryInterface
{
    public function create(array $data);
    public function addImage(int $serviceId, array $data);
    public function addPackages(int $serviceId, array $packages);
    public function find(int $id);
    public function all(?string $query = null, ?int $categoryId = null, ?float $minPrice = null, ?float $maxPrice = null, ?string $sort = 'recommended');
    public function getByUserId(int $userId);
    public function delete(int $id);

    public function update(int $id, array $data);
    public function deleteImage(int $imageId);
    public function createPackage(int $serviceId, array $data);
    public function updatePackage(int $packageId, array $data);
    public function deletePackage(int $packageId);
    public function createFeature(int $packageId, array $data);
    public function deleteFeature(int $featureId);
    public function getByUserIdWithFilter(int $userId, ?string $query = null);
    public function updateRating(int $serviceId);
    public function getAllWithFilters($search = null, $status = null,$category_id = null, $perPage = 10);
    public function getServicesByCategory($status = null);
    public function getServiceStatusDistribution();
}