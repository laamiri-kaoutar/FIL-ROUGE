<!-- resources/views/client/service-show.blade.php -->
@extends('layouts.app')

@section('title', 'Service Details - FreelanceHub')

@section('content')
    <main class="max-w-6xl mx-auto px-4 py-8">
        <!-- Service Overview Section -->
        <section class="mb-10">
            <div class="grid md:grid-cols-3 gap-6">
                <!-- Left Column - Image & Info -->
                <div class="md:col-span-2">
                    <!-- Main Image (Simplified) -->
                    <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
                        <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085" 
                             alt="Service Main" 
                             class="w-full h-64 object-cover rounded">
                        
                        <!-- Thumbnail Images (Simplified as static) -->
                        <div class="flex gap-4 mt-4">
                            <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085" 
                                 class="w-20 h-16 object-cover rounded">
                            <img src="https://images.unsplash.com/photo-1461749280684-dccba630e2f6" 
                                 class="w-20 h-16 object-cover rounded">
                            <img src="https://images.unsplash.com/photo-1555066931-bf19f8fd1085" 
                                 class="w-20 h-16 object-cover rounded">
                        </div>
                    </div>

                    <!-- Service Title & Freelancer Info -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <div class="flex gap-4 items-start mb-4">
                            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e" 
                                 alt="Freelancer" 
                                 class="w-12 h-12 rounded-full">
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900">
                                    Full Stack Web Development Services
                                </h1>
                                <div class="flex items-center gap-4 mt-2 text-sm">
                                    <a href="#" class="text-purple-600 hover:text-purple-700 font-medium">John Developer</a>
                                    <div class="flex items-center">
                                        <span class="text-yellow-400">★★★★★</span>
                                        <span class="ml-1 text-gray-600">5.0 (128)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Add to Favorites Button -->
                        <button id="favoriteBtn" class="flex items-center text-sm font-medium text-gray-600 hover:text-purple-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                            <span id="favoriteText">Add to Favorites</span>
                        </button>
                    </div>
                </div>

                <!-- Right Column - Contact Freelancer -->
                <div>
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Contact Freelancer</h3>
                        <button class="w-full py-3 px-4 text-sm font-medium text-purple-600 bg-purple-50 hover:bg-purple-100 rounded mb-4">
                            Message John
                        </button>
                        <p class="text-sm text-gray-600">
                            Have questions about the service? Reach out to John directly to discuss your project needs.
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
                        I will create a complete, custom web application tailored to your specific needs using 
                        modern technologies and best practices. Whether you need a simple landing page or a 
                        complex web platform, I'll deliver high-quality, responsive, and scalable solutions.
                    </p>

                    <h3 class="text-lg font-semibold text-gray-900 mt-8 mb-4">What's Included:</h3>
                    <ul class="space-y-3 list-disc pl-5 mb-6">
                        <li>Custom frontend development using React/Vue/Angular</li>
                        <li>Backend development with Node.js/Python/PHP</li>
                        <li>Database design and implementation</li>
                        <li>API development and integration</li>
                        <li>Responsive design for all devices</li>
                        <li>Basic SEO implementation</li>
                    </ul>

                    <h3 class="text-lg font-semibold text-gray-900 mt-8 mb-4">Development Process:</h3>
                    <ol class="space-y-3 list-decimal pl-5 mb-6">
                        <li>Initial consultation and requirements gathering</li>
                        <li>Design and architecture planning</li>
                        <li>Development and testing phases</li>
                        <li>Client review and feedback</li>
                        <li>Final deployment and documentation</li>
                    </ol>
                </div>
            </div>
        </section>

        <!-- Packages Section - Now in a Row -->
        <section class="mb-10">
            <h2 class="text-xl font-semibold mb-6">Choose a Package</h2>
            <div class="grid md:grid-cols-3 gap-6">
                <!-- Basic Package -->
                <div class="bg-white rounded-lg shadow-sm p-5 hover:border-purple-600 hover:border-2 transition-all">
                    <div class="flex justify-between items-center mb-2">
                        <span class="font-semibold text-lg">Basic</span>
                        <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm">Standard</span>
                    </div>
                    <div class="text-2xl font-bold text-gray-900 mb-3">$499</div>
                    <p class="text-gray-600 mb-4">Perfect for small business websites or landing pages that need a professional touch.</p>
                    
                    <div class="border-t border-gray-100 pt-4 space-y-3 mb-6">
                        <div class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600 mt-0.5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span><span class="font-medium">5 Pages</span> - includes responsive design</span>
                        </div>
                        <div class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600 mt-0.5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span><span class="font-medium">7 Days Delivery</span> - standard turnaround time</span>
                        </div>
                        <div class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600 mt-0.5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span><span class="font-medium">2 Revisions</span> - to ensure satisfaction</span>
                        </div>
                    </div>
                    
                    <!-- Package Button -->
                    <button 
                        class="w-full py-3 px-4 text-sm font-medium text-white bg-purple-600 rounded hover:bg-purple-700"
                        data-package-name="Basic"
                        data-price="499"
                        data-pages="5"
                        data-delivery="7"
                        data-revisions="2"
                        data-tag="Standard"
                        data-tag-color="purple"
                        onclick="selectPackage(this)">
                        Select Basic Package
                    </button>
                </div>
                
                <!-- Standard Package -->
                <div class="bg-white rounded-lg shadow-sm p-5 hover:border-purple-600 hover:border-2 transition-all border-2 border-blue-500">
                    <div class="flex justify-between items-center mb-2">
                        <span class="font-semibold text-lg">Standard</span>
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">Popular</span>
                    </div>
                    <div class="text-2xl font-bold text-gray-900 mb-3">$799</div>
                    <p class="text-gray-600 mb-4">Comprehensive solution for businesses needing a robust online presence with multiple pages.</p>
                    
                    <div class="border-t border-gray-100 pt-4 space-y-3 mb-6">
                        <div class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600 mt-0.5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span><span class="font-medium">10 Pages</span> - includes responsive design</span>
                        </div>
                        <div class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600 mt-0.5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span><span class="font-medium">14 Days Delivery</span> - detailed development</span>
                        </div>
                        <div class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600 mt-0.5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span><span class="font-medium">5 Revisions</span> - refined to perfection</span>
                        </div>
                    </div>
                    
                    <!-- Package Button -->
                    <button 
                        class="w-full py-3 px-4 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700"
                        data-package-name="Standard"
                        data-price="799"
                        data-pages="10"
                        data-delivery="14"
                        data-revisions="5"
                        data-tag="Popular"
                        data-tag-color="blue"
                        onclick="selectPackage(this)">
                        Select Standard Package
                    </button>
                </div>
                
                <!-- Premium Package -->
                <div class="bg-white rounded-lg shadow-sm p-5 hover:border-purple-600 hover:border-2 transition-all">
                    <div class="flex justify-between items-center mb-2">
                        <span class="font-semibold text-lg">Premium</span>
                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">Enterprise</span>
                    </div>
                    <div class="text-2xl font-bold text-gray-900 mb-3">$1299</div>
                    <p class="text-gray-600 mb-4">Complete enterprise solution with unlimited pages and premium support for complex projects.</p>
                    
                    <div class="border-t border-gray-100 pt-4 space-y-3 mb-6">
                        <div class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600 mt-0.5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span><span class="font-medium">Unlimited Pages</span> - fully customizable</span>
                        </div>
                        <div class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600 mt-0.5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span><span class="font-medium">21 Days Delivery</span> - comprehensive development</span>
                        </div>
                        <div class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600 mt-0.5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span><span class="font-medium">Unlimited Revisions</span> - until you're satisfied</span>
                        </div>
                    </div>
                    
                    <!-- Package Button -->
                    <button 
                        class="w-full py-3 px-4 text-sm font-medium text-white bg-green-600 rounded hover:bg-green-700"
                        data-package-name="Premium"
                        data-price="1299"
                        data-pages="Unlimited"
                        data-delivery="21"
                        data-revisions="Unlimited"
                        data-tag="Enterprise"
                        data-tag-color="green"
                        onclick="selectPackage(this)">
                        Select Premium Package
                    </button>
                </div>
            </div>
        </section>

        <!-- Reviews Section -->
        <section class="mb-10">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-xl font-semibold mb-6">Reviews</h2>
                
                <!-- Review Stats -->
                <div class="flex items-center mb-6">
                    <span class="text-yellow-400 text-lg">★★★★★</span>
                    <span class="ml-2 font-medium">5.0</span>
                    <span class="text-gray-600">(128 reviews)</span>
                </div>

                <!-- Review Items -->
                <div class="space-y-6 mb-8">
                    <!-- Review Item -->
                    <div class="flex gap-4 pb-6 border-b border-gray-100">
                        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330" 
                             alt="Reviewer" 
                             class="w-12 h-12 rounded-full">
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <h4 class="font-medium">Sarah Wilson</h4>
                                <span class="text-yellow-400">★★★★★</span>
                            </div>
                            <p class="text-sm text-gray-500 mb-2">2 days ago</p>
                            <p class="text-gray-600">
                                Excellent work! The developer was very professional and delivered the project 
                                ahead of schedule. Communication was great throughout the process.
                            </p>
                        </div>
                    </div>
                    
                    <!-- Review Item -->
                    <div class="flex gap-4 pb-6 border-b border-gray-100">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d" 
                             alt="Reviewer" 
                             class="w-12 h-12 rounded-full">
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <h4 class="font-medium">Michael Brown</h4>
                                <span class="text-yellow-400">★★★★★</span>
                            </div>
                            <p class="text-sm text-gray-500 mb-2">1 week ago</p>
                            <p class="text-gray-600">
                                Great experience working with this developer. The final product exceeded my expectations.
                                Will definitely hire again for future projects.
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Add Review Form -->
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="font-medium mb-4">Leave Your Review</h3>
                    <form>
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">Your Rating</label>
                            <div class="flex gap-2 text-gray-400">
                                <span class="cursor-pointer hover:text-yellow-400">★</span>
                                <span class="cursor-pointer hover:text-yellow-400">★</span>
                                <span class="cursor-pointer hover:text-yellow-400">★</span>
                                <span class="cursor-pointer hover:text-yellow-400">★</span>
                                <span class="cursor-pointer hover:text-yellow-400">★</span>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">Your Review</label>
                            <textarea class="w-full p-3 border border-gray-300 rounded" rows="4" placeholder="Share your experience..."></textarea>
                        </div>
                        <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">
                            Submit Review
                        </button>
                    </form>
                </div>
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
                    <span id="packageTag" class="px-3 py-1 rounded-full text-sm"></span>
                </div>
                <div id="packagePrice" class="text-2xl font-bold text-gray-900 mb-4"></div>
                
                <div class="space-y-3 mb-6">
                    <div class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600 mt-0.5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span><span id="packagePages" class="font-medium"></span> Pages</span>
                    </div>
                    <div class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600 mt-0.5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span><span id="packageDelivery" class="font-medium"></span> Days Delivery</span>
                    </div>
                    <div class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600 mt-0.5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span><span id="packageRevisions" class="font-medium"></span> Revisions</span>
                    </div>
                </div>
            </div>
            
            <!-- Modal Footer -->
            <div class="bg-gray-50 px-6 py-4 rounded-b-lg border-t flex justify-end space-x-3">
                <button id="cancelButton" class="px-4 py-2 border border-gray-300 text-gray-700 rounded hover:bg-gray-100">
                    Cancel
                </button>
                <button id="confirmButton" class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700">
                    Proceed to Payment
                </button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // DOM elements
        const packageModal = document.getElementById('packageModal');
        const confirmButton = document.getElementById('confirmButton');
        const cancelButton = document.getElementById('cancelButton');
        const favoriteBtn = document.getElementById('favoriteBtn');
        const favoriteText = document.getElementById('favoriteText');
        
        // Selected package data
        let selectedPackage = null;
        
        // Function to open modal and populate with package details
        function selectPackage(button) {
            // Store selected package data
            selectedPackage = {
                name: button.getAttribute('data-package-name'),
                price: button.getAttribute('data-price'),
                pages: button.getAttribute('data-pages'),
                delivery: button.getAttribute('data-delivery'),
                revisions: button.getAttribute('data-revisions'),
                tag: button.getAttribute('data-tag'),
                tagColor: button.getAttribute('data-tag-color')
            };
            
            // Populate modal with package details
            document.getElementById('packageName').textContent = selectedPackage.name + ' Package';
            document.getElementById('packagePrice').textContent = '$' + selectedPackage.price;
            document.getElementById('packagePages').textContent = selectedPackage.pages;
            document.getElementById('packageDelivery').textContent = selectedPackage.delivery;
            document.getElementById('packageRevisions').textContent = selectedPackage.revisions;
            
            // Set the tag with appropriate styling
            const packageTag = document.getElementById('packageTag');
            packageTag.textContent = selectedPackage.tag;
            packageTag.className = 'px-3 py-1 rounded-full text-sm';
            
            switch(selectedPackage.tagColor) {
                case 'purple':
                    packageTag.classList.add('bg-purple-100', 'text-purple-800');
                    break;
                case 'blue':
                    packageTag.classList.add('bg-blue-100', 'text-blue-800');
                    break;
                case 'green':
                    packageTag.classList.add('bg-green-100', 'text-green-800');
                    break;
                default:
                    packageTag.classList.add('bg-gray-100', 'text-gray-800');
            }
            
            // Show the modal
            packageModal.classList.remove('hidden');
        }
        
        // Function to close the modal
        function closeModal() {
            packageModal.classList.add('hidden');
        }
        
        // Function to redirect to payment page with package details
        function proceedToPayment() {
            // Store package data in localStorage to access on payment page
            localStorage.setItem('selectedPackage', JSON.stringify(selectedPackage));
            
            // Redirect to payment page (placeholder for now)
            window.location.href = '#'; // Replace with actual payment route later
        }
        
        // Toggle favorite status
        function toggleFavorite() {
            const isFavorited = favoriteBtn.classList.contains('text-red-600');
            
            if (isFavorited) {
                favoriteBtn.classList.remove('text-red-600');
                favoriteText.textContent = 'Add to Favorites';
            } else {
                favoriteBtn.classList.add('text-red-600');
                favoriteText.textContent = 'Added to Favorites';
            }
        }
        
        // Event listeners
        confirmButton.addEventListener('click', proceedToPayment);
        cancelButton.addEventListener('click', closeModal);
        favoriteBtn.addEventListener('click', toggleFavorite);
        
        // Close the modal if user clicks outside
        packageModal.addEventListener('click', function(event) {
            if (event.target === packageModal) {
                closeModal();
            }
        });
    </script>
@endsection