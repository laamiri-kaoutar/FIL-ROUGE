<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
   public function freelancerServices(){

    $services = Service::where("user_id" , Auth::id())->get();
    return view('freelancer.services');

    return view('freelancer.service-edit' , compact('services'));

   }

   public function edit($id){

    $service = Service::find($id);
    return view('freelancer.service-edit' , compact("service"));

   }
}
