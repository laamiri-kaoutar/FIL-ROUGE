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
        return Service::with(['images', 'packages.features', 'tags', 'user', 'reviews.user'])->findOrFail($id);
    }

    public function all(?string $query = null, ?int $categoryId = null, ?float $minPrice = null, ?float $maxPrice = null, ?string $sort = 'recommended')
    {
        $builder = Service::with(['images', 'packages.features', 'tags']);

        // Search filter
        if ($query) {
            $builder->where('title', 'like', '%' . $query . '%');
        }

        // Category filter
        if ($categoryId) {
            $builder->where('category_id', $categoryId);
        }

        // Price range filter
        if ($minPrice || $maxPrice) {
            $builder->whereHas('packages', function ($q) use ($minPrice, $maxPrice) {
                if ($minPrice) {
                    $q->where('price', '>=', $minPrice);
                }
                if ($maxPrice) {
                    $q->where('price', '<=', $maxPrice);
                }
            });
        }

        if ($sort === 'rating-high-low') {
            $builder->orderBy('rating', 'desc');
        } else {
            $builder->orderBy('rating', 'desc');
        }

        return $builder->paginate(6);
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
    
        return $builder->paginate(2); 
    }

    public function updateRating(int $serviceId)
    {
        $service = Service::findOrFail($serviceId);
        $service->update([
            'rating' => $service->reviews()->avg('rating') ?? 0,
        ]);
    }

    public function getAllWithFilters($search = null, $status = null, $category_id = null, $perPage = 10)
    {
        $query = Service::with(['user', 'category']);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }

        if ($status && $status !== 'All Statuses') {
            $query->where('status', $status);
        }

        if ($category_id && $category_id !== 'All Categories') {
            $query->where('category_id', $category_id);
        }

        return $query->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function getServicesByCategory($status = null)
    {
        $query = Service::select('categories.name as category_name')
            ->selectRaw('COUNT(services.id) as service_count')
            ->join('categories', 'services.category_id', '=', 'categories.id')
            ->groupBy('categories.name');

        if ($status && $status !== 'All Statuses') {
            $query->where('services.status', $status);
        }

        return $query->get();
    }

    public function getServiceStatusDistribution()
    {
        return Service::select('status')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('status')
            ->get();
    }

    public function getTopRatedServices($limit = 3)
    {
        return Service::where('status', 'active')
            ->orderBy('rating', 'desc')
            ->take($limit)
            ->get();
    }

    

}