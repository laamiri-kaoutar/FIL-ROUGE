<?php

namespace App\Http\Controllers;

use App\Repositories\ServiceRepository;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    protected $serviceRepository;

    public function __construct(ServiceRepository $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    public function services(Request $request)
    {
        $query = $request->input('query');
        $category = $request->input('category');
        $sort = $request->input('sort', 'recommended');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');

        $services = $this->serviceRepository->all($query, $category ? (int)$category : null, $minPrice ? (float)$minPrice : null, $maxPrice ? (float)$maxPrice : null, $sort);
        $categories = Category::all();

        return view('client.services', compact('services', 'categories'));
    }

    public function show($id)
    {
        $service = $this->serviceRepository->find($id);
        return view('client.service-show', compact('service'));
    }

   
}