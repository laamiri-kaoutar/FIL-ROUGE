@extends('layouts.app')

@section('title', 'Explore Services - FreelanceHub')

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
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Sort By</label>
                    <select name="sort" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 bg-white">
                        <option value="recommended" {{ request('sort') == 'recommended' ? 'selected' : '' }}>Recommended</option>
                        <option value="rating-high-low" {{ request('sort') == 'rating-high-low' ? 'selected' : '' }}>Rating: High to Low</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Price Range</label>
                    <div class="flex gap-3">
                        <input type="number" name="min_price" placeholder="Min Price" value="{{ request('min_price') }}" min="0" class="w-1/2 border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 bg-white">
                        <input type="number" name="max_price" placeholder="Max Price" value="{{ request('max_price') }}" min="0" class="w-1/2 border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 bg-white">
                    </div>
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white py-3 rounded-lg hover:from-purple-700 hover:to-pink-700 transition-colors font-medium">
                        Apply Filters
                    </button>
                </div>
            </form>
        </div>

        <!-- Services Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($services as $service)
                <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100">
                    <div class="relative h-48 bg-gray-200">
                        @if ($service->images->where('is_main', true)->first())
                            <img src="{{ asset('storage/' . $service->images->where('is_main', true)->first()->image_path) }}" alt="{{ $service->title }}" class="w-full h-full object-cover">
                        @else
                            <img src="https://via.placeholder.com/400x200" alt="{{ $service->title }}" class="w-full h-full object-cover">
                        @endif
                        <div class="absolute top-2 right-2 text-xs font-medium px-2.5 py-0.5 rounded 
                            {{ $service->status === 'active' ? 'bg-green-100 text-green-800' : ($service->status === 'inactive' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                            {{ ucfirst($service->status) }}
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="flex justify-between items-start">
                            <h3 class="text-lg font-semibold text-gray-800">{{ $service->title }}</h3>
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span class="ml-1 text-sm text-gray-600">{{ number_format($service->rating, 1) }}</span>
                            </div>
                        </div>
                        <p class="mt-2 text-sm text-gray-600 line-clamp-2">{{ $service->description }}</p>
                        
                        <!-- Packages Preview -->
                        <div class="mt-3">
                            <div class="text-xs text-gray-500 uppercase font-medium">Packages:</div>
                            <div class="mt-1 flex flex-wrap gap-2">
                                @foreach ($service->packages as $package)
                                    <span class="px-2 py-1 bg-gray-100 text-gray-800 text-xs rounded-full">
                                        {{ ucfirst($package->package_type) }}: ${{ number_format($package->price, 2) }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                        
                        <div class="mt-3">
                            <div class="text-xs text-gray-500 uppercase font-medium">Tags:</div>
                            <div class="mt-1 flex flex-wrap gap-2">
                                @foreach ($service->tags as $tag)
                                    <span class="px-2 py-1 text-xs rounded-full" style="background-color: {{ $tag->color }}; color: #FFFFFF;">#{{ $tag->name }}</span>
                                @endforeach
                            </div>
                        </div>
                        
                        <div class="flex justify-end items-center border-t pt-3 mt-3">
                            @auth
                                <a href="{{ route('client.services.show', $service->id) }}" class="text-purple-600 hover:text-purple-800 font-semibold">View Details</a>
                            @else
                                <a href="{{ route('register') }}?redirect_to={{ route('client.services.show', $service->id) }}" class="text-purple-600 hover:text-purple-800 font-semibold">Register to View Details</a>
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-600">No services found matching your criteria.</p>
            @endforelse
        </div>

        <!-- Enhanced Pagination -->
        <div class="mt-12 flex justify-center">
            {{ $services->appends(request()->query())->links() }}
        </div>
    </main>
@endsection