<?php

namespace App\Repositories;

use App\Interfaces\ServiceRepositoryInterface;
use App\Models\Service;
use App\Models\ServiceImage;
use App\Models\ServicePackage;

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

    public function update(int $id, array $data)
    {
        $service = Service::findOrFail($id);
        $service->update($data);
        return $service;
    }

    public function delete(int $id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
    }
}