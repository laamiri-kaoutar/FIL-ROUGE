<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class adminController extends Controller
{
   public function dashboard(){
    return view('admin.dashboard');

   }

   public function reviews(){
    return view('admin.reviews');
   }

   
   public function services(){
    return view('admin.services');
   }
}
