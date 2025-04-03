<!-- resources/views/freelancer/transactions.blade.php -->
@extends('layouts.app')

@section('title', 'Transactions - FreelanceHub')

@section('content')
    <main class="flex-grow px-4 py-6 max-w-7xl mx-auto w-full">
        <!-- Page Header -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Transactions</h1>
                <p class="text-gray-500">View your payment history and transaction details</p>
            </div>
            <a href="{{ route('freelancer.dashboard') }}" class="flex items-center text-primary hover:text-opacity-80 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                Back to Dashboard
            </a>
        </div>

        <!-- Transactions List -->
        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            <!-- Transaction 1 -->
            <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-100">
                <div class="flex justify-between items-start mb-3">
                    <div>
                        <span class="text-xs text-gray-500">Transaction ID</span>
                        <p class="font-medium text-gray-800">TRX-23401</p>
                    </div>
                    <span class="text-lg font-semibold text-gray-800">$150.00</span>
                </div>
                <div class="grid grid-cols-2 gap-3 mb-3">
                    <div>
                        <span class="text-xs text-gray-500">Payment Method</span>
                        <p class="font-medium text-gray-700">PayPal</p>
                    </div>
                    <div>
                        <span class="text-xs text-gray-500">Status</span>
                        <p class="inline-block px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Completed</p>
                    </div>
                </div>
                <div class="border-t border-gray-100 pt-3 mb-3">
                    <div class="mb-2">
                        <span class="text-xs text-gray-500">Order ID</span>
                        <p class="font-medium text-gray-700">ORD-78923</p>
                    </div>
                    <div class="mb-2">
                        <span class="text-xs text-gray-500">Client</span>
                        <p class="font-medium text-gray-700">James Wilson</p>
                    </div>
                    <div>
                        <span class="text-xs text-gray-500">Service</span>
                        <p class="font-medium text-gray-700">Logo Design</p>
                    </div>
                </div>
                <div class="text-xs text-gray-500 mt-2">
                    <span>March 18, 2025</span>
                </div>
            </div>

            <!-- Transaction 2 -->
            <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-100">
                <div class="flex justify-between items-start mb-3">
                    <div>
                        <span class="text-xs text-gray-500">Transaction ID</span>
                        <p class="font-medium text-gray-800">TRX-23402</p>
                    </div>
                    <span class="text-lg font-semibold text-gray-800">$250.00</span>
                </div>
                <div class="grid grid-cols-2 gap-3 mb-3">
                    <div>
                        <span class="text-xs text-gray-500">Payment Method</span>
                        <p class="font-medium text-gray-700">Credit Card</p>
                    </div>
                    <div>
                        <span class="text-xs text-gray-500">Status</span>
                        <p class="inline-block px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Pending</p>
                    </div>
                </div>
                <div class="border-t border-gray-100 pt-3 mb-3">
                    <div class="mb-2">
                        <span class="text-xs text-gray-500">Order ID</span>
                        <p class="font-medium text-gray-700">ORD-78924</p>
                    </div>
                    <div class="mb-2">
                        <span class="text-xs text-gray-500">Client</span>
                        <p class="font-medium text-gray-700">Sarah Johnson</p>
                    </div>
                    <div>
                        <span class="text-xs text-gray-500">Service</span>
                        <p class="font-medium text-gray-700">Website Development</p>
                    </div>
                </div>
                <div class="text-xs text-gray-500 mt-2">
                    <span>March 19, 2025</span>
                </div>
            </div>

            <!-- Transaction 3 -->
            <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-100">
                <div class="flex justify-between items-start mb-3">
                    <div>
                        <span class="text-xs text-gray-500">Transaction ID</span>
                        <p class="font-medium text-gray-800">TRX-23403</p>
                    </div>
                    <span class="text-lg font-semibold text-gray-800">$75.00</span>
                </div>
                <div class="grid grid-cols-2 gap-3 mb-3">
                    <div>
                        <span class="text-xs text-gray-500">Payment Method</span>
                        <p class="font-medium text-gray-700">Bank Transfer</p>
                    </div>
                    <div>
                        <span class="text-xs text-gray-500">Status</span>
                        <p class="inline-block px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Processing</p>
                    </div>
                </div>
                <div class="border-t border-gray-100 pt-3 mb-3">
                    <div class="mb-2">
                        <span class="text-xs text-gray-500">Order ID</span>
                        <p class="font-medium text-gray-700">ORD-78925</p>
                    </div>
                    <div class="mb-2">
                        <span class="text-xs text-gray-500">Client</span>
                        <p class="font-medium text-gray-700">Michael Thompson</p>
                    </div>
                    <div>
                        <span class="text-xs text-gray-500">Service</span>
                        <p class="font-medium text-gray-700">Content Writing</p>
                    </div>
                </div>
                <div class="text-xs text-gray-500 mt-2">
                    <span>March 19, 2025</span>
                </div>
            </div>
        </div>
    </main>
@endsection