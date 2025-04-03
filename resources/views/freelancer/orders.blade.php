<!-- resources/views/freelancer/orders.blade.php -->
@extends('layouts.app')

@section('title', 'Orders - FreelanceHub')

@section('content')
    <main class="container mx-auto px-4 py-8">
        <!-- Dashboard Navigation -->
        <div class="mb-6">
            <a href="{{ route('freelancer.dashboard') }}" class="inline-flex items-center text-primary hover:text-opacity-80 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                Back to Dashboard
            </a>
        </div>

        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Orders</h1>
                <p class="text-gray-600 mt-1">Manage your client orders and requests</p>
            </div>
            <div class="mt-4 md:mt-0">
                <div class="flex items-center space-x-3">
                    <select class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary">
                        <option>All Orders</option>
                        <option>Pending</option>
                        <option>In Progress</option>
                        <option>Completed</option>
                        <option>Canceled</option>
                    </select>
                    <button class="bg-white border border-gray-300 rounded-md px-3 py-2 text-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Orders Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Order 1: Pending -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow">
                <div class="p-5">
                    <div class="flex justify-between items-start">
                        <div>
                            <span class="text-xs font-medium text-gray-500">Order ID: #ORD-2023-8745</span>
                            <h3 class="font-semibold text-lg mt-1">Logo Design</h3>
                        </div>
                        <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                            Pending
                        </span>
                    </div>
                    
                    <div class="mt-4 space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Client:</span>
                            <span class="font-medium text-gray-900">Sarah Johnson</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Package:</span>
                            <span class="font-medium text-gray-900">Premium</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Price:</span>
                            <span class="font-medium text-gray-900">$150.00</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Payment:</span>
                            <span class="px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                Paid (Credit Card)
                            </span>
                        </div>
                    </div>
                    
                    <div class="mt-5 flex flex-col gap-2">
                        <div class="grid grid-cols-2 gap-2">
                            <button class="primary-gradient text-white rounded-md py-2 text-sm font-medium hover:opacity-90 transition-opacity">
                                Accept
                            </button>
                            <button class="bg-white border border-gray-300 text-gray-700 rounded-md py-2 text-sm font-medium hover:bg-gray-50 transition-colors">
                                Reject
                            </button>
                        </div>
                        <a href="{{ route('chat') }}" class="text-center bg-white border border-primary text-primary rounded-md py-2 text-sm font-medium hover:bg-gray-50 transition-colors">
                            Message Client  
                        </a>
                    </div>
                </div>
            </div>

            <!-- Order 2: In Progress -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow">
                <div class="p-5">
                    <div class="flex justify-between items-start">
                        <div>
                            <span class="text-xs font-medium text-gray-500">Order ID: #ORD-2023-8732</span>
                            <h3 class="font-semibold text-lg mt-1">Website Redesign</h3>
                        </div>
                        <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            In Progress
                        </span>
                    </div>
                    
                    <div class="mt-4 space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Client:</span>
                            <span class="font-medium text-gray-900">Michael Thompson</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Package:</span>
                            <span class="font-medium text-gray-900">Standard</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Price:</span>
                            <span class="font-medium text-gray-900">$350.00</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Payment:</span>
                            <span class="px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                Paid (PayPal)
                            </span>
                        </div>
                    </div>
                    
                    <div class="mt-5 flex flex-col gap-2">
                        <a href="{{ route('chat') }}" class="text-center bg-white border border-primary text-primary rounded-md py-2 text-sm font-medium hover:bg-gray-50 transition-colors">
                            Message Client  
                        </a>
                    </div>
                </div>
            </div>

            <!-- Order 3: Completed -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow">
                <div class="p-5">
                    <div class="flex justify-between items-start">
                        <div>
                            <span class="text-xs font-medium text-gray-500">Order ID: #ORD-2023-8713</span>
                            <h3 class="font-semibold text-lg mt-1">Content Writing</h3>
                        </div>
                        <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            Completed
                        </span>
                    </div>
                    
                    <div class="mt-4 space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Client:</span>
                            <span class="font-medium text-gray-900">Emily Rodriguez</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Package:</span>
                            <span class="font-medium text-gray-900">Basic</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Price:</span>
                            <span class="font-medium text-gray-900">$75.00</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Payment:</span>
                            <span class="px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                Paid (Bank Transfer)
                            </span>
                        </div>
                    </div>
                    
                    <div class="mt-5 flex flex-col gap-2">
                        <a href="{{ route('chat') }}" class="text-center bg-white border border-primary text-primary rounded-md py-2 text-sm font-medium hover:bg-gray-50 transition-colors">
                            Message Client  
                        </a>
                    </div>
                </div>
            </div>

            <!-- Order 4: Canceled -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow">
                <div class="p-5">
                    <div class="flex justify-between items-start">
                        <div>
                            <span class="text-xs font-medium text-gray-500">Order ID: #ORD-2023-8695</span>
                            <h3 class="font-semibold text-lg mt-1">Business Consultation</h3>
                        </div>
                        <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            Canceled
                        </span>
                    </div>
                    
                    <div class="mt-4 space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Client:</span>
                            <span class="font-medium text-gray-900">James Wilson</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Package:</span>
                            <span class="font-medium text-gray-900">Premium</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Price:</span>
                            <span class="font-medium text-gray-900">$250.00</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Payment:</span>
                            <span class="px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800">
                                Refunded
                            </span>
                        </div>
                    </div>
                    
                    <div class="mt-5 flex flex-col gap-2">
                        <a href="{{ route('chat') }}" class="text-center bg-white border border-primary text-primary rounded-md py-2 text-sm font-medium hover:bg-gray-50 transition-colors">
                            Message Client  
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-8 flex justify-center">
            <nav class="flex items-center space-x-1">
                <a href="#" class="p-2 rounded-md border border-gray-300 text-gray-500 hover:bg-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </a>
                <a href="#" class="px-3 py-2 rounded-md border border-primary bg-primary text-white">1</a>
                <a href="#" class="px-3 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-50">2</a>
                <a href="#" class="px-3 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-50">3</a>
                <span class="px-3 py-2 text-gray-500">...</span>
                <a href="#" class="px-3 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-50">8</a>
                <a href="#" class="p-2 rounded-md border border-gray-300 text-gray-500 hover:bg-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </a>
            </nav>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Orders page loaded');
            // Placeholder for any future JavaScript functionality
        });
    </script>
@endsection