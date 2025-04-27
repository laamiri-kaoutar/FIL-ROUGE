<!-- resources/views/components/navbar.blade.php -->
@props([
    'showSearch' => false, // Boolean to show/hide the search bar
])

<nav class="nav-glass sticky top-0 z-50 shadow-lg border-b border-gray-200/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <!-- Logo and Main Nav -->
            <div class="flex items-center flex-1">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="text-3xl font-bold primary-gradient text-transparent bg-clip-text">FreelanceHub</a>
                </div>

                <!-- Main Search Bar (Optional) -->
                @if ($showSearch)
                <div class="hidden lg:flex items-center ml-8 flex-1 max-w-2xl">
                    <div class="search-gradient w-full bg-white rounded-full shadow-sm">
                        <form id="searchForm" method="GET" class="flex items-center px-4 py-2">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <input type="search" name="query" placeholder="Search for services..." value="{{ request('query') }}" class="w-full ml-2 outline-none bg-transparent text-gray-700 placeholder-gray-400">
                        </form>
                    </div>
                </div>
                @endif

                <!-- Desktop Navigation Links -->
                <div class="hidden md:ml-8 md:flex md:space-x-8">
                    @guest
                        <!-- Guest Links (Index Page) -->
                        <a href="#explore" class="nav-link text-gray-700 hover:text-gray-900 px-3 py-2 text-sm font-medium transition-colors duration-200">Explore</a>
                        <a href="#categories" class="nav-link text-gray-700 hover:text-gray-900 px-3 py-2 text-sm font-medium transition-colors duration-200">Categories</a>
                        <a href="#how-it-works" class="nav-link text-gray-700 hover:text-gray-900 px-3 py-2 text-sm font-medium transition-colors duration-200">How It Works</a>
                        @else
                        @if (Auth::user()->role->name === 'client')
                            <!-- Client Links -->
                            <a href="{{ route('client.services') }}" class="nav-link text-gray-700 hover:text-gray-900 px-3 py-2 text-sm font-medium transition-colors duration-200 {{ request()->routeIs('client.services') ? 'active' : '' }}">Services</a>
                            <a href="{{ route('client.favorites') }}" class="nav-link text-gray-700 hover:text-gray-900 px-3 py-2 text-sm font-medium transition-colors duration-200 {{ request()->routeIs('client.favorites') ? 'active' : '' }}">Favorites</a>
                            <a href="{{ route('client.orders') }}" class="nav-link text-gray-700 hover:text-gray-900 px-3 py-2 text-sm font-medium transition-colors duration-200 {{ request()->routeIs('client.orders') ? 'active' : '' }}">Order History</a>
                            <a href="{{ route('client.reviews', Auth::user()->id) }}" class="nav-link text-gray-700 hover:text-gray-900 px-3 py-2 text-sm font-medium transition-colors duration-200 {{ request()->routeIs('client.reviews') ? 'active' : '' }}">Reviews</a>
                            @if (Auth::user()->clientConversations()->count() > 0)
                                <a href="{{ route('chat.index') }}" class="nav-link text-gray-700 hover:text-gray-900 px-3 py-2 text-sm font-medium transition-colors duration-200 {{ request()->routeIs('chat.index') ? 'active' : '' }}">Messages</a>
                            @endif
                        @elseif (Auth::user()->role->name === 'freelancer')
                            <!-- Freelancer Links -->
                            <a href="{{ route('freelancer.services') }}" class="nav-link text-gray-700 hover:text-gray-900 px-3 py-2 text-sm font-medium transition-colors duration-200 {{ request()->routeIs('freelancer.services') ? 'active' : '' }}">My Services</a>
                            <a href="{{ route('freelancer.orders') }}" class="nav-link text-gray-700 hover:text-gray-900 px-3 py-2 text-sm font-medium transition-colors duration-200 {{ request()->routeIs('freelancer.orders') ? 'active' : '' }}">Orders</a>
                            {{-- <a href="{{ route('freelancer.transactions') }}" class="nav-link text-gray-700 hover:text-gray-900 px-3 py-2 text-sm font-medium transition-colors duration-200 {{ request()->routeIs('freelancer.transactions') ? 'active' : '' }}">Transactions</a> --}}
                            @if (Auth::user()->freelancerConversations()->count() > 0)
                                <a href="{{ route('chat.index') }}" class="nav-link text-gray-700 hover:text-gray-900 px-3 py-2 text-sm font-medium transition-colors duration-200 {{ request()->routeIs('chat.index') ? 'active' : '' }}">Messages</a>
                            @endif
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Auth/User Section -->
            <div class="flex items-center space-x-4">
                @guest
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-gray-900 px-5 py-2.5 rounded-full text-sm font-medium transition-all duration-200 hover:bg-gray-100">Login</a>
                    <a href="{{ route('register') }}" class="primary-gradient px-6 py-2.5 rounded-full text-sm font-medium text-white transition-all duration-200 hover:shadow-lg hover:shadow-purple-500/30 active:scale-95">Sign Up</a>
                @else
                    <!-- User Profile Icon and Name -->
                    <a href="{{ Auth::user()->role->name === 'client' ? route('profile.show') : route('profile.show') }}" class="flex items-center space-x-2">
                        <img src="{{ auth()->user()->image ? asset('storage/' . auth()->user()->image) : 'https://via.placeholder.com/100' }}" alt="Profile" class="w-10 h-10 rounded-full object-cover border-2 border-gray-200">
                        <span class="text-gray-700 text-sm font-medium">{{ Auth::user()->name }}</span>
                    </a>

                    
                    <a href="{{ route('logout') }}" class="text-gray-700 hover:text-gray-900 px-5 py-2.5 rounded-full text-sm font-medium transition-all duration-200 hover:bg-gray-100" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                @endguest
            </div>

            <!-- Mobile Menu Button -->
            <div class="flex items-center md:hidden ml-4">
                <button type="button" class="mobile-menu-button inline-flex items-center justify-center p-2 rounded-lg text-gray-700 hover:text-gray-900 hover:bg-gray-100 transition-colors duration-200">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu (Hidden by Default) -->
        <div class="mobile-menu hidden md:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1">
                @guest
                    <!-- Guest Links (Index Page) -->
                    <a href="#explore" class="block text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-base font-medium transition-colors duration-200">Explore</a>
                    <a href="#categories" class="block text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-base font-medium transition-colors duration-200">Categories</a>
                    <a href="#how-it-works" class="block text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-base font-medium transition-colors duration-200">How It Works</a>
                @else
                    @if (Auth::user()->role->name === 'client')
                        <!-- Client Links -->
                        <a href="{{ route('client.services') }}" class="block text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-base font-medium transition-colors duration-200 {{ request()->routeIs('client.services') ? 'active' : '' }}">Services</a>
                        <a href="{{ route('client.favorites') }}" class="block text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-base font-medium transition-colors duration-200 {{ request()->routeIs('client.favorites') ? 'active' : '' }}">Favorites</a>
                        <a href="{{ route('client.orders') }}" class="block text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-base font-medium transition-colors duration-200 {{ request()->routeIs('client.orders') ? 'active' : '' }}">Order History</a>
                        <a href="{{ route('client.reviews' , Auth::user()->id) }}" class="block text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-base font-medium transition-colors duration-200 {{ request()->routeIs('client.reviews') ? 'active' : '' }}">Reviews</a>
                    @elseif (Auth::user()->role->name === 'freelancer')
                        <!-- Freelancer Links -->
                        <a href="{{ route('freelancer.services') }}" class="block text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-base font-medium transition-colors duration-200 {{ request()->routeIs('freelancer.services') ? 'active' : '' }}">My Services</a>
                        <a href="{{ route('freelancer.orders') }}" class="block text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-base font-medium transition-colors duration-200 {{ request()->routeIs('freelancer.orders') ? 'active' : '' }}">Orders</a>
                        {{-- <a href="{{ route('freelancer.transactions') }}" class="block text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-base font-medium transition-colors duration-200 {{ request()->routeIs('freelancer.transactions') ? 'active' : '' }}">Transactions</a> --}}
                    @endif
                    <a href="{{ route('chat.index') }}" class="block text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-base font-medium transition-colors duration-200 {{ request()->routeIs('chat.index') ? 'active' : '' }}">Chat</a>
                @endauth
            </div>
        </div>
    </div>
</nav>