@extends('layouts.app')

@section('title', 'Profile Management - FreelanceHub')

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
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 tracking-tight">Profile Management</h1>
            <p class="mt-2 text-lg text-gray-600">Manage your personal details</p>
        </div>

        <!-- Profile Card -->
        <div class="bg-white rounded-xl shadow-lg gradient-border p-6 sm:p-8 mb-6 sm:mb-8">
            <div class="flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-6 mb-6 sm:mb-8">
                <img id="profileImagePreview" src="{{ auth()->user()->image ? asset('storage/' . auth()->user()->image) : 'https://via.placeholder.com/100' }}" alt="Profile Image" class="w-24 h-24 sm:w-28 sm:h-28 rounded-full object-cover border-4 border-gray-100 shadow-sm">
                <div class="text-center sm:text-left">
                    <h2 id="profileName" class="text-xl sm:text-2xl font-bold text-gray-900">{{ auth()->user()->name }}</h2>
                    <p id="profileEmail" class="text-gray-600 text-base sm:text-lg">{{ auth()->user()->email }}</p>
                </div>
            </div>

            <!-- Profile Form -->
            <form id="profileForm" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Profile Image</label>
                        <input type="file" id="profileImage" name="profileImage" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
                    </div>
                    <div class="sm:col-span-2">
                        @php
                            $nameParts = explode(' ', auth()->user()->name, 2);
                            $firstName = $nameParts[0] ?? '';
                            $lastName = $nameParts[1] ?? '';
                        @endphp
                        <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                        <input type="text" id="firstName" name="firstName" value="{{ $firstName }}" class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 shadow-sm">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                        <input type="text" id="lastName" name="lastName" value="{{ $lastName }}" class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 shadow-sm">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 shadow-sm">
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
            <a  href="{{ route('password.request') }}"  id="changePasswordBtn" class="px-6 sm:px-8 py-2 sm:py-3 primary-gradient text-white rounded-lg hover:opacity-90 transition-colors font-semibold shadow-md">Change Password</a>
        </div>
    </main>
@endsection

@section('scripts')
    <script src="{{ asset('js/profile.js') }}"></script>
@endsection