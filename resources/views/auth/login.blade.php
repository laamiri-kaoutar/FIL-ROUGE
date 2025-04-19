@php
    $showSearch = false;
@endphp
@extends('layouts.app')

@section('title', 'FreelanceHub - Login')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
{{-- @include('components.navbar', ['showSearch' => false]) --}}

    <main class="min-h-screen py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md mx-auto">
            <div class="text-center">
                <span class="text-3xl font-bold primary-gradient text-transparent bg-clip-text">FreelanceHub</span>
                <h1 class="mt-6 text-2xl font-bold text-gray-900">Sign In to Your Account</h1>
            </div>

            <div class="mt-8 auth-container rounded-2xl p-8">
                <form action="{{ route('login') }}" method="POST" class="space-y-6">
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

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember-me" name="remember" type="checkbox" 
                                   class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                            <label for="remember-me" class="ml-2 block text-sm text-gray-700">
                                Remember me
                            </label>
                        </div>

                        <a href="{{ route('password.request') }}" class="text-sm font-medium text-purple-600 hover:text-purple-500">
                            Forgot password?
                        </a>
                    </div>

                    <button type="submit" 
                            class="auth-button w-full py-3 px-4 rounded-xl text-white font-medium shadow-sm">
                        Sign in
                    </button>
                </form>
                
                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="font-medium text-purple-600 hover:text-purple-500">
                            Sign up
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </main>
@endsection