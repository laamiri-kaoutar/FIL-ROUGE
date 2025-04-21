@extends('layouts.app')

@section('title', '{{ $service->title }} - FreelanceHub')

@section('content')
    <main class="max-w-6xl mx-auto px-4 py-8">
        <!-- Service Overview Section -->
        <section class="mb-10">
            <div class="grid md:grid-cols-3 gap-6">
                <!-- Left Column - Image & Info -->
                <div class="md:col-span-2">
                    <!-- Main Image -->
                    <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
                        <img src="{{ $service->images->where('is_main', true)->first() ? asset('storage/' . $service->images->where('is_main', true)->first()->image_path) : 'https://via.placeholder.com/400x200' }}" 
                             alt="{{ $service->title }}" 
                             class="w-full h-64 object-cover rounded">
                        
                        <!-- Thumbnail Images -->
                        <div class="flex gap-4 mt-4">
                            @foreach ($service->images as $image)
                                <img src="{{ asset('storage/' . $image->image_path) }}" 
                                     class="w-20 h-16 object-cover rounded">
                            @endforeach
                        </div>
                    </div>

                    <!-- Service Title & Freelancer Info -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <div class="flex gap-4 items-start mb-4">
                            <img src="{{ $service->user->profile_photo_path ? asset('storage/' . $service->user->profile_photo_path) : 'https://via.placeholder.com/50' }}" 
                                 alt="{{ $service->user->name }}" 
                                 class="w-12 h-12 rounded-full">
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900">
                                    {{ $service->title }}
                                </h1>
                                <div class="flex items-center gap-4 mt-2 text-sm">
                                    <a href="#" class="text-purple-600 hover:text-purple-700 font-medium">{{ $service->user->name }}</a>
                                    <div class="flex items-center">
                                        <span class="text-yellow-400">
                                            @for ($i = 0; $i < 5; $i++)
                                                {{ $i < $service->rating ? '★' : '☆' }}
                                            @endfor
                                        </span>
                                        <span class="ml-1 text-gray-600">{{ number_format($service->rating, 1) }} ({{ $service->reviews()->count() }})</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Add to Favorites Button -->
                        <button id="favoriteBtn" class="flex items-center text-sm font-medium text-gray-600 hover:text-purple-600 {{ auth()->check() && auth()->user()->favorites()->where('service_id', $service->id)->exists() ? 'text-red-600' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                            <span id="favoriteText">{{ auth()->check() && auth()->user()->favorites()->where('service_id', $service->id)->exists() ? 'Added to Favorites' : 'Add to Favorites' }}</span>
                        </button>
                    </div>
                </div>

                <!-- Right Column - Contact Freelancer -->
                <div>
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Contact Freelancer</h3>
                        <button class="w-full py-3 px-4 text-sm font-medium text-purple-600 bg-purple-50 hover:bg-purple-100 rounded mb-4" disabled>
                            Message {{ $service->user->name }}
                        </button>
                        <p class="text-sm text-gray-600">
                            Messaging functionality coming soon. Stay tuned!
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Description Section -->
        <section class="mb-10">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-xl font-semibold mb-6">About This Service</h2>
                <div class="text-gray-600">
                    <p class="mb-6">
                        {{ $service->description }}
                    </p>

                    <h3 class="text-lg font-semibold text-gray-900 mt-8 mb-4">Category:</h3>
                    <p class="text-gray-600 mb-6">{{ $service->category->name }}</p>

                    <h3 class="text-lg font-semibold text-gray-900 mt-8 mb-4">Tags:</h3>
                    <div class="flex flex-wrap gap-2 mb-6">
                        @foreach ($service->tags as $tag)
                            <span class="bg-purple-100 text-purple-800 text-sm px-3 py-1 rounded-full font-medium" style="background-color: {{ $tag->color }}; color: #FFFFFF;">#{{ $tag->name }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <!-- Packages Section -->
        <section class="mb-10">
            <h2 class="text-xl font-semibold mb-6">Choose a Package</h2>
            <div class="grid md:grid-cols-3 gap-6">
                @foreach ($service->packages as $package)
                    <div class="bg-white rounded-lg shadow-sm p-5 hover:border-purple-600 hover:border-2 transition-all {{ $loop->first ? 'border-2 border-blue-500' : '' }}">
                        <div class="flex justify-between items-center mb-2">
                            <span class="font-semibold text-lg">{{ $package->name }}</span>
                            <span class="bg-{{ $loop->index == 0 ? 'blue' : ($loop->index == 1 ? 'purple' : 'green') }}-100 text-{{ $loop->index == 0 ? 'blue' : ($loop->index == 1 ? 'purple' : 'green') }}-800 px-3 py-1 rounded-full text-sm">
                                {{ $package->package_type }}
                            </span>
                        </div>
                        <div class="text-2xl font-bold text-gray-900 mb-3">${{ $package->price }}</div>
                        <p class="text-gray-600 mb-4">{{ $package->description ?? 'A package tailored for your needs.' }}</p>
                        
                        <div class="border-t border-gray-100 pt-4 space-y-3 mb-6">
                            @foreach ($package->features as $feature)
                                <div class="flex items-start">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600 mt-0.5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>{{ $feature->name }}</span>
                                </div>
                            @endforeach
                        </div>

                        @php
                            $hasActiveOrder = auth()->check() && $service->orders()
                                ->where('user_id', auth()->id())
                                ->where('package_id', $package->id)
                                ->whereIn('status', ['pending', 'in_progress'])
                                ->exists();
                        @endphp
                        
                        @if ($hasActiveOrder)
                        <p class="text-gray-600 text-sm italic">You’ve already ordered this package. It’s currently in progress.</p>
                        @else
                        <button 
                            class="w-full py-3 px-4 text-sm font-medium text-white bg-{{ $loop->index == 0 ? 'blue' : ($loop->index == 1 ? 'purple' : 'green') }}-600 rounded hover:bg-{{ $loop->index == 0 ? 'blue' : ($loop->index == 1 ? 'purple' : 'green') }}-700"
                            data-package-id="{{ $package->id }}"
                            data-package-name="{{ $package->name }}"
                            data-price="{{ $package->price }}"
                            data-description="{{ $package->description ?? 'No description available' }}"
                            onclick="selectPackage(this)">
                            Select {{ $package->name }} Package
                        </button>


                        @endif
                   
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Reviews Section -->
        <section class="mb-10">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-xl font-semibold mb-6">Reviews</h2>
                
                <!-- Review Stats -->
                <div class="flex items-center mb-6">
                    <span class="text-yellow-400 text-lg">
                        @for ($i = 0; $i < 5; $i++)
                            {{ $i < $service->rating ? '★' : '☆' }}
                        @endfor
                    </span>
                    <span class="ml-2 font-medium">{{ number_format($service->rating, 1) }}</span>
                    <span class="text-gray-600">({{ $service->reviews()->count() }} reviews)</span>
                </div>

                <!-- Review Items -->
                <div class="space-y-6 mb-8">
                    @forelse ($service->reviews as $review)
                        <div class="flex gap-4 pb-6 border-b border-gray-100">
                            <img src="{{ $review->user->profile_photo_path ? asset('storage/' . $review->user->profile_photo_path) : 'https://via.placeholder.com/50' }}" 
                                alt="{{ $review->user->name }}" 
                                class="w-12 h-12 rounded-full">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <h4 class="font-medium">{{ $review->user->name }}</h4>
                                    <span class="text-yellow-400">
                                        @for ($i = 0; $i < 5; $i++)
                                            {{ $i < $review->rating ? '★' : '☆' }}
                                        @endfor
                                    </span>
                                </div>
                                <p class="text-sm text-gray-500 mb-2">{{ $review->created_at->diffForHumans() }}</p>
                                <p class="text-gray-600">
                                    {{ $review->comment ?? 'No comment provided.' }}
                                </p>
                                @auth
                                    @if ($review->user_id === auth()->id())
                                        <div class="mt-2 flex gap-2">
                                            <button onclick="openEditReviewModal({{ $review->id }})" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Edit</button>
                                            <form id="delete-review-form-{{ $review->id }}" action="{{ route('client.services.reviews.delete', [$service->id, $review->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="confirmDeleteReview({{ $review->id }})" class="text-red-600 hover:text-red-800 text-sm font-medium">Delete</button>
                                            </form>
                                        </div>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-600">No reviews yet.</p>
                    @endforelse
                </div>
                
                <!-- Add Review Form -->
                @auth
                    @if (!$service->reviews()->where('user_id', auth()->id())->exists())
                        <div class="border-t border-gray-200 pt-6">
                            <h3 class="font-medium mb-4">Leave Your Review</h3>
                            <form action="{{ route('client.services.review', $service->id) }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label class="block text-gray-700 mb-2">Your Rating</label>
                                    <select name="rating" class="border border-gray-300 rounded p-2">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}">{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-gray-700 mb-2">Your Review</label>
                                    <textarea name="comment" class="w-full p-3 border border-gray-300 rounded" rows="4" placeholder="Share your experience..."></textarea>
                                </div>
                                <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">
                                    Submit Review
                                </button>
                            </form>
                        </div>
                    @endif
                @endauth
            </div>
        </section>
    </main>

    <!-- Package Selection Modal -->
    <div id="packageModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg w-full max-w-md mx-4 shadow-lg">
            <!-- Modal Header -->
            <div class="bg-gray-50 px-6 py-4 rounded-t-lg border-b">
                <h3 class="text-lg font-semibold text-gray-900">Confirm Your Selection</h3>
            </div>
            
            <!-- Modal Body -->
            <div class="px-6 py-4">
                <div class="flex justify-between items-center mb-3">
                    <span id="packageName" class="font-semibold text-lg"></span>
                </div>
                <div id="packagePrice" class="text-2xl font-bold text-gray-900 mb-4"></div>
                <p id="packageDescription" class="text-gray-600 mb-4"></p>
            </div>
            
            <!-- Modal Footer -->
            <div class="bg-gray-50 px-6 py-4 rounded-b-lg border-t flex justify-end space-x-3">
                <button id="cancelButton" class="px-4 py-2 border border-gray-300 text-gray-700 rounded hover:bg-gray-100">
                    Cancel
                </button>
                <a id="confirmButton" href="#" class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700">
                    Proceed to Payment
                </a>
            </div>
        </div>
    </div>

    <!-- Edit Review Modal -->
    <div id="editReviewModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg w-full max-w-md mx-4 shadow-lg">
            <!-- Modal Header -->
            <div class="bg-gray-50 px-6 py-4 rounded-t-lg border-b">
                <h3 class="text-lg font-semibold text-gray-900">Edit Your Review</h3>
            </div>
            
            <!-- Modal Body -->
            <div class="px-6 py-4">
                <form id="editReviewForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Your Rating</label>
                        <select name="rating" id="editReviewRating" class="border border-gray-300 rounded p-2 w-full">
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}">{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Your Review</label>
                        <textarea name="comment" id="editReviewComment" class="w-full p-3 border border-gray-300 rounded" rows="4" placeholder="Share your experience..."></textarea>
                    </div>
                </form>
            </div>
            
            <!-- Modal Footer -->
            <div class="bg-gray-50 px-6 py-4 rounded-b-lg border-t flex justify-end space-x-3">
                <button onclick="closeEditReviewModal()" class="px-4 py-2 border border-gray-300 text-gray-700 rounded hover:bg-gray-100">
                    Cancel
                </button>
                <button onclick="submitEditReview()" class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700">
                    Update Review
                </button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Include SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // DOM elements
        const packageModal = document.getElementById('packageModal');
        const confirmButton = document.getElementById('confirmButton');
        const cancelButton = document.getElementById('cancelButton');
        const favoriteBtn = document.getElementById('favoriteBtn');
        const favoriteText = document.getElementById('favoriteText');
        const editReviewModal = document.getElementById('editReviewModal');
        const editReviewForm = document.getElementById('editReviewForm');
        let currentReviewId = null;

        // Function to open modal and populate with package details
        function selectPackage(button) {
            const packageId = button.getAttribute('data-package-id');
            const packageName = button.getAttribute('data-package-name');
            const price = button.getAttribute('data-price');
            const description = button.getAttribute('data-description');

            // Populate modal with package details
            document.getElementById('packageName').textContent = packageName + ' Package';
            document.getElementById('packagePrice').textContent = '$' + price;
            document.getElementById('packageDescription').textContent = description;

            // Set the payment link
            confirmButton.href = `/client/services/{{ $service->id }}/order?package_id=${packageId}`;

            // Show the modal
            packageModal.classList.remove('hidden');
        }
        
        // Function to close the package modal
        function closeModal() {
            packageModal.classList.add('hidden');
        }
        
        // Toggle favorite status
        function toggleFavorite() {
            fetch('{{ route('client.services.favorite', $service->id) }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.isFavorited) {
                    favoriteBtn.classList.add('text-red-600');
                    favoriteText.textContent = 'Added to Favorites';
                } else {
                    favoriteBtn.classList.remove('text-red-600');
                    favoriteText.textContent = 'Add to Favorites';
                }
            })
            .catch(error => console.error('Error:', error));
        }

        // Open Edit Review Modal
        function openEditReviewModal(reviewId) {
            currentReviewId = reviewId;
            fetch(`/client/services/{{ $service->id }}/reviews/${reviewId}/edit`, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                // Populate the modal form
                document.getElementById('editReviewRating').value = data.rating;
                document.getElementById('editReviewComment').value = data.comment || '';

                // Set the form action
                editReviewForm.action = `/client/services/{{ $service->id }}/reviews/${reviewId}`;

                // Show the modal
                editReviewModal.classList.remove('hidden');
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to load review data.');
            });
        }

        // Close Edit Review Modal
        function closeEditReviewModal() {
            editReviewModal.classList.add('hidden');
            currentReviewId = null;
        }

        // Submit Edit Review Form
        function submitEditReview() {
            editReviewForm.submit();
        }

        // Confirm Delete Review with SweetAlert
        function confirmDeleteReview(reviewId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-review-form-${reviewId}`).submit();
                }
            });
        }
        
        // Event listeners for package modal
        cancelButton.addEventListener('click', closeModal);
        favoriteBtn.addEventListener('click', toggleFavorite);
        
        // Close the package modal if user clicks outside
        packageModal.addEventListener('click', function(event) {
            if (event.target === packageModal) {
                closeModal();
            }
        });

        // Close the edit review modal if user clicks outside
        editReviewModal.addEventListener('click', function(event) {
            if (event.target === editReviewModal) {
                closeEditReviewModal();
            }
        });
    </script>
@endsection