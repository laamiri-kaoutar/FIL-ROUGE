@extends('layouts.admin')

@section('title', 'Orders Management - FreelanceHub Admin')
@section('page-title', 'Orders Management')
@section('search-placeholder', 'Search orders...')

@section('content')
    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-semibold text-gray-800">Manage Orders</h2>
        </div>

        <!-- Orders Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="py-3 px-4 text-sm font-semibold text-gray-700">Order ID</th>
                        <th class="py-3 px-4 text-sm font-semibold text-gray-700">Client</th>
                        <th class="py-3 px-4 text-sm font-semibold text-gray-700">Service</th>
                        <th class="py-3 px-4 text-sm font-semibold text-gray-700">Amount</th>
                        <th class="py-3 px-4 text-sm font-semibold text-gray-700">Payment Status</th>
                        <th class="py-3 px-4 text-sm font-semibold text-gray-700">Order Status</th>
                        <th class="py-3 px-4 text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                        <td class="py-4 px-4 text-gray-700">1001</td>
                        <td class="py-4 px-4 text-gray-700">Alice Johnson</td>
                        <td class="py-4 px-4 text-gray-700">Web Development</td>
                        <td class="py-4 px-4 text-gray-700">$500.00</td>
                        <td class="py-4 px-4 text-gray-700">Paid</td>
                        <td class="py-4 px-4 text-gray-700">Completed</td>
                        <td class="py-4 px-4 flex gap-2">
                            <button class="px-3 py-1 text-sm text-green-600 bg-green-100 rounded-lg hover:bg-green-200 approveBtn" data-order-id="1001">Approve</button>
                            <button class="px-3 py-1 text-sm text-red-600 bg-red-100 rounded-lg hover:bg-red-200 rejectBtn" data-order-id="1001">Reject</button>
                        </td>
                    </tr>
                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                        <td class="py-4 px-4 text-gray-700">1002</td>
                        <td class="py-4 px-4 text-gray-700">Bob Smith</td>
                        <td class="py-4 px-4 text-gray-700">Graphic Design</td>
                        <td class="py-4 px-4 text-gray-700">$300.00</td>
                        <td class="py-4 px-4 text-gray-700">Not Paid</td>
                        <td class="py-4 px-4 text-gray-700">Pending</td>
                        <td class="py-4 px-4 flex gap-2">
                            <button class="px-3 py-1 text-sm text-green-600 bg-green-100 rounded-lg hover:bg-green-200 approveBtn" data-order-id="1002">Approve</button>
                            <button class="px-3 py-1 text-sm text-red-600 bg-red-100 rounded-lg hover:bg-red-200 rejectBtn" data-order-id="1002">Reject</button>
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