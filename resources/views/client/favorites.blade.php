<!-- resources/views/client/favorites.blade.php -->
@extends('layouts.app')

@section('title', 'Your Favorite Services - FreelanceHub')

@section('content')
    <main class="flex-grow container mx-auto px-4 py-8">
        <!-- Back to Dashboard Link -->
        <div class="mb-6">
            <a href="{{ route('client.dashboard') }}" class="inetext-purple-600 hover:underline">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                Back to Dashboard
            </a>
        </div>

        <!-- Page Title -->
        <h1 class="text-3xl font-bold mb-8 text-gray-800">Your Favorite Services</h1>

        <!-- Favorites List -->
        <div id="favorites-list" class="flex flex-wrap gap-6">
            <!-- Favorite Service Card 1 -->
            <div class="bg-white rounded-lg shadow-md min-w-[250px] flex-1">
                <div class="primary-gradient h-3 rounded-t-lg"></div>
                <div class="p-4">
                    <h3 class="text-base font-semibold text-gray-800 mb-2">Full Stack Web Development Services</h3>
                    <div class="flex items-center mb-2">
                        <div class="flex text-yellow-400 mr-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        </div>
                        <span class="text-gray-700 font-medium text-sm">5.0</span>
                    </div>
                    <p class="text-gray-600 mb-2 text-sm">Freelancer: John Developer</p>
                    <!-- Tags -->
                    <div class="flex flex-wrap gap-1 mb-2">
                        <span class="px-2 py-0.5 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">Web Development</span>
                        <span class="px-2 py-0.5 bg-indigo-100 text-indigo-800 text-xs font-medium rounded-full">JavaScript</span>
                        <span class="px-2 py-0.5 bg-purple-100 text-purple-800 text-xs font-medium rounded-full">React</span>
                    </div>
                    <!-- Category -->
                    <div class="text-sm text-gray-500 mb-2">
                        Category: <span class="font-medium text-gray-700">Software Development</span>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-2">
                        <a href="{{ route('client.service.show', 1) }}" class="flex-1 px-3 py-1.5 bg-purple-600 text-white text-center rounded-md hover:bg-purple-700 transition text-sm">View Service</a>
                        <button type="button" onclick="confirmRemove(this)" class="remove-favorite-btn flex-1 px-3 py-1.5 bg-white border border-red-500 text-red-500 text-center rounded-md hover:bg-red-50 transition text-sm" data-service-id="1">Remove from Favorites</button>
                    </div>
                </div>
            </div>

            <!-- Favorite Service Card 2 -->
            <div class="bg-white rounded-lg shadow-md min-w-[250px] flex-1">
                <div class="primary-gradient h-3 rounded-t-lg"></div>
                <div class="p-4">
                    <h3 class="text-base font-semibold text-gray-800 mb-2">UI/UX Design Services</h3>
                    <div class="flex items-center mb-2">
                        <div class="flex text-yellow-400 mr-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        </div>
                        <span class="text-gray-700 font-medium text-sm">4.9</span>
                    </div>
                    <p class="text-gray-600 mb-2 text-sm">Freelancer: Sarah Designer</p>
                    <!-- Tags -->
                    <div class="flex flex-wrap gap-1 mb-2">
                        <span class="px-2 py-0.5 bg-teal-100 text-teal-800 text-xs font-medium rounded-full">UI/UX</span>
                        <span class="px-2 py-0.5 bg-pink-100 text-pink-800 text-xs font-medium rounded-full">Figma</span>
                        <span class="px-2 py-0.5 bg-orange-100 text-orange-800 text-xs font-medium rounded-full">User Research</span>
                    </div>
                    <!-- Category -->
                    <div class="text-sm text-gray-500 mb-2">
                        Category: <span class="font-medium text-gray-700">Design</span>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-2">
                        <a href="{{ route('client.service.show', 2) }}" class="flex-1 px-3 py-1.5 bg-purple-600 text-white text-center rounded-md hover:bg-purple-700 transition text-sm">View Service</a>
                        <button type="button" onclick="confirmRemove(this)" class="remove-favorite-btn flex-1 px-3 py-1.5 bg-white border border-red-500 text-red-500 text-center rounded-md hover:bg-red-50 transition text-sm" data-service-id="2">Remove from Favorites</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Empty State (Hidden by Default) -->
        <div id="empty-state" class="hidden bg-white rounded-lg shadow-md p-8 text-center max-w-md mx-auto">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.6362-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">No favorites yet</h3>
            <p class="text-gray-600 mb-6">You haven't added any services to your favorites yet. Start exploring services!</p>
            <a href="{{ route('client.services') }}" class="inline-block px-6 py-3 bg-purple-600 text-white rounded-md hover:bg-purple-700 transition">Explore Services</a>
        </div>
    </main>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/favorites.js') }}"></script>
@endsection