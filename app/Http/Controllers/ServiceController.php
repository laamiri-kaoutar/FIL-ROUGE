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
    
       public function edit($id){
    
        $service = Service::find($id);
        return view('freelancer.service-edit' , compact("service"));
    
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
}