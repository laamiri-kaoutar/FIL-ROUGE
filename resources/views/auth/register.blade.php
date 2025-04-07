@extends('layouts.app')

@section('title', 'FreelanceHub - Sign Up')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<main class="min-h-screen py-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md mx-auto">
        <div class="text-center">
            <span class="text-3xl font-bold primary-gradient text-transparent bg-clip-text">FreelanceHub</span>
            <h1 class="mt-6 text-2xl font-bold text-gray-900">Create a New Account</h1>
        </div>

        <div class="mt-8 bg-white shadow-md rounded-2xl p-8">
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                    <ul class="list-disc pl-5 text-sm space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" id="registerForm">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <input id="name" name="name" type="text" required
                        value="{{ old('name') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <div id="nameError" class="text-red-600 text-sm mt-1"></div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
                    <input id="email" name="email" type="email" required
                        value="{{ old('email') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <div id="emailError" class="text-red-600 text-sm mt-1"></div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input id="password" name="password" type="password" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <div id="passwordError" class="text-red-600 text-sm mt-1"></div>
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <div id="confirmError" class="text-red-600 text-sm mt-1"></div>
                </div>

                <div>
                    <label for="role_id" class="block text-sm font-medium text-gray-700 mb-2">Account Type</label>
                    <select id="role_id" name="role_id" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Select account type</option>
                        @foreach($roles as $role)   
                            <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                {{ ucfirst($role->name) }}
                            </option>
                        @endforeach
                    </select>
                    <div id="roleError" class="text-red-600 text-sm mt-1"></div>
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

@section('scripts')
<script>
    document.getElementById('registerForm').onsubmit = function() {
        let isValid = true;

        document.getElementById('nameError').innerText = '';
        document.getElementById('emailError').innerText = '';
        document.getElementById('passwordError').innerText = '';
        document.getElementById('confirmError').innerText = '';
        document.getElementById('roleError').innerText = '';

        let name = document.getElementById('name').value;
        let nameRegex = /^[A-Za-z\s]+$/;
        if (name.trim() === '' || !nameRegex.test(name)) {
            document.getElementById('nameError').innerText = 'Enter a valid name (letters only)';
            isValid = false;
        }

        let email = document.getElementById('email').value;
        let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email.trim() === '' || !emailRegex.test(email)) {
            document.getElementById('emailError').innerText = 'Enter a valid email';
            isValid = false;
        }

        let password = document.getElementById('password').value;
        if (password.length < 8) {
            document.getElementById('passwordError').innerText = 'Password must be 8+ characters';
            isValid = false;
        }

        let confirm = document.getElementById('password_confirmation').value;
        if (password !== confirm) {
            document.getElementById('confirmError').innerText = 'Passwords must match';
            isValid = false;
        }

        let role = document.getElementById('role_id').value;
        if (role === '') {
            document.getElementById('roleError').innerText = 'Select an account type';
            isValid = false;
        }

        return isValid;
    };
</script>
@endsection