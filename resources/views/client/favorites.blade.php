@extends('layouts.app')

@section('title', 'Your Favorite Services - FreelanceHub')

@section('content')
    <main class="flex-grow container mx-auto px-4 py-8">
        <!-- Back to Dashboard Link -->
        <div class="mb-6">
            <a href="{{ route('client.dashboard') }}" class="inline-flex items-center text-purple-600 hover:underline">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                Back to Dashboard
            </a>
        </div>

        <!-- Page Title -->
        <h1 class="text-3xl font-bold mb-8 text-gray-800">Your Favorite Services</h1>

        <!-- Success Message -->
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Favorites List -->
        @if ($favorites->isNotEmpty())
            <div id="favorites-list" class="flex flex-wrap gap-6">
                @foreach ($favorites as $service)
                    <div class="bg-white rounded-lg shadow-md min-w-[250px] flex-1">
                        <div class="primary-gradient h-3 rounded-t-lg"></div>
                        <div class="p-4">
                            <h3 class="text-base font-semibold text-gray-800 mb-2">{{ $service->title }}</h3>
                            <div class="flex items-center mb-2">
                                <div class="flex text-yellow-400 mr-1">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endfor
                                </div>
                                <span class="text-gray-700 font-medium text-sm">{{ number_format($service->reviews->avg('rating') ?? 0, 1) }}</span>
                            </div>
                            <p class="text-gray-600 mb-2 text-sm">Freelancer: {{ $service->user->name }}</p>
                            <!-- Tags -->
                            <div class="flex flex-wrap gap-1 mb-2">
                                @foreach ($service->tags as $tag)
                                    <span class="px-2 py-0.5 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">{{ $tag->name }}</span>
                                @endforeach
                            </div>
                            <!-- Category -->
                            <div class="text-sm text-gray-500 mb-2">
                                Category: <span class="font-medium text-gray-700">{{ $service->category->name }}</span>
                            </div>
                            <div class="flex flex-col sm:flex-row gap-2">
                                <a href="{{ route('client.services.show', $service->id) }}" class="flex-1 px-3 py-1.5 bg-purple-600 text-white text-center rounded-md hover:bg-purple-700 transition text-sm">View Service</a>
                                <button type="button" onclick="confirmRemove({{ $service->id }})" class="remove-favorite-btn flex-1 px-3 py-1.5 bg-white border border-red-500 text-red-500 text-center rounded-md hover:bg-red-50 transition text-sm" data-service-id="{{ $service->id }}">Remove from Favorites</button>
                                <form id="remove-form-{{ $service->id }}" action="{{ route('client.services.favorite', $service->id) }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div id="empty-state" class="bg-white rounded-lg shadow-md p-8 text-center max-w-md mx-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.6362-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">No favorites yet</h3>
                <p class="text-gray-600 mb-6">You haven't added any services to your favorites yet. Start exploring services!</p>
                <a href="{{ route('client.services') }}" class="inline-block px-6 py-3 bg-purple-600 text-white rounded-md hover:bg-purple-700 transition">Explore Services</a>
            </div>
        @endif
    </main>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmRemove(serviceId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This service will be removed from your favorites!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, remove it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`remove-form-${serviceId}`).submit();
                }
            });
        }
    </script>
@endsection