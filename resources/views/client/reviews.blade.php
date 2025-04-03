<!-- resources/views/client/reviews.blade.php -->
@extends('layouts.app')

@section('title', 'Your Reviews - FreelanceHub')

@section('content')
    <div class="flex-1 py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Page header -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Your Reviews</h1>
                    <p class="mt-1 text-sm text-gray-500">
                        Manage your reviews for services you've purchased
                    </p>
                </div>
                <a href="{{ route('client.dashboard') }}" class="mt-4 md:mt-0 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white primary-gradient hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Dashboard
                </a>
            </div>

            <!-- Write a new review button -->
            <div class="mb-8 text-right">
                <button id="openNewReviewBtn" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white primary-gradient hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Write a Review
                </button>
            </div>

            <!-- Reviews list section -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-5 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900">Your Reviews</h2>
                </div>
                
                <!-- Reviews list - Static HTML for demonstration -->
                <div id="reviewsList">
                    <!-- Review 1 -->
                    <div class="review-item border-b border-gray-200" data-review-id="1">
                        <div class="p-6">
                            <div class="sm:flex sm:items-start sm:justify-between">
                                <div>
                                    <h3 class="text-base font-medium text-gray-900">Full Stack Web Development Services - Basic Package</h3>
                                    <div class="mt-1 flex items-center">
                                        <div class="flex text-lg">
                                            <span class="text-yellow-400">★</span>
                                            <span class="text-yellow-400">★</span>
                                            <span class="text-yellow-400">★</span>
                                            <span class="text-yellow-400">★</span>
                                            <span class="text-yellow-400">★</span>
                                        </div>
                                        <span class="ml-2 text-sm text-gray-500">5.0</span>
                                    </div>
                                </div>
                                <div class="mt-4 sm:mt-0 flex space-x-2">
                                    <button onclick="openEditReviewModal(1)" class="edit-btn text-sm text-indigo-600 hover:text-indigo-900 font-medium focus:outline-none">
                                        Edit
                                    </button>
                                    <button onclick="confirmDeleteReview(1)" class="delete-btn text-sm text-red-600 hover:text-red-900 font-medium focus:outline-none">
                                        Delete
                                    </button>
                                </div>
                            </div>
                            <div class="mt-4">
                                <p class="text-sm text-gray-600">Excellent work! Delivered ahead of schedule and exceeded my expectations. The developer was very responsive and implemented all my feedback promptly.</p>
                            </div>
                            <div class="mt-4 text-xs text-gray-500">
                                Posted on March 30, 2025
                            </div>
                        </div>
                    </div>
                    
                    <!-- Review 2 -->
                    <div class="review-item border-b border-gray-200" data-review-id="2">
                        <div class="p-6">
                            <div class="sm:flex sm:items-start sm:justify-between">
                                <div>
                                    <h3 class="text-base font-medium text-gray-900">UI/UX Design Services - Standard Package</h3>
                                    <div class="mt-1 flex items-center">
                                        <div class="flex text-lg">
                                            <span class="text-yellow-400">★</span>
                                            <span class="text-yellow-400">★</span>
                                            <span class="text-yellow-400">★</span>
                                            <span class="text-yellow-400">★</span>
                                            <span class="text-gray-300">★</span>
                                        </div>
                                        <span class="ml-2 text-sm text-gray-500">4.0</span>
                                    </div>
                                </div>
                                <div class="mt-4 sm:mt-0 flex space-x-2">
                                    <button onclick="openEditReviewModal(2)" class="edit-btn text-sm text-indigo-600 hover:text-indigo-900 font-medium focus:outline-none">
                                        Edit
                                    </button>
                                    <button onclick="confirmDeleteReview(2)" class="delete-btn text-sm text-red-600 hover:text-red-900 font-medium focus:outline-none">
                                        Delete
                                    </button>
                                </div>
                            </div>
                            <div class="mt-4">
                                <p class="text-sm text-gray-600">Great design work overall. Clean, modern interface with good attention to user experience. Would recommend for future projects.</p>
                            </div>
                            <div class="mt-4 text-xs text-gray-500">
                                Posted on March 15, 2025
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Empty state (hidden by default) -->
                <div id="emptyState" class="hidden p-8 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No reviews yet</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        You haven't written any reviews yet. Start by reviewing your completed orders!
                    </p>
                    <div class="mt-6">
                        <a href="{{ route('client.orders') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white primary-gradient hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            View Order History
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for writing a new review -->
    <div id="newReviewModal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-lg max-w-md w-full">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Write a Review</h3>
                    <button onclick="closeNewReviewModal()" class="text-gray-400 hover:text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form id="newReviewForm" action="#" method="POST">
                    <div class="space-y-4">
                        <!-- Order selection -->
                        <div>
                            <label for="orderSelect" class="block text-sm font-medium text-gray-700">Select a completed order</label>
                            <select id="orderSelect" name="orderSelect" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="" disabled selected>Select an order</option>
                                <option value="order1">Full Stack Web Development Services - Basic Package</option>
                                <option value="order2">Mobile App Development - Premium Package</option>
                                <option value="order3">UI/UX Design Services - Standard Package</option>
                            </select>
                        </div>

                        <!-- Rating -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
                            <div class="flex text-2xl">
                                <input type="radio" id="star5" name="rating" value="5" class="hidden peer/star5">
                                <label for="star5" class="cursor-pointer text-gray-300 hover:text-yellow-400 peer-checked/star5:text-yellow-400">★</label>
                                
                                <input type="radio" id="star4" name="rating" value="4" class="hidden peer/star4">
                                <label for="star4" class="cursor-pointer text-gray-300 hover:text-yellow-400 peer-checked/star4:text-yellow-400">★</label>
                                
                                <input type="radio" id="star3" name="rating" value="3" class="hidden peer/star3">
                                <label for="star3" class="cursor-pointer text-gray-300 hover:text-yellow-400 peer-checked/star3:text-yellow-400">★</label>
                                
                                <input type="radio" id="star2" name="rating" value="2" class="hidden peer/star2">
                                <label for="star2" class="cursor-pointer text-gray-300 hover:text-yellow-400 peer-checked/star2:text-yellow-400">★</label>
                                
                                <input type="radio" id="star1" name="rating" value="1" class="hidden peer/star1">
                                <label for="star1" class="cursor-pointer text-gray-300 hover:text-yellow-400 peer-checked/star1:text-yellow-400">★</label>
                            </div>
                        </div>

                        <!-- Review comment -->
                        <div>
                            <label for="reviewComment" class="block text-sm font-medium text-gray-700">Your Review</label>
                            <textarea id="reviewComment" name="reviewComment" rows="4" class="mt-1 block w-full shadow-sm sm:text-sm focus:ring-indigo-500 focus:border-indigo-500 border border-gray-300 rounded-md" placeholder="Share your experience with this service..."></textarea>
                        </div>

                        <!-- Submit button -->
                        <div class="text-right">
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white primary-gradient hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Submit Review
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for editing a review -->
    <div id="editReviewModal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-lg max-w-md w-full">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Edit Your Review</h3>
                    <button onclick="closeEditReviewModal()" class="text-gray-400 hover:text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form id="editReviewForm" action="#" method="POST">
                    <input type="hidden" id="editReviewId" name="reviewId">
                    <div class="space-y-4">
                        <!-- Edit Rating -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
                            <div class="flex text-2xl">
                                <input type="radio" id="editStar5" name="editRating" value="5" class="hidden peer/editStar5">
                                <label for="editStar5" class="cursor-pointer text-gray-300 hover:text-yellow-400 peer-checked/editStar5:text-yellow-400">★</label>
                                
                                <input type="radio" id="editStar4" name="editRating" value="4" class="hidden peer/editStar4">
                                <label for="editStar4" class="cursor-pointer text-gray-300 hover:text-yellow-400 peer-checked/editStar4:text-yellow-400">★</label>
                                
                                <input type="radio" id="editStar3" name="editRating" value="3" class="hidden peer/editStar3">
                                <label for="editStar3" class="cursor-pointer text-gray-300 hover:text-yellow-400 peer-checked/editStar3:text-yellow-400">★</label>
                                
                                <input type="radio" id="editStar2" name="editRating" value="2" class="hidden peer/editStar2">
                                <label for="editStar2" class="cursor-pointer text-gray-300 hover:text-yellow-400 peer-checked/editStar2:text-yellow-400">★</label>
                                
                                <input type="radio" id="editStar1" name="editRating" value="1" class="hidden peer/editStar1">
                                <label for="editStar1" class="cursor-pointer text-gray-300 hover:text-yellow-400 peer-checked/editStar1:text-yellow-400">★</label>
                            </div>
                        </div>

                        <!-- Edit Review comment -->
                        <div>
                            <label for="editReviewComment" class="block text-sm font-medium text-gray-700">Your Review</label>
                            <textarea id="editReviewComment" name="editReviewComment" rows="4" class="mt-1 block w-full shadow-sm sm:text-sm focus:ring-indigo-500 focus:border-indigo-500 border border-gray-300 rounded-md"></textarea>
                        </div>

                        <!-- Submit button -->
                        <div class="text-right">
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white primary-gradient hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Save Changes
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/reviews.js') }}"></script>
@endsection