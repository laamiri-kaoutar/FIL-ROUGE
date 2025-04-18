<!-- resources/views/freelancer/services.blade.php -->
@extends('layouts.app')

@section('title', 'My Services - FreelanceHub')

@section('content')
    <main class="container mx-auto px-8 py-12">
        <!-- Page Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">My Services</h1>
                <p class="text-gray-600">Manage your service offerings and packages</p>
            </div>
            <div class="mt-4 md:mt-0 flex space-x-4">
                <a href="{{ route('freelancer.dashboard') }}" class="text-indigo-600 hover:text-indigo-800 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard
                </a>
                <button id="createServiceBtn" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white primary-gradient hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Create New Service
                </button>
            </div>
        </div>

 <!-- Services Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse ($services as $service)
        <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100">
            <div class="relative h-48 bg-gray-200">
                @if ($service->images->where('is_main', true)->first())
                    <img src="{{ asset('storage/' . $service->images->where('is_main', true)->first()->image_path) }}" alt="{{ $service->title }}" class="w-full h-full object-cover">
                @else
                    <img src="https://via.placeholder.com/400x200" alt="{{ $service->title }}" class="w-full h-full object-cover">
                @endif
                <div class="absolute top-2 right-2 text-xs font-medium px-2.5 py-0.5 rounded 
                    {{ $service->status === 'active' ? 'bg-green-100 text-green-800' : ($service->status === 'inactive' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                    {{ ucfirst($service->status) }}
                </div>
            </div>
            <div class="p-4">
                <div class="flex justify-between items-start">
                    <h3 class="text-lg font-semibold text-gray-800">{{ $service->title }}</h3>
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <span class="ml-1 text-sm text-gray-600">{{ number_format($service->rating, 1) }}</span>
                    </div>
                </div>
                <p class="mt-2 text-sm text-gray-600 line-clamp-2">{{ $service->description }}</p>
                
                <!-- Packages Preview -->
                <div class="mt-3">
                    <div class="text-xs text-gray-500 uppercase font-medium">Packages:</div>
                    <div class="mt-1 flex flex-wrap gap-2">
                        @foreach ($service->packages as $package)
                            <span class="px-2 py-1 bg-gray-100 text-gray-800 text-xs rounded-full">
                                {{ ucfirst($package->package_type) }}: ${{ number_format($package->price, 2) }}
                            </span>
                        @endforeach
                    </div>
                </div>
                
                <!-- Tags -->
                <div class="mt-3">
                    <div class="text-xs text-gray-500 uppercase font-medium">Tags:</div>
                    <div class="mt-1 flex flex-wrap gap-2">
                        @foreach ($service->tags as $tag)
                            <span class="px-2 py-1 bg-indigo-100 text-indigo-800 text-xs rounded-full">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                </div>
                
                <div class="mt-4 flex justify-end space-x-2">
                    <a href="{{ route('freelancer.service.edit', $service->id) }}" class="px-3 py-1 text-sm text-indigo-600 hover:text-indigo-800 border border-indigo-600 hover:border-indigo-800 rounded">
                        Edit
                    </a>
                    <form id="delete-service-form-{{ $service->id }}" action="{{ route('services.destroy', $service->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="confirmDeleteService({{ $service->id }})" class="px-3 py-1 text-sm text-red-600 hover:text-red-800 border border-red-600 hover:border-red-800 rounded">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <p class="text-gray-600">You have no services yet.</p>
    @endforelse
</div>

        
               <!-- Modal -->
        <div id="serviceModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 {{ session('errors') ? '' : 'hidden' }}">
            <div class="bg-white rounded-lg shadow-xl max-w-3xl w-full max-h-screen overflow-y-auto">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex justify-between items-center">
                        <h2 id="modalTitle" class="text-xl font-semibold text-gray-800">Create New Service</h2>
                        <button id="closeModalBtn" class="text-gray-400 hover:text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
                
                <div class="p-6">
                    <form id="serviceForm" action="{{ route('services.create') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Service Details -->
                        <div class="space-y-6">
                            <div>
                                <label for="serviceTitle" class="block text-sm font-medium text-gray-700">Service Title</label>
                                <input type="text" id="serviceTitle" name="serviceTitle" value="{{ old('serviceTitle') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="e.g., Logo Design" required>
                                @error('serviceTitle')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="serviceDescription" class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea id="serviceDescription" name="serviceDescription" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Describe your service in detail" required>{{ old('serviceDescription') }}</textarea>
                                @error('serviceDescription')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="serviceStatus" class="block text-sm font-medium text-gray-700">Status</label>
                                <select id="serviceStatus" name="serviceStatus" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                    <option value="active" {{ old('serviceStatus') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('serviceStatus') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('serviceStatus')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tags</label>
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-2 max-h-40 overflow-y-auto p-2 border border-gray-300 rounded-md">
                                    @foreach ($tags as $tag)
                                        <div class="flex items-center rounded-md">
                                            <input type="checkbox" id="tag-{{ $tag->name }}" name="serviceTags[]" value="{{ $tag->id }}" {{ in_array($tag->id, old('serviceTags', [])) ? 'checked' : '' }} class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                            <label for="tag-{{ $tag->name }}" style="background-color: {{ $tag->color }};" class="ml-2 text-sm rounded-md p-1 text-gray-700">{{ $tag->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                @error('serviceTags')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="serviceCategory" class="block text-sm font-medium text-gray-700">Category</label>
                                <select id="serviceCategory" name="serviceCategory" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('serviceCategory') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('serviceCategory')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="serviceImage" class="block text-sm font-medium text-gray-700">Service Image</label>
                                <div class="mt-2">
                                    <div class="flex items-center justify-center w-full">
                                        <label for="serviceImage" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-md cursor-pointer bg-gray-50 hover:bg-gray-100">
                                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                <svg class="w-8 h-8 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                                </svg>
                                                <p class="text-sm text-gray-500">Click to upload an image</p>
                                                <p class="text-xs text-gray-400">PNG, JPG (max. 5MB)</p>
                                            </div>
                                            <input type="file" id="serviceImage" name="serviceImage" accept="image/*" class="hidden">
                                        </label>
                                    </div>
                                    <div id="imagePreview" class="mt-2 hidden">
                                        <img src="#" alt="Preview" class="max-h-40 rounded-md">
                                    </div>
                                    @error('serviceImage')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <!-- Service Packages -->
                        <div class="mt-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-medium text-gray-900">Service Packages</h3>
                                <button type="button" id="addPackageBtn" class="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    Add Package
                                </button>
                            </div>
                            
                            <div id="packagesContainer" class="space-y-4">
                                @php
                                    $packageCount = old('packageName') ? count(old('packageName')) : 1;
                                @endphp
                                @for ($i = 0; $i < $packageCount; $i++)
                                    <div class="package-item bg-gray-50 p-4 rounded-md relative">
                                        <button type="button" class="remove-package absolute top-2 right-2 text-gray-400 hover:text-gray-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Package Name</label>
                                                <input type="text" name="packageName[]" value="{{ old('packageName.'.$i) }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="e.g., Basic, Standard, Premium" required>
                                                @error('packageName.'.$i)
                                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Package Type</label>
                                                <select name="packageType[]" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                                    <option value="basic" {{ old('packageType.'.$i) == 'basic' ? 'selected' : '' }}>Basic</option>
                                                    <option value="standard" {{ old('packageType.'.$i) == 'standard' ? 'selected' : '' }}>Standard</option>
                                                    <option value="premium" {{ old('packageType.'.$i) == 'premium' ? 'selected' : '' }}>Premium</option>
                                                </select>
                                                @error('packageType.'.$i)
                                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Price ($)</label>
                                                <input type="number" name="packagePrice[]" value="{{ old('packagePrice.'.$i) }}" min="1" step="0.01" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="e.g., 50.00" required>
                                                @error('packagePrice.'.$i)
                                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Revisions</label>
                                                <input type="number" name="packageRevisions[]" value="{{ old('packageRevisions.'.$i) }}" min="0" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="e.g., 3" required>
                                                @error('packageRevisions.'.$i)
                                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="md:col-span-2">
                                                <label class="block text-sm font-medium text-gray-700">Delivery Time (days)</label>
                                                <input type="number" name="packageDeliveryTime[]" value="{{ old('packageDeliveryTime.'.$i) }}" min="1" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="e.g., 3" required>
                                                @error('packageDeliveryTime.'.$i)
                                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                        
                        <!-- Form Actions -->
                        <div class="mt-6 flex justify-end space-x-3">
                            <button type="button" id="cancelBtn" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Cancel
                            </button>
                            <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white primary-gradient hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Save Service
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('scripts')
    <script>
        
        const createServiceBtn = document.getElementById('createServiceBtn');
        const serviceModal = document.getElementById('serviceModal');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const cancelBtn = document.getElementById('cancelBtn');
        const modalTitle = document.getElementById('modalTitle');
        const addPackageBtn = document.getElementById('addPackageBtn');
        const packagesContainer = document.getElementById('packagesContainer');
        const editServiceBtns = document.querySelectorAll('.edit-service-btn');
        
        function toggleModal() {
            serviceModal.classList.toggle('hidden');
        }
        
        // Open modal for creating a new service
        createServiceBtn.addEventListener('click', () => {
            modalTitle.textContent = 'Create New Service';
            // Reset form here when implementing with backend
            toggleModal();
        });
        
        // Close modal buttons
        closeModalBtn.addEventListener('click', toggleModal);
        cancelBtn.addEventListener('click', toggleModal);
        
        // Add new package
        addPackageBtn.addEventListener('click', () => {
            const packageItem = document.querySelector('.package-item');
            const newPackage = packageItem.cloneNode(true);
            
            // Reset input values in the clone
            const inputs = newPackage.querySelectorAll('input');
            inputs.forEach(input => {
                input.value = '';
            });
            
            // Add remove event to the new package
            const removeBtn = newPackage.querySelector('.remove-package');
            removeBtn.addEventListener('click', () => {
                newPackage.remove();
            });
            
            packagesContainer.appendChild(newPackage);
        });
        
        // Remove package
        document.querySelectorAll('.remove-package').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const packageItems = document.querySelectorAll('.package-item');
                // Don't remove if it's the only package
                if (packageItems.length > 1) {
                    e.target.closest('.package-item').remove();
                }
            });
        });
        
        // Close modal when clicking outside
        window.addEventListener('click', (e) => {
            if (e.target === serviceModal) {
                toggleModal();
            }
        });

        function confirmDeleteService(serviceId) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'This service will be deleted permanently!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-service-form-${serviceId}`).submit();
                }
            });
        }
    </script>
@endsection