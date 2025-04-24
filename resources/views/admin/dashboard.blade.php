@extends('layouts.admin')

@section('title', 'Admin Dashboard - FreelanceHub')
@section('page-title', 'Dashboard')
@section('search-placeholder', '')

@section('content')
    <!-- Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <!-- Users Card -->
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h3 class="text-md font-semibold text-gray-800 mb-2">Total Users</h3>
            <p class="text-2xl font-bold text-gray-900">{{ $totalUsers }}</p>
            <p class="text-sm text-gray-600 mt-2">Freelancers: {{ $freelancers }}</p>
            <p class="text-sm text-gray-600">Clients: {{ $clients }}</p>
            <p class="text-sm text-gray-600">Both: {{ $usersInBothRoles }}</p>
        </div>

        <!-- Services Card -->
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h3 class="text-md font-semibold text-gray-800 mb-2">Total Services</h3>
            <p class="text-2xl font-bold text-gray-900">{{ $totalServices }}</p>
            <p class="text-sm text-gray-600 mt-2">Active: {{ $activeServices }}</p>
            <p class="text-sm text-gray-600">Inactive: {{ $inactiveServices }}</p>
        </div>

        <!-- Orders Card -->
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h3 class="text-md font-semibold text-gray-800 mb-2">Total Orders</h3>
            <p class="text-2xl font-bold text-gray-900">{{ $totalOrders }}</p>
            <p class="text-sm text-gray-600 mt-2">Pending: {{ $pendingOrders }}</p>
            <p class="text-sm text-gray-600">In Progress: {{ $inProgressOrders }}</p>
            <p class="text-sm text-gray-600">Completed: {{ $completedOrders }}</p>
        </div>

        <!-- Revenue Card -->
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h3 class="text-md font-semibold text-gray-800 mb-2">Total Revenue</h3>
            <p class="text-2xl font-bold text-gray-900">${{ number_format($totalRevenue, 2) }}</p>
        </div>
    </div>

    <!-- Charts -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Services by Category -->
        <div class="bg-white p-6 rounded-xl shadow-md">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-gray-800">Services by Category</h2>
                <form method="GET" action="{{ route('admin.dashboard') }}" class="flex gap-2">
                    <select id="status-filter" name="status" class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        <option value="All Statuses" {{ $status === 'All Statuses' ? 'selected' : '' }}>All Statuses</option>
                        <option value="active" {{ $status === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </form>
            </div>
            <div class="h-80">
                <canvas id="servicesByCategoryChart"></canvas>
            </div>
        </div>

        <!-- Service Status Distribution -->
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Service Status Distribution</h2>
            <div class="h-80">
                <canvas id="serviceStatusChart"></canvas>
            </div>
        </div>

        <!-- User Distribution -->
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">User Distribution</h2>
            <div class="h-80">
                <canvas id="userDistributionChart"></canvas>
            </div>
        </div>

        <!-- Orders Over Time -->
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Orders Over Time (Last 30 Days)</h2>
            <div class="h-80">
                <canvas id="ordersOverTimeChart"></canvas>
            </div>
        </div>
    </div>

    @section('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Auto-submit the status filter for Services by Category
            document.addEventListener('DOMContentLoaded', function () {
                const statusFilter = document.getElementById('status-filter');
                if (statusFilter) {
                    statusFilter.addEventListener('change', function () {
                        this.form.submit();
                    });
                }
            });

            // Services by Category Chart (Bar)
            const servicesByCategoryCtx = document.getElementById('servicesByCategoryChart').getContext('2d');
            new Chart(servicesByCategoryCtx, {
                type: 'bar',
                data: {
                    labels: [@foreach($servicesByCategory as $data) '{{ $data->category_name }}', @endforeach],
                    datasets: [{
                        label: 'Number of Services',
                        data: [@foreach($servicesByCategory as $data) {{ $data->service_count }}, @endforeach],
                        backgroundColor: 'rgba(124, 58, 237, 0.6)', // Purple
                        borderColor: 'rgba(124, 58, 237, 1)',
                        borderWidth: 1
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
                                text: 'Number of Services'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Category'
                            }
                        }
                    }
                }
            });

            // Service Status Distribution Chart (Pie)
            const serviceStatusCtx = document.getElementById('serviceStatusChart').getContext('2d');
            new Chart(serviceStatusCtx, {
                type: 'pie',
                data: {
                    labels: [@foreach($serviceStatusDistribution as $data) '{{ ucfirst($data->status) }}', @endforeach],
                    datasets: [{
                        label: 'Service Status',
                        data: [@foreach($serviceStatusDistribution as $data) {{ $data->count }}, @endforeach],
                        backgroundColor: [
                            'rgba(34, 197, 94, 0.6)',  // Green for Active
                            'rgba(239, 68, 68, 0.6)',  // Red for Inactive
                        ],
                        borderColor: [
                            'rgba(34, 197, 94, 1)',
                            'rgba(239, 68, 68, 1)',
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
                                    const total = context.dataset.data.reduce((sum, value) => sum + value, 0);
                                    const percentage = ((context.raw / total) * 100).toFixed(1);
                                    label += `${context.raw} (${percentage}%)`;
                                    return label;
                                }
                            }
                        }
                    }
                }
            });

            // User Distribution Chart (Doughnut)
            const userDistributionCtx = document.getElementById('userDistributionChart').getContext('2d');
            new Chart(userDistributionCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Freelancers Only', 'Clients Only', 'Both'],
                    datasets: [{
                        label: 'User Distribution',
                        data: [
                            {{ $freelancers - $usersInBothRoles }},
                            {{ $clients - $usersInBothRoles }},
                            {{ $usersInBothRoles }}
                        ],
                        backgroundColor: [
                            'rgba(59, 130, 246, 0.6)',  // Blue for Freelancers
                            'rgba(234, 179, 8, 0.6)',   // Yellow for Clients
                            'rgba(147, 51, 234, 0.6)',  // Purple for Both
                        ],
                        borderColor: [
                            'rgba(59, 130, 246, 1)',
                            'rgba(234, 179, 8, 1)',
                            'rgba(147, 51, 234, 1)',
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
                        }
                    }
                }
            });

            // Orders Over Time Chart (Line)
            const ordersOverTimeCtx = document.getElementById('ordersOverTimeChart').getContext('2d');
            new Chart(ordersOverTimeCtx, {
                type: 'line',
                data: {
                    labels: [@foreach($ordersOverTime as $data) '{{ $data->date }}', @endforeach],
                    datasets: [{
                        label: 'Orders',
                        data: [@foreach($ordersOverTime as $data) {{ $data->order_count }}, @endforeach],
                        fill: false,
                        borderColor: 'rgba(16, 185, 129, 1)', // Emerald
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
                                text: 'Number of Orders'
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