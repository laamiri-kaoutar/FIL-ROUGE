<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateServiceRequest;
use App\Interfaces\ServiceRepositoryInterface;

class ServiceController extends Controller
{
    protected $serviceRepository;

    public function __construct(ServiceRepositoryInterface $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    public function freelancerServices()
    {
        $services = $this->serviceRepository->all()->where('user_id', Auth::id());
        $tags = Tag::all();
        $categories = Category::all();
    
        return view('freelancer.services', compact('services', 'tags', 'categories'));
    }
    
   

    public function create(CreateServiceRequest $request)
    {

        $validated = $request->validated();

        $serviceData = [
            'title' => $validated['serviceTitle'],
            'description' => $validated['serviceDescription'],
            'status' => $validated['serviceStatus'],
            'user_id' => Auth::id(),
            'category_id' => $validated['serviceCategory'],
        ];

        $service = $this->serviceRepository->create($serviceData);

        $service->tags()->attach($validated['serviceTags']);

        if ($request->hasFile('serviceImage')) {
            $imagePath = $request->file('serviceImage')->store('service_images', 'public');
            $this->serviceRepository->addImage($service->id, [
                'is_main' => true,
                'image_path' => $imagePath,
            ]);
        }
      
        $this->createPackages($service->id, $validated);

        return redirect()->back()->with('success', 'Service created successfully!');
    }

    protected function createPackages(int $serviceId, array $validated): void
    {
        $packages = [];
        foreach ($validated['packageName'] as $index => $name) {
            $packages[] = [
                'name' => $name,
                'package_type' => $validated['packageType'][$index],
                'price' => $validated['packagePrice'][$index],
                // 'revisions' => $validated['packageRevisions'][$index],
                'delivery_time' => $validated['packageDeliveryTime'][$index],
            ];
        }

        $this->serviceRepository->addPackages($serviceId, $packages);
    }

    public function edit($id)
    {
        $service = $this->serviceRepository->find($id);
        if ($service->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }
        $service->load('packages.features');
        return view('freelancer.service-edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $service = $this->serviceRepository->find($id);
        if ($service->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $validatedData = $request->validate([
            'serviceTitle' => 'required|string|max:255',
            'serviceDescription' => 'required|string',
            'serviceStatus' => 'required|in:active,inactive,draft',
        ]);

        $this->serviceRepository->update($id, [
            'title' => $validatedData['serviceTitle'],
            'description' => $validatedData['serviceDescription'],
            'status' => $validatedData['serviceStatus'],
        ]);

        return redirect()->back()->with('success', 'Service updated successfully!');
    }

    public function addImage(Request $request, $id)
    {
        $service = $this->serviceRepository->find($id);
        if ($service->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'image' => 'required|image|max:5120',
        ]);

        if ($service->images->count() >= 5) {
            return redirect()->back()->with('error', 'You can only upload up to 5 images.');
        }

        $imagePath = $request->file('image')->store('service_images', 'public');
        $this->serviceRepository->addImage($id, [
            'image_path' => $imagePath,
            'is_main' => $service->images->isEmpty(),
        ]);

        return redirect()->back()->with('success', 'Image added successfully!');
    }

    public function deleteImage($id, $imageId)
    {
        $service = $this->serviceRepository->find($id);
        if ($service->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $this->serviceRepository->deleteImage($imageId);
        return redirect()->back()->with('success', 'Image deleted successfully!');
    }

    public function addPackage(Request $request, $id)
    {
        $service = $this->serviceRepository->find($id);
        if ($service->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $validatedData = $request->validate([
            'packageName' => 'required|string|max:255',
            'packageDescription' => 'nullable|string',
            'packageType' => 'required|in:basic,standard,premium',
            'packagePrice' => 'required|numeric|min:0',
            // 'packageRevisions' => 'required|integer|min:0',
            'packageDelivery' => 'required|integer|min:1',
        ]);
        // dd( $validatedData['packageDescription']);

        $this->serviceRepository->createPackage($id, [
            'name' => $validatedData['packageName'],
            'description' => $validatedData['packageDescription'],
            'package_type' => $validatedData['packageType'],
            'price' => $validatedData['packagePrice'],
            // 'revisions' => $validatedData['packageRevisions'],
            'delivery_time' => $validatedData['packageDelivery'],
        ]);

        return redirect()->back()->with('success', 'Package added successfully!');
    }

    public function updatePackage(Request $request, $id, $packageId)
    {
        $service = $this->serviceRepository->find($id);
        if ($service->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $validatedData = $request->validate([
            'packageName' => 'required|string|max:255',
            'packageDescription' => 'nullable|string',
            'packageType' => 'required|in:basic,standard,premium',
            'packagePrice' => 'required|numeric|min:0',
            'packageRevisions' => 'required|integer|min:0',
            'packageDelivery' => 'required|integer|min:1',
        ]);

        $this->serviceRepository->updatePackage($packageId, [
            'name' => $validatedData['packageName'],
            'description' => $validatedData['packageDescription'],
            'package_type' => $validatedData['packageType'],
            'price' => $validatedData['packagePrice'],
            'revisions' => $validatedData['packageRevisions'],
            'delivery_time' => $validatedData['packageDelivery'],
        ]);

        return redirect()->back()->with('success', 'Package updated successfully!');
    }

    public function deletePackage($id, $packageId)
    {
        $service = $this->serviceRepository->find($id);
        if ($service->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $this->serviceRepository->deletePackage($packageId);
        return redirect()->back()->with('success', 'Package deleted successfully!');
    }

    public function addFeature(Request $request, $id, $packageId)
    {
        // dd($request);
        $service = $this->serviceRepository->find($id);
        if ($service->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $validatedData = $request->validate([
            'featureDescription' => 'required|string|max:255',
            'featureIncluded' => 'boolean',
        ]);

        $this->serviceRepository->createFeature($packageId, [
            'description' => $validatedData['featureDescription'],
            'is_included' => $validatedData['featureIncluded'] ?? false,
        ]);

        return redirect()->back()->with('success', 'Feature added successfully!');
    }

    public function deleteFeature($id, $packageId, $featureId)
    {
        $service = $this->serviceRepository->find($id);
        if ($service->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $this->serviceRepository->deleteFeature($featureId);
        return redirect()->back()->with('success', 'Feature deleted successfully!');
    }
}