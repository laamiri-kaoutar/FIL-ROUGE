@php
    $showSearch = false;
@endphp
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
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Orders</h1>
            <p class="text-gray-600 mt-1">Manage your client orders and requests</p>
        </div>

        <!-- Success/Error Messages -->
        @if (session('success'))
            <div id="success-message" class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div id="error-message" class="mb-6 p-4 bg-red-100 text-red-800 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        <!-- Kanban Board -->
        @if ($orders->isNotEmpty())
            <div class="flex flex-col lg:flex-row gap-6">
                <!-- Pending Column -->
                <div class="flex-1 bg-gray-100 rounded-lg p-4">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Pending</h2>
                    <div class="kanban-column min-h-[200px]">
                        @foreach ($orders->where('status', 'pending') as $order)
                            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5 mb-4">
                                <div class="flex justify-between items-start">
                                    <h3 class="font-semibold text-lg">{{ $order->service->title }}</h3>
                                    <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Pending
                                    </span>
                                </div>
                                <div class="mt-4 space-y-3">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Client:</span>
                                        <span class="font-medium text-gray-900">{{ $order->user->name }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Package:</span>
                                        <span class="font-medium text-gray-900">{{ $order->package->name }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Price:</span>
                                        <span class="font-medium text-gray-900">${{ number_format($order->amount, 2) }}</span>
                                    </div>
                                </div>
                                <div class="mt-5 flex flex-col gap-2">
                                    <form action="{{ route('freelancer.orders.update-status', $order->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status" value="in_progress">
                                        <button type="submit" class="w-full bg-blue-600 text-white rounded-md py-2 text-sm font-medium hover:bg-blue-700 transition">
                                            Start
                                        </button>
                                    </form>
                                    <a href="{{ route('chat') }}" class="text-center bg-white border border-primary text-primary rounded-md py-2 text-sm font-medium hover:bg-gray-50 transition-colors">
                                        Message Client
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- In Progress Column -->
                <div class="flex-1 bg-gray-100 rounded-lg p-4">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">In Progress</h2>
                    <div class="kanban-column min-h-[200px]">
                        @foreach ($orders->where('status', 'in_progress') as $order)
                            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5 mb-4">
                                <div class="flex justify-between items-start">
                                    <h3 class="font-semibold text-lg">{{ $order->service->title }}</h3>
                                    <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        In Progress
                                    </span>
                                </div>
                                <div class="mt-4 space-y-3">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Client:</span>
                                        <span class="font-medium text-gray-900">{{ $order->user->name }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Package:</span>
                                        <span class="font-medium text-gray-900">{{ $order->package->name }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Price:</span>
                                        <span class="font-medium text-gray-900">${{ number_format($order->amount, 2) }}</span>
                                    </div>
                                </div>
                                <div class="mt-5 flex flex-col gap-2">
                                    <form action="{{ route('freelancer.orders.update-status', $order->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status" value="completed">
                                        <button type="submit" class="w-full bg-green-600 text-white rounded-md py-2 text-sm font-medium hover:bg-green-700 transition">
                                            Complete
                                        </button>
                                    </form>
                                    <a href="{{ route('chat') }}" class="text-center bg-white border border-primary text-primary rounded-md py-2 text-sm font-medium hover:bg-gray-50 transition-colors">
                                        Message Client
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Completed Column -->
                <div class="flex-1 bg-gray-100 rounded-lg p-4">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Completed</h2>
                    <div class="kanban-column min-h-[200px]">
                        @foreach ($orders->where('status', 'completed') as $order)
                            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5 mb-4">
                                <div class="flex justify-between items-start">
                                    <h3 class="font-semibold text-lg">{{ $order->service->title }}</h3>
                                    <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Completed
                                    </span>
                                </div>
                                <div class="mt-4 space-y-3">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Client:</span>
                                        <span class="font-medium text-gray-900">{{ $order->user->name }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Package:</span>
                                        <span class="font-medium text-gray-900">{{ $order->package->name }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Price:</span>
                                        <span class="font-medium text-gray-900">${{ number_format($order->amount, 2) }}</span>
                                    </div>
                                </div>
                                <div class="mt-5 flex flex-col gap-2">
                                    <form action="{{ route('freelancer.orders.update-status', $order->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status" value="in_progress">
                                        <button type="submit" class="w-full bg-yellow-600 text-white rounded-md py-2 text-sm font-medium hover:bg-yellow-700 transition">
                                            Restart
                                        </button>
                                    </form>
                                    <a href="{{ route('chat') }}" class="text-center bg-white border border-primary text-primary rounded-md py-2 text-sm font-medium hover:bg-gray-50 transition-colors">
                                        Message Client
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-lg shadow-md p-8 text-center max-w-md mx-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">No Orders Yet</h3>
                <p class="text-gray-600 mb-6">You don't have any orders at the moment. Check back later!</p>
                <a href="{{ route('freelancer.services') }}" class="inline-block px-6 py-3 bg-primary text-white rounded-md hover:opacity-90 transition">Manage Services</a>
            </div>
        @endif
    </main>
@endsection
@section('scripts')
    <script>
        function hideMessage(elementId) {
            const element = document.getElementById(elementId);
            if (element) {
                element.style.transition = 'opacity 0.5s ease';
                element.style.opacity = '0';
                
                setTimeout(() => {
                    element.remove();
                }, 500); 
            }
        }

        setTimeout(() => {
            hideMessage('success-message');
            hideMessage('error-message');
        }, 5000);
    </script>
@endsection

