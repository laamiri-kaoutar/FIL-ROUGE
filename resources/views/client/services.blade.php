<!-- resources/views/client/services.blade.php -->
@extends('layouts.app')

@section('title', 'Explore Services - FreelanceHub')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/client-services.css') }}">
@endsection

@section('content')
    <main class="max-w-7xl mx-auto px-4 py-12">
        <!-- Page Header -->
        <div class="mb-12">
            <h1 class="text-4xl font-bold text-gray-900 tracking-tight">Explore Services</h1>
            <p class="mt-3 text-lg text-gray-600">Discover talented freelancers for your projects</p>
        </div>

        <!-- Enhanced Filter Bar -->
        <div class="bg-white p-6 rounded-xl shadow-lg mb-10 border border-gray-100">
            <form method="GET" action="{{ route('client.services') }}" class="grid grid-cols-1 sm:grid-cols-4 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Category</label>
                    <select name="category" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 bg-white">
                        <option value="">All Categories</option>
                        <option value="web-development" {{ request('category') == 'web-development' ? 'selected' : '' }}>Web Development</option>
                        <option value="graphic-design" {{ request('category') == 'graphic-design' ? 'selected' : '' }}>Graphic Design</option>
                        <option value="digital-marketing" {{ request('category') == 'digital-marketing' ? 'selected' : '' }}>Digital Marketing</option>
                        <option value="content-writing" {{ request('category') == 'content-writing' ? 'selected' : '' }}>Content Writing</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Sort By</label>
                    <select name="sort" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 bg-white">
                        <option value="recommended" {{ request('sort') == 'recommended' ? 'selected' : '' }}>Recommended</option>
                        <option value="price-low-high" {{ request('sort') == 'price-low-high' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="price-high-low" {{ request('sort') == 'price-high-low' ? 'selected' : '' }}>Price: High to Low</option>
                        <option value="rating-high-low" {{ request('sort') == 'rating-high-low' ? 'selected' : '' }}>Rating: High to Low</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Price Range</label>
                    <select name="price" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 bg-white">
                        <option value="">All Prices</option>
                        <option value="0-200" {{ request('price') == '0-200' ? 'selected' : '' }}>$0 - $200</option>
                        <option value="200-500" {{ request('price') == '200-500' ? 'selected' : '' }}>$200 - $500</option>
                        <option value="500-plus" {{ request('price') == '500-plus' ? 'selected' : '' }}>$500+</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white py-3 rounded-lg hover:from-purple-700 hover:to-pink-700 transition-colors font-medium">
                        Apply Filters
                    </button>
                </div>
            </form>
        </div>

        <!-- Services Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($services as $service)
                <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow">
                    <img src="{{ $service->image ?? 'https://via.placeholder.com/400x200' }}" 
                         alt="{{ $service->title }}" 
                         class="w-full h-52 object-cover rounded-t-xl">
                    <div class="p-6">
                        <h3 class="font-semibold text-xl text-gray-900 mb-3">{{ $service->title }}</h3>
                        <div class="flex flex-wrap gap-2 mb-4">
                            @foreach ($service->tags as $tag)
                                <span class="bg-purple-100 text-purple-800 text-sm px-3 py-1 rounded-full font-medium">#{{ $tag }}</span>
                            @endforeach
                        </div>
                        <div class="flex items-center mb-4">
                            <span class="text-yellow-400 text-lg">
                                @for ($i = 0; $i < 5; $i++)
                                    {{ $i < $service->rating ? '★' : '☆' }}
                                @endfor
                            </span>
                            <span class="text-sm text-gray-600 ml-2 font-medium">{{ number_format($service->rating, 1) }} ({{ $service->reviews_count }})</span>
                        </div>
                        <div class="flex justify-between items-center border-t pt-4">
                            <div>
                                <p class="text-sm text-gray-500">Starting at</p>
                                <p class="text-2xl font-semibold text-gray-900">${{ $service->price }}</p>
                            </div>
                            <a href="{{ route('client.service.show', $service->id) }}" class="text-purple-600 hover:text-purple-800 font-semibold">View Details</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-600 col-span-3 text-center">No services found matching your criteria.</p>
            @endforelse
        </div>

        <!-- Enhanced Pagination -->
        <div class="mt-12 flex justify-center gap-4">
            {{ $services->links('vendor.pagination.tailwind') }}
        </div>
    </main>
@endsection