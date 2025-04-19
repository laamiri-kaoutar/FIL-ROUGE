<?php

namespace App\Repositories;

use App\Models\Feature;
use App\Models\Service;
use App\Models\ServiceImage;
use App\Models\ServicePackage;
use App\Interfaces\ServiceRepositoryInterface;

class ServiceRepository implements ServiceRepositoryInterface
{
    public function create(array $data)
    {
        return Service::create($data);
    }

    public function addImage(int $serviceId, array $data)
    {
        $data['service_id'] = $serviceId;
        return ServiceImage::create($data);
    }

    public function addPackages(int $serviceId, array $packages)
    {
        foreach ($packages as $package) {
            $package['service_id'] = $serviceId;
            ServicePackage::create($package);
        }
    }

    public function find(int $id)
    {
        return Service::findOrFail($id);
    }

    public function all()
    {
        return Service::all();
    }

    public function getByUserId(int $userId)
    {
        return Service::where('user_id', $userId)->with(['tags', 'category', 'images', 'packages'])->get();
    }

    public function delete(int $id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
    }

    

    public function update(int $id, array $data)
    {
        $service = Service::findOrFail($id);
        $service->update($data);
        return $service;
    }

    public function deleteImage(int $imageId)
    {
        $image = ServiceImage::findOrFail($imageId);
        $image->delete();
    }

    public function createPackage(int $serviceId, array $data)
    {
        $data['service_id'] = $serviceId;
        return ServicePackage::create($data);
    }

    public function updatePackage(int $packageId, array $data)
    {
        $package = ServicePackage::findOrFail($packageId);
        $package->update($data);
        return $package;
    }

    public function deletePackage(int $packageId)
    {
        $package = ServicePackage::findOrFail($packageId);
        $package->delete();
    }

    public function createFeature(int $packageId, array $data)
    {
        $data['service_package_id'] = $packageId;
        return Feature::create($data);
    }

    public function deleteFeature(int $featureId)
    {
        $feature = Feature::findOrFail($featureId);
        $feature->delete();
    }

    public function getByUserIdWithFilter(int $userId, ?string $query = null)
{
    $builder = Service::with(['images', 'packages.features'])
        ->where('user_id', $userId);

    if ($query) {
        $builder->where('title', 'like', '%' . $query . '%');
    }

    return $builder->get();
}
}