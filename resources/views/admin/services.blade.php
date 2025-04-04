@extends('layouts.admin')

@section('title', 'Services Management - FreelanceHub Admin')
@section('page-title', 'Services Management')
@section('search-placeholder', 'Search services...')

@section('content')
    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-semibold text-gray-800">Manage Services</h2>
        </div>

        <!-- Services Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="py-3 px-4 text-sm font-semibold text-gray-700">Title</th>
                        <th class="py-3 px-4 text-sm font-semibold text-gray-700">Freelancer</th>
                        <th class="py-3 px-4 text-sm font-semibold text-gray-700">Category</th>
                        <th class="py-3 px-4 text-sm font-semibold text-gray-700">Status</th>
                        <th class="py-3 px-4 text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                        <td class="py-4 px-4 text-gray-700">Web Development</td>
                        <td class="py-4 px-4 text-gray-700">John Doe</td>
                        <td class="py-4 px-4 text-gray-700">Development</td>
                        <td class="py-4 px-4 text-gray-700">Active</td>
                        <td class="py-4 px-4 flex gap-2">
                            <button class="approveBtn px-3 py-1 text-sm text-green-600 bg-green-100 rounded-lg hover:bg-green-200" data-service-id="1">Approve</button>
                            <button class="rejectBtn px-3 py-1 text-sm text-red-600 bg-red-100 rounded-lg hover:bg-red-200" data-service-id="1">Reject</button>
                        </td>
                    </tr>
                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                        <td class="py-4 px-4 text-gray-700">Graphic Design</td>
                        <td class="py-4 px-4 text-gray-700">Jane Smith</td>
                        <td class="py-4 px-4 text-gray-700">Design</td>
                        <td class="py-4 px-4 text-gray-700">Pending</td>
                        <td class="py-4 px-4 flex gap-2">
                            <button class="approveBtn px-3 py-1 text-sm text-green-600 bg-green-100 rounded-lg hover:bg-green-200" data-service-id="2">Approve</button>
                            <button class="rejectBtn px-3 py-1 text-sm text-red-600 bg-red-100 rounded-lg hover:bg-red-200" data-service-id="2">Reject</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6 flex justify-center gap-3">
            <button class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100">Previous</button>
            <button class="px-4 py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-lg">1</button>
            <button class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100">2</button>
            <button class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100">Next</button>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const approveButtons = document.querySelectorAll('.approveBtn');
        const rejectButtons = document.querySelectorAll('.rejectBtn');

        approveButtons.forEach(button => {
            button.addEventListener('click', () => {
                const serviceId = button.getAttribute('data-service-id');
                console.log(`Approving service ID: ${serviceId}`);
                // Add your backend fetch logic here, e.g., fetch(`/admin/services/${serviceId}/approve`, { method: 'POST' })
            });
        });

        rejectButtons.forEach(button => {
            button.addEventListener('click', () => {
                const serviceId = button.getAttribute('data-service-id');
                console.log(`Rejecting service ID: ${serviceId}`);
                // Add your backend fetch logic here, e.g., fetch(`/admin/services/${serviceId}/reject`, { method: 'POST' })
            });
        });
    </script>
@endsection