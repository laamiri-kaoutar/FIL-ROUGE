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

            <!-- Reviews list section -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-5 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900">Your Reviews</h2>
                </div>
                
                <!-- Reviews list -->
                @if ($reviews->isNotEmpty())
                    <div id="reviewsList">
                        @foreach ($reviews as $review)
                            <div class="review-item border-b border-gray-200" data-review-id="{{ $review->id }}">
                                <div class="p-6">
                                    <div class="sm:flex sm:items-start sm:justify-between">
                                        <div>
                                            <h3 class="text-base font-medium text-gray-900">{{ $review->service->title }}</h3>
                                            <div class="mt-1 flex items-center">
                                                <div class="flex text-lg">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <span class="{{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                                                    @endfor
                                                </div>
                                                <span class="ml-2 text-sm text-gray-500">{{ number_format($review->rating, 1) }}</span>
                                            </div>
                                        </div>
                                        <div class="mt-4 sm:mt-0 flex space-x-2">
                                            <button onclick="openEditReviewModal({{ $review->id }}, {{ $review->rating }}, '{{ addslashes($review->comment) }}', {{ $review->service_id }})" class="edit-btn text-sm text-indigo-600 hover:text-indigo-900 font-medium focus:outline-none">
                                                Edit
                                            </button>
                                            <button onclick="confirmDelete({{ $review->id }})" class="delete-btn text-sm text-red-600 hover:text-red-900 font-medium focus:outline-none">
                                                Delete
                                            </button>
                                            <form id="delete-form-{{ $review->id }}" action="{{ route('client.services.reviews.delete', [$review->service_id, $review->id]) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <p class="text-sm text-gray-600">{{ $review->comment }}</p>
                                    </div>
                                    <div class="mt-4 text-xs text-gray-500">
                                        Posted on {{ $review->created_at->format('F d, Y') }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <!-- Empty state -->
                    <div id="emptyState" class="p-8 text-center">
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
                @endif
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
                <form id="editReviewForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editReviewId" name="reviewId">
                    <input type="hidden" id="editServiceId" name="serviceId">
                    <div class="space-y-4">
                        <!-- Edit Rating -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
                            <div class="flex text-2xl" id="editRatingStars">
                                @for ($i = 5; $i >= 1; $i--)
                                    <input type="radio" id="editStar{{ $i }}" name="rating" value="{{ $i }}" class="hidden peer/editStar{{ $i }}">
                                    <label for="editStar{{ $i }}" class="cursor-pointer text-gray-300 hover:text-yellow-400 peer-checked/editStar{{ $i }}:text-yellow-400">★</label>
                                @endfor
                            </div>
                        </div>
                        <!-- Edit Review comment -->
                        <div>
                            <label for="editReviewComment" class="block text-sm font-medium text-gray-700">Your Review</label>
                            <textarea id="editReviewComment" name="comment" rows="4" class="mt-1 block w-full shadow-sm sm:text-sm focus:ring-indigo-500 focus:border-indigo-500 border border-gray-300 rounded-md" required></textarea>
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
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won’t be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${id}`).submit();
                }
            });
        }

        function openEditReviewModal(reviewId, rating, comment, serviceId) {
            const modal = document.getElementById('editReviewModal');
            const form = document.getElementById('editReviewForm');
            const reviewIdInput = document.getElementById('editReviewId');
            const serviceIdInput = document.getElementById('editServiceId');
            const commentTextarea = document.getElementById('editReviewComment');

            // Set the form action dynamically with both serviceId and reviewId
            form.action = `/client/services/${serviceId}/reviews/${reviewId}`;
            reviewIdInput.value = reviewId;
            serviceIdInput.value = serviceId;
            commentTextarea.value = comment;

            const ratingInputs = document.querySelectorAll('input[name="rating"]');
            ratingInputs.forEach(input => {
                if (parseInt(input.value) === rating) {
                    input.checked = true;
                }
            });

            modal.classList.remove('hidden');
        }

        function closeEditReviewModal() {
            const modal = document.getElementById('editReviewModal');
            modal.classList.add('hidden');
            document.getElementById('editReviewForm').reset();
        }
    </script>
@endsection