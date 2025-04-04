<!-- resources/views/auth/register.blade.php -->
@extends('layouts.app')

@section('title', 'FreelanceHub - Sign Up')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/auth.css') }}">
@endsection

@section('content')
    <main class="min-h-screen py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md mx-auto">
            <!-- Logo/Branding -->
            <div class="text-center">
                <span class="text-3xl font-bold primary-gradient text-transparent bg-clip-text">FreelanceHub</span>
                <h1 class="mt-6 text-2xl font-bold text-gray-900">Create a New Account</h1>
            </div>

            <!-- Auth Container -->
            <div class="mt-8 auth-container rounded-2xl p-8">
                <!-- Registration Form -->
                <form action="{{ route('register') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                            Email address
                        </label>
                        <input id="email" name="email" type="email" required 
                               class="auth-input w-full px-4 py-3 rounded-xl text-gray-700 focus:outline-none"
                               placeholder="you@example.com">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                            Password
                        </label>
                        <div class="relative">
                            <input id="password" name="password" type="password" required 
                                   class="auth-input w-full px-4 py-3 rounded-xl text-gray-700 focus:outline-none"
                                   placeholder="••••••••">
                        </div>
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                            Confirm Password
                        </label>
                        <div class="relative">
                            <input id="password_confirmation" name="password_confirmation" type="password" required 
                                   class="auth-input w-full px-4 py-3 rounded-xl text-gray-700 focus:outline-none"
                                   placeholder="••••••••">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            Account Type
                        </label>
                        <select id="userType" name="userType" required
                               class="auth-input w-full px-4 py-3 rounded-xl text-gray-700 focus:outline-none">
                            <option value="">Select account type</option>
                            <option value="client">Client - I want to hire</option>
                            <option value="freelancer">Freelancer - I want to work</option>
                        </select>
                    </div>

                    <button type="submit" 
                            class="auth-button w-full py-3 px-4 rounded-xl text-white font-medium shadow-sm">
                        Create Account
                    </button>
                </form>
                
                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="font-medium text-purple-600 hover:text-purple-500">
                            Sign in
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </main>
@endsection