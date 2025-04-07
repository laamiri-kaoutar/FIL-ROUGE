@extends('layouts.app')
@section('title', 'FreelanceHub - Forgot Password')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection
@section('content')
    <main class="min-h-screen py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md mx-auto">
            <div class="text-center">
                <span class="text-3xl font-bold primary-gradient text-transparent bg-clip-text">FreelanceHub</span>
                <h1 class="mt-6 text-2xl font-bold text-gray-900">Reset Your Password</h1>
                <p class="mt-2 text-sm text-gray-600">Enter your email address and we'll send you a link to reset your password.</p>
            </div>
            <div class="mt-8 auth-container rounded-2xl p-8">
                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <form action="#" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                            Email address
                        </label>
                        <input id="email" name="email" type="email" required
                               class="auth-input w-full px-4 py-3 rounded-xl text-gray-700 focus:outline-none"
                               placeholder="you@example.com">
                    </div>
                    
                    <button type="submit"
                            class="auth-button w-full py-3 px-4 rounded-xl text-white font-medium shadow-sm">
                        Send Password Reset Link
                    </button>
                </form>
               
                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Remember your password?
                        <a href="{{ route('login') }}" class="font-medium text-purple-600 hover:text-purple-500">
                            Back to login
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </main>
@endsection