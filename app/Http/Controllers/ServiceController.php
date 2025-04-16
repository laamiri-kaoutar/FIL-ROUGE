<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\ServiceRepositoryInterface;

class ServiceController extends Controller
{
    protected $serviceRepository;

    public function __construct(ServiceRepositoryInterface $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    public function freelancerServices(){

        // $services = Service::where("user_id" , Auth::id())->get();
        $tags = Tag::all();
        // dd($tags);
        $categories= Category::all();
        // return view('freelancer.services');
    
        return view('freelancer.services' , compact( 'tags', 'categories'));
    
       }
    
       public function edit($id){
    
        $service = Service::find($id);
        return view('freelancer.service-edit' , compact("service"));
    
       }

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'serviceTitle' => 'required|string|max:255',
            'serviceDescription' => 'required|string',
            'serviceStatus' => 'required|in:active,inactive',
            'serviceCategory' => 'required|exists:categories,id',
            'serviceTags' => 'required|array',
            'serviceTags.*' => 'exists:tags,id',
            'serviceImage' => 'nullable|image|max:5120', // 5MB max
            'packageName' => 'required|array',
            'packageName.*' => 'required|string|max:255',
            'packageType' => 'required|array',
            'packageType.*' => 'required|in:basic,standard,premium',
            'packagePrice' => 'required|array',
            'packagePrice.*' => 'required|numeric|min:0',
            'packageRevisions' => 'required|array',
            'packageRevisions.*' => 'required|integer|min:0',
            'packageDeliveryTime' => 'required|array',
            'packageDeliveryTime.*' => 'required|integer|min:1',
        ]);

        // Prepare service data
        $serviceData = [
            'title' => $validatedData['serviceTitle'],
            'description' => $validatedData['serviceDescription'],
            'status' => $validatedData['serviceStatus'],
            'user_id' => Auth::id(),
            'category_id' => $validatedData['serviceCategory'],
        ];

        // Create the service
        $service = $this->serviceRepository->create($serviceData);

        // Attach tags
        $service->tags()->attach($validatedData['serviceTags']);

        // Handle image upload
        if ($request->hasFile('serviceImage')) {
            $imagePath = $request->file('serviceImage')->store('service_images', 'public');
            $this->serviceRepository->addImage($service->id, [
                'is_main' => true,
                'image_path' => $imagePath,
            ]);
        }

        // Handle packages
        $packages = [];
        foreach ($validatedData['packageName'] as $index => $name) {
            $packages[] = [
                'name' => $name,
                'package_type' => $validatedData['packageType'][$index],
                'price' => $validatedData['packagePrice'][$index],
                'revisions' => $validatedData['packageRevisions'][$index],
                'delivery_time' => $validatedData['packageDeliveryTime'][$index],
            ];
        }
        $this->serviceRepository->addPackages($service->id, $packages);

        return redirect()->back()->with('success', 'Service created successfully!');
    }
}