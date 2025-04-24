@extends('layouts.app')

@section('title', 'Freelancer Dashboard - FreelanceHub')

@section('content')
    <main class="flex-grow container mx-auto px-4 py-8">
        <!-- Welcome Section -->
        <section class="mb-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Welcome, {{ Auth::user()->name }}</h1>
                    <p class="text-gray-600 mt-1">Here's what's happening with your account today.</p>
                    @if ($activeServicesCount == 0)
                        <p class="text-sm text-purple-600 mt-2">New here? <a href="{{ route('freelancer.services') }}" class="underline hover:text-purple-800">Start by creating your first service!</a></p>
                    @endif
                </div>
            </div>
        </section>

        <!-- Stats Cards -->
        <section class="mb-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <!-- Active Services Card -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
                <div class="flex items-center">
                    <div class="rounded-full p-3 bg-blue-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Active Services</p>
                        <h2 class="text-2xl font-semibold text-gray-800">{{ $activeServicesCount }}</h2>
                    </div>
                </div>
            </div>

            <!-- Pending Orders Card -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
                <div class="flex items-center">
                    <div class="rounded-full p-3 bg-yellow-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Pending Orders</p>
                        <h2 class="text-2xl font-semibold text-gray-800">{{ $pendingOrdersCount }}</h2>
                    </div>
                </div>
            </div>

            <!-- Last Transaction Card -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
                <div class="flex items-center">
                    <div class="rounded-full p-3 bg-green-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Last Transaction</p>
                        <h2 class="text-2xl font-semibold text-gray-800">
                            @if ($lastTransaction)
                                ${{ number_format($lastTransaction->amount, 2) }}
                            @else
                                $0.00
                            @endif
                        </h2>
                    </div>
                </div>
            </div>

            <!-- Total Earnings Card -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
                <div class="flex items-center">
                    <div class="rounded-full p-3 bg-purple-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Earnings</p>
                        <h2 class="text-2xl font-semibold text-gray-800">${{ number_format($totalEarnings, 2) }}</h2>
                    </div>
                </div>
            </div>
        </section>

        <!-- Quick Actions Grid -->
        <section class="mb-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Quick Actions</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Create New Service -->
                <a href="{{ route('freelancer.services') }}" class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 hover:shadow-md transition group">
                    <div class="flex items-center">
                        <div class="rounded-full p-3 bg-gray-100 group-hover:bg-purple-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 group-hover:text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="font-semibold text-gray-800 group-hover:text-purple-600">Create New Service</h3>
                            <p class="text-sm text-gray-500">Add a new service to your portfolio</p>
                        </div>
                    </div>
                </a>

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
                            <p class="text-sm text-gray-500">Update your professional details</p>
                        </div>
                    </div>
                </a>

                <!-- View Orders -->
                <a href="{{ route('freelancer.demands') }}" class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 hover:shadow-md transition group">
                    <div class="flex items-center">
                        <div class="rounded-full p-3 bg-gray-100 group-hover:bg-purple-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 group-hover:text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="font-semibold text-gray-800 group-hover:text-purple-600">View Orders</h3>
                            <p class="text-sm text-gray-500">Check pending client orders</p>
                        </div>
                    </div>
                </a>

                <!-- Client Communication -->
                <a href="{{ route('chat') }}" class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 hover:shadow-md transition group">
                    <div class="flex items-center">
                        <div class="rounded-full p-3 bg-gray-100 group-hover:bg-purple-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 group-hover:text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="font-semibold text-gray-800 group-hover:text-purple-600">Client Communication</h3>
                            <p class="text-sm text-gray-500">Message and manage clients</p>
                        </div>
                    </div>
                </a>

                <!-- Transaction History -->
                <a href="{{ route('freelancer.transactions') }}" class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 hover:shadow-md transition group">
                    <div class="flex items-center">
                        <div class="rounded-full p-3 bg-gray-100 group-hover:bg-purple-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 group-hover:text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="font-semibold text-gray-800 group-hover:text-purple-600">Transaction History</h3>
                            <p class="text-sm text-gray-500">View your payment records</p>
                        </div>
                    </div>
                </a>

                <!-- Define Pricing -->
                <a href="{{ route('freelancer.services') }}" class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 hover:shadow-md transition group">
                    <div class="flex items-center">
                        <div class="rounded-full p-3 bg-gray-100 group-hover:bg-purple-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 group-hover:text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="font-semibold text-gray-800 group-hover:text-purple-600">Define Pricing</h3>
                            <p class="text-sm text-gray-500">Set rates and service packages</p>
                        </div>
                    </div>
                </a>
            </div>
        </section>

        <!-- Earnings Over Time Chart -->
        <section class="mb-8">
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Earnings Over Time (Last 30 Days)</h2>
                <div class="h-80">
                    <canvas id="earningsOverTimeChart"></canvas>
                </div>
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
                        <a href="{{ route('freelancer.services') }}" class="text-sm font-medium text-purple-600 hover:underline">View All</a>
                    </div>
                    <div class="divide-y divide-gray-100">
                        @if ($activeServices->isNotEmpty())
                            @foreach ($activeServices as $service)
                                <div class="p-4 flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="rounded-md bg-blue-100 p-2 mr-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-800">{{ $service->title }}</p>
                                            <p class="text-sm text-gray-500">
                                                Starting at ${{ $service->package ? number_format($service->package->price, 2) : 'N/A' }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Active</span>
                                        <p class="text-sm text-gray-500 mt-1">
                                            {{ $service->orders()->where('status', 'pending')->count() }} orders in queue
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="p-4 text-center">
                                <p class="text-gray-600">No active services yet.</p>
                                <a href="{{ route('freelancer.services') }}" class="text-sm text-purple-600 hover:underline">Create your first service now!</a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Recent Orders -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-4 border-b border-gray-100 flex justify-between items-center">
                        <h3 class="font-medium">Recent Orders</h3>
                        <a href="{{ route('freelancer.demands') }}" class="text-sm font-medium text-purple-600 hover:underline">View All</a>
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
                                        <span class="text-sm text-gray-500">From: {{ $order->user->name ?? 'N/A' }}</span>
                                        <div>
                                            <a href="{{ route('chat') }}" class="px-3 py-1 text-xs font-medium rounded bg-purple-600 text-white hover:bg-purple-700">Message</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="p-4 text-center">
                                <p class="text-gray-600">No recent orders yet.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </main>

    @section('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Earnings Over Time Chart (Line)
            const earningsOverTimeCtx = document.getElementById('earningsOverTimeChart').getContext('2d');
            new Chart(earningsOverTimeCtx, {
                type: 'line',
                data: {
                    labels: [@foreach($earningsOverTime as $data) '{{ $data->date }}', @endforeach],
                    datasets: [{
                        label: 'Earnings ($)',
                        data: [@foreach($earningsOverTime as $data) {{ $data->total_amount }}, @endforeach],
                        fill: false,
                        borderColor: 'rgba(124, 58, 237, 1)', // Purple
                        tension: 0.1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Earnings ($)'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Date'
                            }
                        }
                    }
                }
            });
        </script>
    @endsection
@endsection