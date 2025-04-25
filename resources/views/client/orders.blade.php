@extends('layouts.app')

@section('title', 'Order History - FreelanceHub')

@section('content')
    <main class="flex-grow container mx-auto px-4 py-8 max-w-6xl">
        <!-- Back to Dashboard Link -->
        <a href="{{ route('client.dashboard') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 mb-6 font-medium transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
            </svg>
            Back to Dashboard
        </a>

        <!-- Page Header with Title and Stats -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-4 sm:mb-0">Your Order History</h1>
            <div class="flex space-x-4">
                <div class="bg-white rounded-lg shadow-sm px-4 py-3 flex flex-col items-center">
                    <span class="text-sm text-gray-500">Total Orders</span>
                    <span class="text-xl font-semibold text-gray-800">{{ $orders->count() }}</span>
                </div>
                <div class="bg-white rounded-lg shadow-sm px-4 py-3 flex flex-col items-center">
                    <span class="text-sm text-gray-500">Active</span>
                    <span class="text-xl font-semibold text-gray-800">{{ $orders->where('status', 'in_progress')->count() }}</span>
                </div>
            </div>
        </div>

        <!-- Orders Container -->
        <div class="orders-container">
            <!-- Has Orders View -->
            @if ($orders->isNotEmpty())
                <div class="has-orders space-y-6">
                    <!-- Responsive Orders List -->
                    <div class="grid grid-cols-1 lg:grid-cols-1 gap-4">
                        @foreach ($orders as $order)
                            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                                <div class="p-4 border-b border-gray-100 flex items-center">
                                    <div class="h-10 w-10 flex-shrink-0 rounded bg-indigo-100 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3 flex-grow">
                                        <div class="flex flex-col sm:flex-row sm:justify-between">
                                            <h3 class="text-sm font-medium text-gray-900">{{ $order->service->title }}</h3>
                                            <span class="text-xs text-gray-500 mt-1 sm:mt-0">Order #{{ $order->id }}</span>
                                        </div>
                                    </div>
                                    <div class="hidden sm:block">
                                        @php
                                            $statusColor = [
                                                'pending' => 'bg-gray-100 text-gray-800',
                                                'in_progress' => 'bg-yellow-100 text-yellow-800',
                                                'completed' => 'bg-green-100 text-green-800',
                                            ];
                                            $dotColor = [
                                                'pending' => 'bg-gray-400',
                                                'in_progress' => 'bg-yellow-400',
                                                'completed' => 'bg-green-400',
                                            ];
                                        @endphp
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColor[$order->status] }}">
                                            <span class="h-2 w-2 mr-1 rounded-full {{ $dotColor[$order->status] }}"></span>
                                            {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="p-4 grid grid-cols-1 sm:grid-cols-3 gap-4">
                                    <div>
                                        <div class="text-xs text-gray-500 mb-1">Package</div>
                                        <div class="text-sm font-medium">{{ $order->package->name }}</div>
                                        <div class="mt-1 text-sm text-gray-700">${{ number_format($order->amount, 2) }}</div>
                                    </div>
                                    <div>
                                        <div class="text-xs text-gray-500 mb-1">Freelancer</div>
                                        <div class="text-sm">{{ $order->service->user->name }}</div>
                                    </div>
                                    <div>
                                        <div class="text-xs text-gray-500 mb-1">Date Ordered</div>
                                        <div class="text-sm">{{ $order->created_at->format('F d, Y') }}</div>
                                        <div class="sm:hidden mt-2">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColor[$order->status] }}">
                                                <span class="h-2 w-2 mr-1 rounded-full {{ $dotColor[$order->status] }}"></span>
                                                {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="px-6 py-4">
                        {{ $orders->links() }}
                    </div>
                </div>
            @else
                <!-- Empty State - No Orders -->
                <div class="empty-state">
                    <div class="bg-white rounded-lg shadow-sm p-8 text-center">
                        <div class="mx-auto w-24 h-24 rounded-full bg-gray-100 flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-medium text-gray-900 mb-2">You have no orders yet</h3>
                        <p class="text-base text-gray-500 mb-8 max-w-md mx-auto">Start by exploring services and finding the right freelancer for your project needs.</p>
                        <a href="{{ route('client.services') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg shadow-sm text-white primary-gradient hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Explore Services
                            <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 -mr-1 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </main>
@endsection