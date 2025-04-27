@extends('layouts.app')

@section('title', 'Client Dashboard - FreelanceHub')

@section('content')
    <main class="flex-grow container mx-auto px-4 py-8">
        <!-- Welcome Section -->
        <section class="mb-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Welcome, {{ Auth::user()->name }}!</h1>
                    <p class="text-gray-600 mt-1">Here's what's happening with your projects today.</p>
                    @if ($activeOrdersCount == 0)
                        <p class="text-sm text-purple-600 mt-2">New here? <a href="{{ route('client.services') }}" class="underline hover:text-purple-800">Explore services to get started!</a></p>
                    @endif
                </div>
            </div>
        </section>

        <!-- Stats Cards -->
        <section class="mb-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4">
            <!-- Active Orders Card -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
                <div class="flex items-center">
                    <div class="rounded-full p-3 bg-blue-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Active Orders</p>
                        <h2 class="text-2xl font-semibold text-gray-800">{{ $activeOrdersCount }}</h2>
                    </div>
                </div>
            </div>

            <!-- Total Spent Card -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
                <div class="flex items-center">
                    <div class="rounded-full p-3 bg-green-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Spent</p>
                        <h2 class="text-2xl font-semibold text-gray-800">${{ number_format($totalSpent, 2) }}</h2>
                    </div>
                </div>
            </div>

            <!-- Last Payment Card -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
                <div class="flex items-center">
                    <div class="rounded-full p-3 bg-purple-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Last Payment</p>
                        <h2 class="text-2xl font-semibold text-gray-800">
                            @if ($lastPayment)
                                ${{ number_format($lastPayment->amount, 2) }}
                            @else
                                $0.00
                            @endif
                        </h2>
                    </div>
                </div>
            </div>
        </section>

        <!-- Quick Actions Grid -->
        <section class="mb-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Quick Actions</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Manage Profile -->
                <a href="{{ route('profile.show') }}" class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 hover:shadow-md transition group">
                    <div class="flex items-center">
                        <div class="rounded-full p-3 bg-gray-100 group-hover:bg-purple-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 group-hover:text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="font-semibold text-gray-800 group-hover:text-purple-600">Manage Profile</h3>
                            <p class="text-sm text-gray-500">View and update your settings</p>
                        </div>
                    </div>
                </a>

                <!-- Explore Services -->
                <a href="{{ route('client.services') }}" class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 hover:shadow-md transition group">
                    <div class="flex items-center">
                        <div class="rounded-full p-3 bg-gray-100 group-hover:bg-purple-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 group-hover:text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="font-semibold text-gray-800 group-hover:text-purple-600">Explore Services</h3>
                            <p class="text-sm text-gray-500">Discover freelancer offerings</p>
                        </div>
                    </div>
                </a>

                <!-- Order History -->
                <a href="{{ route('client.orders') }}" class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 hover:shadow-md transition group">
                    <div class="flex items-center">
                        <div class="rounded-full p-3 bg-gray-100 group-hover:bg-purple-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 group-hover:text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="font-semibold text-gray-800 group-hover:text-purple-600">Order History</h3>
                            <p class="text-sm text-gray-500">View past and current orders</p>
                        </div>
                    </div>
                </a>

                <!-- Communicate -->
                <a href="{{ route('chat.index') }}" class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 hover:shadow-md transition group">
                    <div class="flex items-center">
                        <div class="rounded-full p-3 bg-gray-100 group-hover:bg-purple-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 group-hover:text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="font-semibold text-gray-800 group-hover:text-purple-600">Communicate</h3>
                            <p class="text-sm text-gray-500">Message with freelancers</p>
                        </div>
                    </div>
                </a>

                <!-- Manage Reviews -->
                <a href="{{ route('client.reviews') }}" class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 hover:shadow-md transition group">
                    <div class="flex items-center">
                        <div class="rounded-full p-3 bg-gray-100 group-hover:bg-purple-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 group-hover:text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="font-semibold text-gray-800 group-hover:text-purple-600">Manage Reviews</h3>
                            <p class="text-sm text-gray-500">Write and edit your reviews</p>
                        </div>
                    </div>
                </a>
            </div>
        </section>

        <!-- Order Status Distribution Chart -->
        <section class="mb-8">
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Order Status Distribution</h2>
                <div class="h-80">
                    <canvas id="orderStatusChart"></canvas>
                </div>
            </div>
        </section>

        <!-- Recent Orders -->
        <section class="mb-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Recent Orders</h2>
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-4 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="font-medium">Your Recent Orders</h3>
                    <a href="{{ route('client.orders') }}" class="text-sm font-medium text-purple-600 hover:underline">View All</a>
                </div>
                <div class="divide-y divide-gray-100">
                    @if ($recentOrders->isNotEmpty())
                        @foreach ($recentOrders as $order)
                            <div class="p-4">
                                <div class="flex justify-between items-start mb-2">
                                    <h4 class="font-medium text-gray-800">{{ $order->service->title ?? 'N/A' }}</h4>
                                    <span class="px-2 py-1 text-xs font-medium rounded-full 
                                        @if ($order->status === 'pending') bg-yellow-100 text-yellow-800
                                        @elseif ($order->status === 'in_progress') bg-blue-100 text-blue-800
                                        @elseif ($order->status === 'completed') bg-green-100 text-green-800
                                        @endif">
                                        {{ ucwords(str_replace('_', ' ', $order->status)) }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-600 mb-2">Order #{{ $order->id }} - ${{ number_format($order->amount, 2) }}</p>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-500">Freelancer: {{ $order->service->user->name ?? 'N/A' }}</span>
                                    <div>
                                        <a href="{{ route('chat.index') }}" class="px-3 py-1 text-xs font-medium rounded bg-purple-600 text-white hover:bg-purple-700">Message</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="p-4 text-center">
                            <p class="text-gray-600">No recent orders yet.</p>
                            <a href="{{ route('client.services') }}" class="text-sm text-purple-600 hover:underline">Explore services to place your first order!</a>
                        </div>
                    @endif
                </div>
            </div>
        </section>

        <!-- Recommended Services -->
        <section class="mb-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Recommended Services</h2>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                @if ($recommendedServices->isNotEmpty())
                    @foreach ($recommendedServices as $service)
                        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-4">
                            <div class="flex items-center mb-2">
                                <div class="rounded-md bg-purple-100 p-2 mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">{{ $service->title }}</p>
                                    <p class="text-sm text-gray-500">By {{ $service->user->name ?? 'N/A' }}</p>
                                </div>
                            </div>
                            <p class="text-sm text-gray-600 mb-2 line-clamp-2">{{ $service->description }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-medium text-gray-800">Rating: {{ number_format($service->rating, 1) }}/5</span>
                                <a href="{{ route('client.services') }}" class="text-sm text-purple-600 hover:underline">View Details</a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-4 col-span-3 text-center">
                        <p class="text-gray-600">No recommended services available right now.</p>
                    </div>
                @endif
            </div>
        </section>

        <!-- Getting Started Section -->
        @if ($showGettingStarted)
            <section class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Getting Started</h2>
                <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
                    <h3 class="font-medium text-gray-800 mb-4">Welcome to FreelanceHub! Here's how to get started:</h3>
                    <div class="flex items-start mb-4">
                        <div class="w-8 h-8 rounded-full bg-purple-600 flex items-center justify-center flex-shrink-0 mr-4">
                            <span class="text-white font-medium">1</span>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-800">Complete your profile</h4>
                            <p class="text-sm text-gray-600 mt-1">Add your details and preferences to help freelancers understand your needs.</p>
                        </div>
                    </div>
                    <div class="flex items-start mb-4">
                        <div class="w-8 h-8 rounded-full bg-purple-600 flex items-center justify-center flex-shrink-0 mr-4">
                            <span class="text-white font-medium">2</span>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-800">Explore services</h4>
                            <p class="text-sm text-gray-600 mt-1">Browse through our catalog of freelancer services to find what you need.</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="w-8 h-8 rounded-full bg-purple-600 flex items-center justify-center flex-shrink-0 mr-4">
                            <span class="text-white font-medium">3</span>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-800">Place your first order</h4>
                            <p class="text-sm text-gray-600 mt-1">Select a service and place an order to start working with a freelancer.</p>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    </main>

    @section('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Order Status Distribution Chart (Pie)
            const orderStatusCtx = document.getElementById('orderStatusChart').getContext('2d');
            new Chart(orderStatusCtx, {
                type: 'pie',
                data: {
                    labels: [@foreach($orderStatusDistribution as $data) '{{ ucwords(str_replace('_', ' ', $data->status)) }}', @endforeach],
                    datasets: [{
                        label: 'Order Status',
                        data: [@foreach($orderStatusDistribution as $data) {{ $data->count }}, @endforeach],
                        backgroundColor: [
                            'rgba(234, 179, 8, 0.7)', // Yellow for Pending
                            'rgba(59, 130, 246, 0.7)', // Blue for In Progress
                            'rgba(34, 197, 94, 0.7)',  // Green for Completed
                        ],
                        borderColor: [
                            'rgba(234, 179, 8, 1)',
                            'rgba(59, 130, 246, 1)',
                            'rgba(34, 197, 94, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    label += context.raw + ' order(s)';
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
        </script>
    @endsection
@endsection