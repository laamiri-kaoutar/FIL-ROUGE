@extends('layouts.admin')

@section('title', 'Account Validation - FreelanceHub Admin')
@section('page-title', 'Account Validation')
@section('search-placeholder', 'Search users...')

@section('content')
    <div class="bg-white rounded-xl shadow-md p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-6">Manage Users</h2>

        <!-- User Statistics -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <p class="text-sm text-gray-600">Total Users</p>
                <p class="text-2xl font-semibold text-gray-900">1,245</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <p class="text-sm text-gray-600">Total Freelancers</p>
                <p class="text-2xl font-semibold text-gray-900">782</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <p class="text-sm text-gray-600">Total Clients</p>
                <p class="text-2xl font-semibold text-gray-900">463</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <p class="text-sm text-gray-600">Banned Users</p>
                <p class="text-2xl font-semibold text-gray-900">15</p>
            </div>
        </div>

        <!-- Filter and Search -->
        <div class="flex flex-col sm:flex-row gap-4 mb-6">
            <select class="border border-gray-300 rounded-lg p-2 w-full sm:w-48 focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                <option>All Statuses</option>
                <option>Active</option>
                <option>Suspended</option>
                <option>Banned</option>
            </select>
            <input type="text" placeholder="Search by name or email..." class="w-full sm:w-64 border border-gray-200 rounded-lg p-2 focus:ring-2 focus:ring-purple-500 focus:border-purple-500"/>
        </div>

        <!-- User Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="py-3 px-4 text-sm font-semibold text-gray-700">Name</th>
                        <th class="py-3 px-4 text-sm font-semibold text-gray-700">Email</th>
                        <th class="py-3 px-4 text-sm font-semibold text-gray-700">Role</th>
                        <th class="py-3 px-4 text-sm font-semibold text-gray-700">Status</th>
                        <th class="py-3 px-4 text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                        <td class="py-4 px-4 text-gray-700">John Doe</td>
                        <td class="py-4 px-4 text-gray-700">john.doe@example.com</td>
                        <td class="py-4 px-4 text-gray-700">Freelancer</td>
                        <td class="py-4 px-4">
                            <span class="inline-block px-2 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full">Active</span>
                        </td>
                        <td class="py-4 px-4 flex gap-2">
                            <button class="px-3 py-1 text-sm text-yellow-600 bg-yellow-100 rounded-lg hover:bg-yellow-200">Suspend</button>
                            <button class="px-3 py-1 text-sm text-red-600 bg-red-100 rounded-lg hover:bg-red-200">Ban</button>
                        </td>
                    </tr>
                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                        <td class="py-4 px-4 text-gray-700">Jane Smith</td>
                        <td class="py-4 px-4 text-gray-700">jane.smith@example.com</td>
                        <td class="py-4 px-4 text-gray-700">Client</td>
                        <td class="py-4 px-4">
                            < Epidemiol

span class="inline-block px-2 py-1 text-xs font-medium text-yellow-800 bg-yellow-100 rounded-full">Suspended</span>
                        </td>
                        <td class="py-4 px-4 flex gap-2">
                            <button class="px-3 py-1 text-sm text-green-600 bg-green-100 rounded-lg hover:bg-green-200">Unban</button>
                            <button class="px-3 py-1 text-sm text-red-600 bg-red-100 rounded-lg hover:bg-red-200">Ban</button>
                        </td>
                    </tr>
                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                        <td class="py-4 px-4 text-gray-700">Mike Johnson</td>
                        <td class="py-4 px-4 text-gray-700">mike.j@example.com</td>
                        <td class="py-4 px-4 text-gray-700">Freelancer</td>
                        <td class="py-4 px-4">
                            <span class="inline-block px-2 py-1 text-xs font-medium text-red-800 bg-red-100 rounded-full">Banned</span>
                        </td>
                        <td class="py-4 px-4 flex gap-2">
                            <button class="px-3 py-1 text-sm text-green-600 bg-green-100 rounded-lg hover:bg-green-200">Unban</button>
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