@extends('layouts.admin')

@section('title', 'Reported Comments Management - FreelanceHub Admin')
@section('page-title', 'Reported Comments Management')
@section('search-placeholder', 'Search reported comments...')

@section('content')
    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-semibold text-gray-800">Manage Reported Comments</h2>
        </div>

        <!-- Reported Comments Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="py-3 px-4 text-sm font-semibold text-gray-700">Comment</th>
                        <th class="py-3 px-4 text-sm font-semibold text-gray-700">Reported By</th>
                        <th class="py-3 px-4 text-sm font-semibold text-gray-700">Author</th>
                        <th class="py-3 px-4 text-sm font-semibold text-gray-700">Reason</th>
                        <th class="py-3 px-4 text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                        <td class="py-4 px-4 text-gray-700">This is a rude comment!</td>
                        <td class="py-4 px-4 text-gray-700">User123</td>
                        <td class="py-4 px-4 text-gray-700">JohnDoe</td>
                        <td class="py-4 px-4 text-gray-700">Inappropriate language</td>
                        <td class="py-4 px-4 flex gap-2">
                            <button class="px-3 py-1 text-sm text-red-600 bg-red-100 rounded-lg hover:bg-red-200">Delete</button>
                            <button class="px-3 py-1 text-sm text-green-600 bg-green-100 rounded-lg hover:bg-green-200">Dismiss</button>
                        </td>
                    </tr>
                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                        <td class="py-theory
                        <td class="py-4 px-4 text-gray-700">Spam content here</td>
                        <td class="py-4 px-4 text-gray-700">JaneSmith</td>
                        <td class="py-4 px-4 text-gray-700">Spammer99</td>
                        <td class="py-4 px-4 text-gray-700">Spam</td>
                        <td class="py-4 px-4 flex gap-2">
                            <button class="px-3 py-1 text-sm text-red-600 bg-red-100 rounded-lg hover:bg-red-200">Delete</button>
                            <button class="px-3 py-1 text-sm text-green-600 bg-green-100 rounded-lg hover:bg-green-200">Dismiss</button>
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