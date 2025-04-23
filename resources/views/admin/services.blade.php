@extends('layouts.admin')

@section('title', 'Services Management - FreelanceHub Admin')
@section('page-title', 'Services Management')
@section('search-placeholder', 'Search services...')

@section('content')
    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-semibold text-gray-800">Manage Services</h2>
        </div>

        <!-- Filters -->
        <form method="GET" action="{{ route('admin.services') }}" class="flex flex-col sm:flex-row gap-4 mb-6">
            <input type="hidden" name="search" value="{{ request('search') }}">
            <select id="status-filter" name="status" class="border border-gray-300 rounded-lg p-2 w-full sm:w-48 focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                <option value="All Statuses" {{ request('status', 'All Statuses') === 'All Statuses' ? 'selected' : '' }}>All Statuses</option>
                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
            <select id="category-filter" name="category_id" class="border border-gray-300 rounded-lg p-2 w-full sm:w-48 focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                <option value="All Categories" {{ request('category_id', 'All Categories') === 'All Categories' ? 'selected' : '' }}>All Categories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </form>

        <!-- Services Table -->
        <div class="overflow-x-auto">
            @if ($services->isNotEmpty())
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="py-3 px-4 text-sm font-semibold text-gray-700">Title</th>
                            <th class="py-3 px-4 text-sm font-semibold text-gray-700">Freelancer</th>
                            <th class="py-3 px-4 text-sm font-semibold text-gray-700">Category</th>
                            <th class="py-3 px-4 text-sm font-semibold text-gray-700">Rating</th>
                            <th class="py-3 px-4 text-sm font-semibold text-gray-700">Status</th>
                            <th class="py-3 px-4 text-sm font-semibold text-gray-700">Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($services as $service)
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="py-4 px-4 text-gray-700">{{ $service->title }}</td>
                                <td class="py-4 px-4 text-gray-700">{{ $service->user->name ?? 'N/A' }}</td>
                                <td class="py-4 px-4 text-gray-700">{{ $service->category->name ?? 'N/A' }}</td>
                                <td class="py-4 px-4 text-gray-700">{{ number_format($service->rating, 1) }}/5</td>
                                <td class="py-4 px-4">
                                    @if ($service->status === 'active')
                                        <span class="inline-block px-2 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full">Active</span>
                                    @elseif ($service->status === 'inactive')
                                        <span class="inline-block px-2 py-1 text-xs font-medium text-red-800 bg-red-100 rounded-full">Inactive</span>
                                    @endif
                                </td>
                                <td class="py-4 px-4 text-gray-700">{{ $service->created_at->format('M d, Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="text-center py-8">
                    <p class="text-gray-600">No services found.</p>
                </div>
            @endif
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $services->appends(request()->query())->links('pagination::tailwind') }}
        </div>
    </div>

    @section('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
               
                const searchInput = document.querySelector('input[placeholder="Search services..."]');
                if (searchInput) {
                    searchInput.addEventListener('keypress', function (e) {
                        if (e.keyCode == 13) { // 13 is the keyCode for Enter
                            e.preventDefault();
                            var searchTerm = this.value.trim();
                            if (searchTerm) {
                                window.location.href = '/admin/services?search=' + encodeURIComponent(searchTerm);
                            } else {
                                window.location.href = '/admin/services';
                            }
                        }
                    });
                }

                const statusFilter = document.getElementById('status-filter');
                const categoryFilter = document.getElementById('category-filter');

                if (statusFilter) {
                    statusFilter.addEventListener('change', function () {
                        this.form.submit();
                    });
                }

                if (categoryFilter) {
                    categoryFilter.addEventListener('change', function () {
                        this.form.submit();
                    });
                }
            });
        </script>
    @endsection
@endsection 