<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'FreelanceHub')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/footer.css') }}">
    <script src="https://js.pusher.com/8.2/pusher.min.js"></script>

    @vite(['resources/js/app.js'])

    {{-- <meta name="api-token" content="{{ auth()->check() ? auth()->user()->createToken('api-token')->plainTextToken : '' }}"> --}}
<meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            background-color: #f0f0f0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        main {
            flex: 1;
        }
    </style>
    @yield('styles')
</head>
<body>
    {{-- @include('components.navbar', ['showSearch' => true]) --}}
    @include('components.navbar', ['showSearch' => $showSearch ?? true])


    <main>
        @yield('content')
    </main>

    @include('components.footer')

    <script src="{{ asset('js/navbar.js') }}"></script>
    @yield('scripts')
</body>
</html>