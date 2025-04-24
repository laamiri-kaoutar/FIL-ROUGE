<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Review;
use App\Models\Service;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Interfaces\ServiceRepositoryInterface;

class WelcomeController extends Controller
{
    protected $serviceRepository;

    public function __construct(ServiceRepositoryInterface $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    public function index()
    {
        // Trust Indicators
        $freelancerCount = User::where('role_id', '3')->count();
        $averageRating = Review::avg('rating') ?? 0; // Average rating across all reviews
        $satisfactionRate = $averageRating ? round(($averageRating / 5) * 100) : 0; // Convert to percentage

        // Popular Categories (based on number of services)
        $popularCategories = Service::selectRaw('category_id, COUNT(*) as service_count')
            ->where('status', 'active')
            ->groupBy('category_id')
            ->orderBy('service_count', 'desc')
            ->take(4)
            ->get();

       

            $categories = Category::select('name')
            ->inRandomOrder()
            ->take(4)
            ->pluck('name');

        // Testimonials (top 3 reviews by rating)
        $testimonials = Review::with(['user', 'service'])
            ->orderBy('rating', 'desc')
            ->take(3)
            ->get();

        return view('home', compact(
            'freelancerCount',
            'satisfactionRate',
            'categories',
            'testimonials'
        ));
    }
}