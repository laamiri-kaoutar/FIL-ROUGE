<!-- resources/views/client/profile.blade.php -->
@extends('layouts.app')

@section('title', 'Client Profile - FreelanceHub')

@section('styles')
    <style>
        .gradient-border {
            border: 2px solid transparent;
            border-image: linear-gradient(to right, #8A4FFF, #FF4F8A) 1;
        }
    </style>
@endsection

@section('content')
    <main class="max-w-4xl mx-auto px-4 py-12 sm:px-6 lg:px-8">
        <div class="mb-12 text-center">
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 tracking-tight">Client Profile</h1>
            <p class="mt-2 text-lg text-gray-600">Manage your personal details and orders</p>
        </div>

        <!-- Profile Card -->
        <div class="bg-white rounded-xl shadow-lg gradient-border p-6 sm:p-8 mb-6 sm:mb-8">
            <div class="flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-6 mb-6 sm:mb-8">
                <img id="profileImagePreview" src="https://via.placeholder.com/100" alt="Profile Image" class="w-24 h-24 sm:w-28 sm:h-28 rounded-full object-cover border-4 border-gray-100 shadow-sm">
                <div class="text-center sm:text-left">
                    <h2 id="profileName" class="text-xl sm:text-2xl font-bold text-gray-900">Jane Smith</h2>
                    <p id="profileEmail" class="text-gray-600 text-base sm:text-lg">jane.smith@example.com</p>
                </div>
            </div>

            <!-- Profile Form -->
            <form id="profileForm" class="space-y-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Profile Image</label>
                        <input type="file" id="profileImage" name="profileImage" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                        <input type="text" id="firstName" name="firstName" value="Jane" class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 shadow-sm">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                        <input type="text" id="lastName" name="lastName" value="Smith" class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 shadow-sm">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" id="email" name="email" value="jane.smith@example.com" class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 shadow-sm">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Company Name (Optional)</label>
                        <input type="text" id="companyName" name="companyName" value="TechCorp" class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 shadow-sm">
                    </div>
                </div>
                <div class="flex justify-end space-x-4 pt-4">
                    <button type="button" id="cancelBtn" class="px-4 sm:px-6 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors font-medium">Cancel</button>
                    <button type="submit" id="saveBtn" class="px-4 sm:px-6 py-2 primary-gradient text-white rounded-lg hover:opacity-90 transition-colors font-medium disabled:opacity-50" disabled>Save Changes</button>
                </div>
            </form>
        </div>

        <!-- Change Password Button -->
        <div class="text-center mb-6 sm:mb-8">
            <button id="changePasswordBtn" class="px-6 sm:px-8 py-2 sm:py-3 primary-gradient text-white rounded-lg hover:opacity-90 transition-colors font-semibold shadow-md">Change Password</button>
        </div>

        <!-- Orders Section -->
        <div class="bg-white rounded-xl shadow-lg p-6 sm:p-8">
            <h2 class="text-xl sm:text-2xl font-bold text-gray-900 mb-4 sm:mb-6">Your Orders</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                <div class="bg-gray-50 rounded-lg p-3 sm:p-4 shadow-sm">
                    <h3 class="text-base sm:text-lg font-semibold text-gray-800">Order #1234</h3>
                    <p class="text-gray-600 text-sm sm:text-base mt-1">Web Development - In Progress</p>
                    <a href="{{ route('client.orders') }}" class="text-purple-600 hover:text-purple-800 font-medium mt-1 sm:mt-2 inline-block">View Details</a>
                </div>
                <div class="bg-gray-50 rounded-lg p-3 sm:p-4 shadow-sm">
                    <h3 class="text-base sm:text-lg font-semibold text-gray-800">Order #5678</h3>
                    <p class="text-gray-600 text-sm sm:text-base mt-1">UI/UX Design - Completed</p>
                    <a href="{{ route('client.orders') }}" class="text-purple-600 hover:text-purple-800 font-medium mt-1 sm:mt-2 inline-block">View Details</a>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script src="{{ asset('js/profile.js') }}"></script>
@endsection