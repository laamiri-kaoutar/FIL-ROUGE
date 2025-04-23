@extends('layouts.admin')

@section('title', 'Orders Management - FreelanceHub Admin')
@section('page-title', 'Orders Management')
@section('search-placeholder', 'Search orders...')

@section('content')
    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-semibold text-gray-800">Manage Orders</h2>
            <a href="{{ route('admin.orders.export', request()->query()) }}" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">Export as PDF</a>
        </div>

        <!-- Filter -->
        <form method="GET" action="{{ route('admin.orders') }}" class="flex flex-col sm:flex-row gap-4 mb-6">
            <input type="hidden" name="search" value="{{ request('search') }}">
            <select id="status-filter" name="status" class="border border-gray-300 rounded-lg p-2 w-full sm:w-48 focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                <option value="All Statuses" {{ request('status', 'All Statuses') === 'All Statuses' ? 'selected' : '' }}>All Statuses</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </form>

        <!-- Orders Table -->
        <div class="overflow-x-auto">
            @if ($orders->isNotEmpty())
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="py-3 px-4 text-sm font-semibold text-gray-700">Order ID</th>
                            <th class="py-3 px-4 text-sm font-semibold text-gray-700">Client</th>
                            <th class="py-3 px-4 text-sm font-semibold text-gray-700">Freelancer</th>
                            <th class="py-3 px-4 text-sm font-semibold text-gray-700">Service</th>
                            <th class="py-3 px-4 text-sm font-semibold text-gray-700">Package</th>
                            <th class="py-3 px-4 text-sm font-semibold text-gray-700">Amount</th>
                            <th class="py-3 px-4 text-sm font-semibold text-gray-700">Status</th>
                            <th class="py-3 px-4 text-sm font-semibold text-gray-700">Order Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="py-4 px-4 text-gray-700">{{ $order->id }}</td>
                                <td class="py-4 px-4 text-gray-700">{{ $order->user->name }}</td>
                                <td class="py-4 px-4 text-gray-700">{{ $order->freelancer->name ?? 'N/A' }}</td>
                                <td class="py-4 px-4 text-gray-700">{{ $order->service->title ?? 'N/A' }}</td>
                                <td class="py-4 px-4 text-gray-700">{{ $order->package->name ?? 'N/A' }}</td>
                                <td class="py-4 px-4 text-gray-700">${{ number_format($order->amount, 2) }}</td>
                                <td class="py-4 px-4">
                                    @if ($order->status === 'pending')
                                        <span class="inline-block px-2 py-1 text-xs font-medium text-yellow-800 bg-yellow-100 rounded-full">Pending</span>
                                    @elseif ($order->status === 'in_progress')
                                        <span class="inline-block px-2 py-1 text-xs font-medium text-blue-800 bg-blue-100 rounded-full">In Progress</span>
                                    @elseif ($order->status === 'completed')
                                        <span class="inline-block px-2 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full">Completed</span>
                                    @endif
                                </td>
                                <td class="py-4 px-4 text-gray-700">{{ $order->created_at->format('M d, Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="text-center py-8">
                    <p class="text-gray-600">No orders found.</p>
                </div>
            @endif
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $orders->appends(request()->query())->links('pagination::tailwind') }}
        </div>
    </div>

    @section('scripts')
        <script>
            // Auto-hide success/error messages after 5 seconds
            document.addEventListener('DOMContentLoaded', function () {
                const successMessage = document.getElementById('success-message');
                const errorMessage = document.getElementById('error-message');

                if (successMessage) {
                    setTimeout(() => {
                        successMessage.style.display = 'none';
                    }, 5000);
                }

                if (errorMessage) {
                    setTimeout(() => {
                        errorMessage.style.display = 'none';
                    }, 5000);
                }

                // Search bar functionality
                const searchInput = document.querySelector('input[placeholder="Search orders..."]');
                if (searchInput) {
                    searchInput.addEventListener('keypress', function (e) {
                        if (e.keyCode == 13) { // 13 is the keyCode for Enter
                            e.preventDefault();
                            var searchTerm = this.value.trim();
                            if (searchTerm) {
                                window.location.href = '/admin/orders?search=' + encodeURIComponent(searchTerm);
                            }
                        }
                    });
                }

                const statusFilter = document.getElementById('status-filter');
                if (statusFilter) {
                    statusFilter.addEventListener('change', function () {
                        this.form.submit();
                    });
                }
            });
        </script>
    @endsection
@endsection