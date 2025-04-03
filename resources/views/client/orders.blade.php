<!-- resources/views/client/orders.blade.php -->
@extends('layouts.app')

@section('title', 'Order History - FreelanceHub')

@section('content')
    <main class="flex-grow container mx-auto px-4 py-8 max-w-6xl">
        <!-- Back to Dashboard Link -->
        <a href="{{ route('client.dashboard') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 mb-6 font-medium transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
            </svg>
            Back to Dashboard
        </a>

        <!-- Page Header with Title and Stats -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-4 sm:mb-0">Your Order History</h1>
            <div class="flex space-x-4">
                <div class="bg-white rounded-lg shadow-sm px-4 py-3 flex flex-col items-center">
                    <span class="text-sm text-gray-500">Total Orders</span>
                    <span class="text-xl font-semibold text-gray-800">3</span>
                </div>
                <div class="bg-white rounded-lg shadow-sm px-4 py-3 flex flex-col items-center">
                    <span class="text-sm text-gray-500">Active</span>
                    <span class="text-xl font-semibold text-gray-800">1</span>
                </div>
            </div>
        </div>

        <!-- Orders Container -->
        <div class="orders-container">
            <!-- Has Orders View -->
            <div class="has-orders space-y-6">
                <!-- Responsive Orders List -->
                <div class="grid grid-cols-1 lg:grid-cols-1 gap-4">
                    <!-- Order 1 -->
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <div class="p-4 border-b border-gray-100 flex items-center">
                            <div class="h-10 w-10 flex-shrink-0 rounded bg-indigo-100 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3 flex-grow">
                                <div class="flex flex-col sm:flex-row sm:justify-between">
                                    <h3 class="text-sm font-medium text-gray-900">Full Stack Web Development</h3>
                                    <span class="text-xs text-gray-500 mt-1 sm:mt-0">Order #FH-2503849</span>
                                </div>
                            </div>
                            <div class="hidden sm:block">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    <span class="h-2 w-2 mr-1 rounded-full bg-yellow-400"></span>
                                    In Progress
                                </span>
                            </div>
                        </div>
                        <div class="p-4 grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <div class="text-xs text-gray-500 mb-1">Package</div>
                                <div class="text-sm font-medium">Basic Package</div>
                                <div class="mt-1 text-sm text-gray-700">$499</div>
                            </div>
                            <div>
                                <div class="text-xs text-gray-500 mb-1">Delivery</div>
                                <div class="text-sm">7 Days Delivery</div>
                                <div class="text-sm">2 Revisions</div>
                            </div>
                            <div>
                                <div class="text-xs text-gray-500 mb-1">Date Ordered</div>
                                <div class="text-sm">March 30, 2025</div>
                                <div class="sm:hidden mt-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <span class="h-2 w-2 mr-1 rounded-full bg-yellow-400"></span>
                                        In Progress
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order 2 -->
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <div class="p-4 border-b border-gray-100 flex items-center">
                            <div class="h-10 w-10 flex-shrink-0 rounded bg-pink-100 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-pink-600" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4 2a2 2 0 00-2 2v11a3 3 0 106 0V4a2 2 0 00-2-2H4zm1 14a1 1 0 100-2 1 1 0 000 2zm5-1.757l4.9-4.9a2 2 0 000-2.828L13.485 5.1a2 2 0 00-2.828 0L10 5.757v8.486zM16 18H9.071l6-6H16a2 2 0 012 2v2a2 2 0 01-2 2z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3 flex-grow">
                                <div class="flex flex-col sm:flex-row sm:justify-between">
                                    <h3 class="text-sm font-medium text-gray-900">UI/UX Design Consultation</h3>
                                    <span class="text-xs text-gray-500 mt-1 sm:mt-0">Order #FH-2497625</span>
                                </div>
                            </div>
                            <div class="hidden sm:block">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <span class="h-2 w-2 mr-1 rounded-full bg-green-400"></span>
                                    Completed
                                </span>
                            </div>
                        </div>
                        <div class="p-4 grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <div class="text-xs text-gray-500 mb-1">Package</div>
                                <div class="text-sm font-medium">Premium Package</div>
                                <div class="mt-1 text-sm text-gray-700">$899</div>
                            </div>
                            <div>
                                <div class="text-xs text-gray-500 mb-1">Delivery</div>
                                <div class="text-sm">14 Days Delivery</div>
                                <div class="text-sm">Unlimited Revisions</div>
                            </div>
                            <div>
                                <div class="text-xs text-gray-500 mb-1">Date Ordered</div>
                                <div class="text-sm">March 15, 2025</div>
                                <div class="sm:hidden mt-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <span class="h-2 w-2 mr-1 rounded-full bg-green-400"></span>
                                        Completed
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order 3 -->
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <div class="p-4 border-b border-gray-100 flex items-center">
                            <div class="h-10 w-10 flex-shrink-0 rounded bg-blue-100 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                                </svg>
                            </div>
                            <div class="ml-3 flex-grow">
                                <div class="flex flex-col sm:flex-row sm:justify-between">
                                    <h3 class="text-sm font-medium text-gray-900">E-commerce Integration</h3>
                                    <span class="text-xs text-gray-500 mt-1 sm:mt-0">Order #FH-2482371</span>
                                </div>
                            </div>
                            <div class="hidden sm:block">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                    <span class="h-2 w-2 mr-1 rounded-full bg-indigo-400"></span>
                                    Delivered
                                </span>
                            </div>
                        </div>
                        <div class="p-4 grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <div class="text-xs text-gray-500 mb-1">Package</div>
                                <div class="text-sm font-medium">Standard Package</div>
                                <div class="mt-1 text-sm text-gray-700">$649</div>
                            </div>
                            <div>
                                <div class="text-xs text-gray-500 mb-1">Delivery</div>
                                <div class="text-sm">10 Days Delivery</div>
                                <div class="text-sm">3 Revisions</div>
                            </div>
                            <div>
                                <div class="text-xs text-gray-500 mb-1">Date Ordered</div>
                                <div class="text-sm">February 28, 2025</div>
                                <div class="sm:hidden mt-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                        <span class="h-2 w-2 mr-1 rounded-full bg-indigo-400"></span>
                                        Delivered
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Empty State - No Orders -->
            <div class="empty-state hidden">
                <div class="bg-white rounded-lg shadow-sm p-8 text-center">
                    <div class="mx-auto w-24 h-24 rounded-full bg-gray-100 flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-medium text-gray-900 mb-2">You have no orders yet</h3>
                    <p class="text-base text-gray-500 mb-8 max-w-md mx-auto">Start by exploring services and finding the right freelancer for your project needs.</p>
                    <a href="{{ route('client.services') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg shadow-sm text-white primary-gradient hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Explore Services
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 -mr-1 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </main>
@endsection