<!-- resources/views/client/dashboard.blade.php -->
@extends('layouts.app')

@section('title', 'Client Dashboard - FreelanceHub')

@section('content')
    <main class="flex-grow">
        <div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-800 md:text-3xl">Welcome to FreelanceHub, Jane Doe!</h1>
                <p class="text-gray-600 mt-2">Let's get started on your freelancing journey.</p>
            </div>
            
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 mb-8">
                <!-- Active Orders Card -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-lg font-semibold text-gray-800">Active Orders</h2>
                    <p class="text-gray-600 mt-2">You don't have any orders yet. Start by exploring services!</p>
                    <a href="{{ route('client.services') }}" class="mt-3 inline-block px-4 py-2 rounded text-sm font-medium text-white primary-gradient hover:opacity-90 transition-opacity">
                        Explore Services
                    </a>
                </div>
                
                <!-- Favorite Services Card -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-lg font-semibold text-gray-800">Favorite Services</h2>
                    <p class="text-gray-600 mt-2">Add services to your favorites to keep track of them!</p>
                    <a href="{{ route('client.services') }}" class="mt-3 inline-block px-4 py-2 rounded text-sm font-medium text-white primary-gradient hover:opacity-90 transition-opacity">
                        Discover Services
                    </a>
                </div>
                
                <!-- Last Payment Card -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-lg font-semibold text-gray-800">Last Payment</h2>
                    <p class="text-gray-600 mt-2">No payments yet. Place your first order to get started!</p>
                    <a href="{{ route('client.services') }}" class="mt-3 inline-block px-4 py-2 rounded text-sm font-medium text-white primary-gradient hover:opacity-90 transition-opacity">
                        Place an Order
                    </a>
                </div>
            </div>
            
            <!-- Actions Grid -->
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Quick Actions</h2>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Manage Profile -->
                <a href="{{ route('profile.show') }}" class="bg-white rounded-lg shadow p-5 flex items-center hover:shadow-md transition-shadow">
                    <div class="w-10 h-10 rounded-full primary-gradient flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="font-medium text-gray-800">Manage Profile</h3>
                        <p class="text-gray-500 text-sm mt-1">View and update your settings</p>
                    </div>
                </a>
                
                <!-- Explore Services -->
                <a href="{{ route('client.services') }}" class="bg-white rounded-lg shadow p-5 flex items-center hover:shadow-md transition-shadow">
                    <div class="w-10 h-10 rounded-full primary-gradient flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="font-medium text-gray-800">Explore Services</h3>
                        <p class="text-gray-500 text-sm mt-1">Discover freelancer offerings</p>
                    </div>
                </a>
                
                <!-- Place Order -->
                <a href="{{ route('client.services') }}" class="bg-white rounded-lg shadow p-5 flex items-center hover:shadow-md transition-shadow">
                    <div class="w-10 h-10 rounded-full primary-gradient flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="font-medium text-gray-800">Place Order</h3>
                        <p class="text-gray-500 text-sm mt-1">Start a new project</p>
                    </div>
                </a>
                
                <!-- Order History -->
                <a href="{{ route('client.orders') }}" class="bg-white rounded-lg shadow p-5 flex items-center hover:shadow-md transition-shadow">
                    <div class="w-10 h-10 rounded-full primary-gradient flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="font-medium text-gray-800">Order History</h3>
                        <p class="text-gray-500 text-sm mt-1">View past and current orders</p>
                    </div>
                </a>
                
                <!-- Communicate -->
                <a href="{{ route('chat') }}" class="bg-white rounded-lg shadow p-5 flex items-center hover:shadow-md transition-shadow">
                    <div class="w-10 h-10 rounded-full primary-gradient flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="font-medium text-gray-800">Communicate</h3>
                        <p class="text-gray-500 text-sm mt-1">Message with freelancers</p>
                    </div>
                </a>
                
                <!-- Manage Reviews -->
                <a href="{{ route('client.reviews') }}" class="bg-white rounded-lg shadow p-5 flex items-center hover:shadow-md transition-shadow">
                    <div class="w-10 h-10 rounded-full primary-gradient flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="font-medium text-gray-800">Manage Reviews</h3>
                        <p class="text-gray-500 text-sm mt-1">Write and edit your reviews</p>
                    </div>
                </a>
            </div>
            
            <!-- Getting Started Section -->
            <div class="mt-10">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Getting Started</h2>
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="p-6">
                        <h3 class="font-medium text-gray-800 mb-4">Welcome to FreelanceHub! Here's how to get started:</h3>
                        
                        <div class="flex items-start mb-4">
                            <div class="w-8 h-8 rounded-full accent-gradient flex items-center justify-center flex-shrink-0 mr-4">
                                <span class="text-white font-medium">1</span>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800">Complete your profile</h4>
                                <p class="text-sm text-gray-600 mt-1">Add your details and preferences to help freelancers understand your needs.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start mb-4">
                            <div class="w-8 h-8 rounded-full accent-gradient flex items-center justify-center flex-shrink-0 mr-4">
                                <span class="text-white font-medium">2</span>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800">Explore services</h4>
                                <p class="text-sm text-gray-600 mt-1">Browse through our catalog of freelancer services to find what you need.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="w-8 h-8 rounded-full accent-gradient flex items-center justify-center flex-shrink-0 mr-4">
                                <span class="text-white font-medium">3</span>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800">Place your first order</h4>
                                <p class="text-sm text-gray-600 mt-1">Select a service and place an order to start working with a freelancer.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection