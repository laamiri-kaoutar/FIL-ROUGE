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

    // public function services()
    // {
    //     $services = $this->serviceRepository->all()->paginate(6); // Paginate 6 services per page
    //     return view('client.services', compact('services'));
    // }

    public function services(Request $request)
    {
        $query = $request->input('query');
        $services = $this->serviceRepository->all($query);

        return view('client.services', compact('services'));
    }
}