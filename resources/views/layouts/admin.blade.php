<!-- resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FreelanceHub Admin')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{ asset('css/pages/dashboard.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    @yield('styles')
</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r border-gray-200 fixed inset-y-0 left-0 z-50">
            <div class="h-16 px-6 flex items-center border-b border-gray-200">
                <span class="text-2xl font-bold bg-gradient-to-r from-purple-500 to-pink-500 text-transparent bg-clip-text">FreelanceHub</span>
            </div>
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 rounded-lg bg-gradient-to-r from-purple-500 to-pink-500 flex items-center justify-center text-white font-semibold text-lg shadow-md">
                        A
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900">Admin Name</h3>
                    </div>
                </div>
            </div>
            <nav class="p-4">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100 mb-2 @if(Route::is('admin.dashboard')) bg-gradient-to-r from-purple-100/50 to-pink-100/50 border-r-4 border-pink-500 @endif">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>
                <div class="mb-6">
                    <h3 class="px-4 text-xs font-semibold text-gray-400 uppercase mb-2">User Management</h3>
                    <a href="{{ route('admin.account-validation') }}" class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100 @if(Route::is('admin.account-validation')) bg-gradient-to-r from-purple-100/50 to-pink-100/50 border-r-4 border-pink-500 @endif">
                        <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        Account Validation
                    </a>
                    {{-- <a href="{{ route('admin.profile-moderation') }}" class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100 @if(Route::is('admin.profile-moderation')) bg-gradient-to-r from-purple-100/50 to-pink-100/50 border-r-4 border-pink-500 @endif">
                        <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        Profile Moderation
                    </a> --}}
                </div>
                <div class="mb-6">
                    <h3 class="px-4 text-xs font-semibold text-gray-400 uppercase mb-2">Content</h3>
                    <a href="{{ route('admin.signals') }}" class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100 @if(Route::is('admin.signals')) bg-gradient-to-r from-purple-100/50 to-pink-100/50 border-r-4 border-pink-500 @endif">
                        <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        Signals
                    </a>
                    <a href="{{ route('admin.orders') }}" class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100 @if(Route::is('admin.orders')) bg-gradient-to-r from-purple-100/50 to-pink-100/50 border-r-4 border-pink-500 @endif">
                        <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        Orders
                    </a>
                    <a href="{{ route('admin.transactions') }}" class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100 @if(Route::is('admin.transactions')) bg-gradient-to-r from-purple-100/50 to-pink-100/50 border-r-4 border-pink-500 @endif">
                        <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        Transactions
                    </a>
                    <a href="{{ route('admin.service-validation') }}" class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100 @if(Route::is('admin.service-validation')) bg-gradient-to-r from-purple-100/50 to-pink-100/50 border-r-4 border-pink-500 @endif">
                        <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        Service Validation
                    </a>
                </div>
                <div>
                    <h3 class="px-4 text-xs font-semibold text-gray-400 uppercase mb-2">System</h3>
                    <a href="{{ route('admin.tags') }}" class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100 @if(Route::is('admin.tags')) bg-gradient-to-r from-purple-100/50 to-pink-100/50 border-r-4 border-pink-500 @endif">
                        <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                        Tags
                    </a>
                    <a href="{{ route('admin.settings') }}" class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100 @if(Route::is('admin.settings')) bg-gradient-to-r from-purple-100/50 to-pink-100/50 border-r-4 border-pink-500 @endif">
                        <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Settings
                    </a>
                </div>
            </nav>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-h-screen ml-64">
            <header class="h-16 bg-white shadow-md flex items-center justify-between px-6">
                <div class="flex items-center">
                    <h1 class="text-xl font-semibold text-gray-800">@yield('page-title')</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <input type="text" placeholder="@yield('search-placeholder', 'Search...')" class="w-48 pl-10 pr-4 py-2 rounded-lg border border-gray-200 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 text-sm"/>
                        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <button class="p-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </button>
                    <button class="flex items-center px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-lg">
                        <span class="text-sm">Logout</span>
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </button>
                </div>
            </header>

            <main class="flex-1 bg-gray-50 p-6">
                @yield('content')
            </main>
        </div>
    </div>

    @yield('scripts')
</body>
</html>