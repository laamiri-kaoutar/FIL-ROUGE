<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Category;



class ServiceController extends Controller
{
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
}
