<!-- resources/views/freelancer/dashboard.blade.php -->
@extends('layouts.app')

@section('title', 'Freelancer Dashboard - FreelanceHub')

@section('content')
    <main class="flex-grow container mx-auto px-4 py-8">
        <!-- Welcome Section -->
        <section class="mb-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Welcome, John Doe</h1>
                    <p class="text-gray-600 mt-1">Here's what's happening with your account today.</p>
                </div>
            </div>
        </section>
        
        <!-- Stats Cards -->
        <section class="mb-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <!-- Active Services Card -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                <div class="flex items-center">
                    <div class="rounded-full p-3 bg-blue-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Active Services</p>
                        <h2 class="text-2xl font-semibold text-gray-800">2</h2>
                    </div>
                </div>
            </div>
            
            <!-- Pending Demands Card -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                <div class="flex items-center">
                    <div class="rounded-full p-3 bg-yellow-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Pending Demands</p>
                        <h2 class="text-2xl font-semibold text-gray-800">1</h2>
                    </div>
                </div>
            </div>
            
            <!-- Last Transaction Card -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                <div class="flex items-center">
                    <div class="rounded-full p-3 bg-green-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Last Transaction</p>
                        <h2 class="text-2xl font-semibold text-gray-800">$100</h2>
                    </div>
                </div>
            </div>
            
            <!-- Response Rate Card -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                <div class="flex items-center">
                    <div class="rounded-full p-3 bg-purple-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Response Rate</p>
                        <h2 class="text-2xl font-semibold text-gray-800">95%</h2>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Quick Actions Grid -->
        <section class="mb-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Quick Actions</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Manage Profile -->
                <a href="{{ route('freelancer.profile') }}" class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 hover:shadow-md transition group">
                    <div class="flex items-center">
                        <div class="rounded-full p-3 bg-gray-100 group-hover:bg-primary/10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 group-hover:text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="font-semibold text-gray-800 group-hover:text-primary">Manage Profile</h3>
                            <p class="text-sm text-gray-500">Update your professional details</p>
                        </div>
                    </div>
                </a>
                
                <!-- View Demands -->
                <a href="{{ route('freelancer.demands') }}" class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 hover:shadow-md transition group">
                    <div class="flex items-center">
                        <div class="rounded-full p-3 bg-gray-100 group-hover:bg-primary/10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 group-hover:text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="font-semibold text-gray-800 group-hover:text-primary">View Demands</h3>
                            <p class="text-sm text-gray-500">Check pending client requests</p>
                        </div>
                    </div>
                </a>
                
                <!-- Client Communication -->
                <a href="{{ route('chat') }}" class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 hover:shadow-md transition group">
                    <div class="flex items-center">
                        <div class="rounded-full p-3 bg-gray-100 group-hover:bg-primary/10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 group-hover:text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="font-semibold text-gray-800 group-hover:text-primary">Client Communication</h3>
                            <p class="text-sm text-gray-500">Message and manage clients</p>
                        </div>
                    </div>
                </a>
                
                <!-- Transaction History -->
                <a href="{{ route('freelancer.transactions') }}" class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 hover:shadow-md transition group">
                    <div class="flex items-center">
                        <div class="rounded-full p-3 bg-gray-100 group-hover:bg-primary/10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 group-hover:text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="font-semibold text-gray-800 group-hover:text-primary">Transaction History</h3>
                            <p class="text-sm text-gray-500">View your payment records</p>
                        </div>
                    </div>
                </a>
                
                <!-- View Statistics -->
                <a href="#" class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 hover:shadow-md transition group">
                    <div class="flex items-center">
                        <div class="rounded-full p-3 bg-gray-100 group-hover:bg-primary/10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 group-hover:text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="font-semibold text-gray-800 group-hover:text-primary">View Statistics</h3>
                            <p class="text-sm text-gray-500">Analyze your performance</p>
                        </div>
                    </div>
                </a>
                
                <!-- Define Pricing -->
                <a href="{{ route('freelancer.services') }}" class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 hover:shadow-md transition group">
                    <div class="flex items-center">
                        <div class="rounded-full p-3 bg-gray-100 group-hover:bg-primary/10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 group-hover:text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="font-semibold text-gray-800 group-hover:text-primary">Define Pricing</h3>
                            <p class="text-sm text-gray-500">Set rates and service packages</p>
                        </div>
                    </div>
                </a>
            </div>
        </section>
        
        <!-- Service Overview -->
        <section>
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Service Overview</h2>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Active Services -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-4 border-b border-gray-100 flex justify-between items-center">
                        <h3 class="font-medium">Your Active Services</h3>
                        <a href="{{ route('freelancer.services') }}" class="text-sm font-medium text-primary hover:underline">View All</a>
                    </div>
                    <div class="divide-y divide-gray-100">
                        <div class="p-4 flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="rounded-md bg-blue-100 p-2 mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">Logo Design</p>
                                    <p class="text-sm text-gray-500">Starting at $100</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Active</span>
                                <p class="text-sm text-gray-500 mt-1">5 orders in queue</p>
                            </div>
                        </div>
                        <div class="p-4 flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="rounded-md bg-purple-100 p-2 mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">Web Development</p>
                                    <p class="text-sm text-gray-500">Starting at $500</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Active</span>
                                <p class="text-sm text-gray-500 mt-1">2 orders in queue</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Recent Demands -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-4 border-b border-gray-100 flex justify-between items-center">
                        <h3 class="font-medium">Recent Demands</h3>
                        <a href="{{ route('freelancer.demands') }}" class="text-sm font-medium text-primary hover:underline">View All</a>
                    </div>
                    <div class="divide-y divide-gray-100">
                        <div class="p-4">
                            <div class="flex justify-between items-start mb-2">
                                <h4 class="font-medium text-gray-800">Website Redesign</h4>
                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                            </div>
                            <p class="text-sm text-gray-600 mb-2">Need a modern website redesign for our business with responsive design.</p>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">From: TechCorp Inc.</span>
                                <div class="flex space-x-2">
                                    <a href="#" class="px-3 py-1 text-xs font-medium rounded bg-primary text-white">View</a>
                                    <a href="#" class="px-3 py-1 text-xs font-medium rounded bg-gray-200 text-gray-800">Decline</a>
                                </div>
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="flex justify-between items-start mb-2">
                                <h4 class="font-medium text-gray-800">Custom Logo</h4>
                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Accepted</span>
                            </div>
                            <p class="text-sm text-gray-600 mb-2">Looking for a minimalist logo design for my startup.</p>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">From: Jane's Bakery</span>
                                <div>
                                    <a href="{{ route('chat') }}" class="px-3 py-1 text-xs font-medium rounded bg-primary text-white">Message</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection