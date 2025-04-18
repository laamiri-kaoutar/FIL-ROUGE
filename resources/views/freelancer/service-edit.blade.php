@extends('layouts.app')

@section('title', 'Edit Service - FreelanceHub')

@section('content')
    <div class="container mx-auto px-4 pb-12">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Edit Service</h1>
            <a href="{{ route('freelancer.services') }}" class="text-indigo-600 hover:text-indigo-800 flex items-center px-4 py-2 rounded-md transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Services
            </a>
        </div>

        <!-- Success/Error Messages -->
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-md">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-md">
                {{ session('error') }}
            </div>
        @endif

        <!-- Service Details -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4">Service Details</h2>
            <form id="serviceDetailsForm" action="{{ route('services.update', $service->id) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="serviceTitle" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                    <input type="text" id="serviceTitle" name="serviceTitle" value="{{ $service->title }}" 
                        class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-400 focus:border-transparent">
                    @error('serviceTitle')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="serviceDescription" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea id="serviceDescription" name="serviceDescription" rows="4"
                        class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-400 focus:border-transparent">{{ $service->description }}</textarea>
                    @error('serviceDescription')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="serviceStatus" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select id="serviceStatus" name="serviceStatus"
                        class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-400 focus:border-transparent">
                        <option value="active" {{ $service->status === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $service->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="draft" {{ $service->status === 'draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                    @error('serviceStatus')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex gap-3">
                    <button type="submit" class="px-6 py-2 primary-gradient text-white rounded-md hover:opacity-90 transition">
                        Save Changes
                    </button>
                    <button type="button" class="px-6 py-2 bg-gray-100 hover:bg-gray-200 rounded-md text-gray-700 transition">
                        Cancel
                    </button>
                </div>
            </form>
        </div>

        <!-- Service Images -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4">Service Images</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-6">
                @foreach ($service->images as $image)
                <div class="relative group">
                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="Service Image" class="w-full h-40 object-cover rounded-md">
                    <form id="delete-image-form-{{ $image->id }}" action="{{ route('services.deleteImage', [$service->id, $image->id]) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="confirmDeleteImage({{ $image->id }})" class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </form>
                </div>
                @endforeach
                @if ($service->images->count() < 5)
                    <div class="border-2 border-dashed border-gray-300 rounded-md flex flex-col items-center justify-center h-40 cursor-pointer hover:border-purple-400 transition">
                        <form action="{{ route('services.addImage', $service->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            <span class="text-sm font-medium text-gray-500 mt-2">Add Image</span>
                            <input type="file" name="image" accept="image/*" class="hidden" id="imageUpload" onchange="this.form.submit()">
                        </form>
                    </div>
                @endif
            </div>
            <div class="text-sm text-gray-500">
                <p>* You can upload up to 5 images for your service.</p>
                <p>* Recommended image size: 1200 x 800 pixels.</p>
            </div>
        </div>

        <!-- Service Packages -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">Service Packages</h2>
                @if ($service->packages->count() < 3)
                    <button id="btnAddPackage" class="flex items-center text-purple-600 hover:text-purple-800 transition" onclick="toggleAddPackageForm()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Add Package
                    </button>
                @endif
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($service->packages as $package)
                    <div class="border border-gray-200 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition" data-package-id="{{ $package->id }}">
                        <div class="bg-gray-50 p-4 border-b border-gray-200">
                            <div class="flex justify-between items-center mb-2">
                                <h3 class="font-semibold text-gray-800">{{ $package->name }}</h3>
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">{{ ucfirst($package->package_type) }}</span>
                            </div>
                            <p class="text-gray-600 text-sm mb-2">{{ $package->description ?? 'No description available.' }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-bold text-gray-900">${{ number_format($package->price, 2) }}</span>
                                <span class="text-sm text-gray-500">{{ $package->delivery_time }} days delivery</span>
                            </div>
                        </div>
                        
                        <div class="p-4">
                            <h4 class="text-sm font-medium text-gray-700 mb-2">Features</h4>
                            <ul class="space-y-2 mb-4">
                                @foreach ($package->features as $feature)
                                    <li class="flex items-center justify-between text-sm">
                                        <span>{{ $feature->description }} {{ $feature->is_included ? '(Included)' : '(Not Included)' }}</span>
                                        <form id="delete-feature-form-{{ $feature->id }}" action="{{ route('services.deleteFeature', [$service->id, $package->id, $feature->id]) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDeleteFeature({{ $feature->id }})" class="text-red-600 hover:text-red-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </form>
                                    </li>
                                @endforeach
                            </ul>
                            
                            <div class="flex justify-between">
                                <button class="text-purple-600 hover:text-purple-800 text-sm font-medium" onclick="toggleAddFeatureForm('{{ $package->id }}')">
                                    + Add Feature
                                </button>
                                <div class="space-x-2">
                                    <button class="text-blue-600 hover:text-blue-800 text-sm font-medium" onclick="toggleEditPackageForm('{{ $package->id }}', '{{ $package->name }}', '{{ $package->description }}', '{{ $package->price }}', '{{ $package->delivery_time }}')">
                                        Edit
                                    </button>
                                    <form id="delete-package-form-{{ $package->id }}" action="{{ route('services.deletePackage', [$service->id, $package->id]) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDeletePackage({{ $package->id }})" class="text-red-600 hover:text-red-800 text-sm font-medium">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Add Package Form (Hidden by default) -->
        <div id="addPackageForm" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Add New Package</h3>
                    <button onclick="toggleAddPackageForm()" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form action="{{ route('services.addPackage', $service->id) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="packageName" class="block text-sm font-medium text-gray-700 mb-1">Package Name</label>
                        <input type="text" id="packageName" name="packageName" placeholder="e.g. Basic, Standard, Premium" 
                            class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-400 focus:border-transparent">
                        @error('packageName')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="packageDescription" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea id="packageDescription" name="packageDescription" rows="2" placeholder="Brief description of the package"
                            class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-400 focus:border-transparent"></textarea>
                        @error('packageDescription')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="packageType" class="block text-sm font-medium text-gray-700 mb-1">Package Type</label>
                            <select id="packageType" name="packageType" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-400 focus:border-transparent">
                                @if (!$service->packages->pluck('package_type')->contains('basic'))
                                    <option value="basic">Basic</option>
                                @endif
                                @if (!$service->packages->pluck('package_type')->contains('standard'))
                                    <option value="standard">Standard</option>
                                @endif
                                @if (!$service->packages->pluck('package_type')->contains('premium'))
                                    <option value="premium">Premium</option>
                                @endif
                            </select>
                            @error('packageType')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="packagePrice" class="block text-sm font-medium text-gray-700 mb-1">Price ($)</label>
                            <input type="number" id="packagePrice" name="packagePrice" placeholder="e.g. 25" min="1" 
                                class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-400 focus:border-transparent">
                            @error('packagePrice')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <label for="packageRevisions" class="block text-sm font-medium text-gray-700 mb-1">Revisions</label>
                            <input type="number" id="packageRevisions" name="packageRevisions" placeholder="e.g. 2" min="0" 
                                class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-400 focus:border-transparent">
                            @error('packageRevisions')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="packageDelivery" class="block text-sm font-medium text-gray-700 mb-1">Delivery Time (days)</label>
                            <input type="number" id="packageDelivery" name="packageDelivery" placeholder="e.g. 3" min="1" 
                                class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-400 focus:border-transparent">
                            @error('packageDelivery')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="toggleAddPackageForm()" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-md text-gray-700 transition">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 primary-gradient text-white rounded-md hover:opacity-90 transition">
                            Add Package
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Package Form (Hidden by default) -->
        <div id="editPackageForm" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Edit Package</h3>
                    <button onclick="toggleEditPackageForm()" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form id="editPackageFormContent" method="POST">
                    @csrf
                    <input type="hidden" id="editPackageId" name="packageId">
                    <div class="mb-4">
                        <label for="editPackageName" class="block text-sm font-medium text-gray-700 mb-1">Package Name</label>
                        <input type="text" id="editPackageName" name="packageName" placeholder="e.g. Basic, Standard, Premium" 
                            class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-400 focus:border-transparent">
                        @error('packageName')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="editPackageDescription" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea id="editPackageDescription" name="packageDescription" rows="2" placeholder="Brief description of the package"
                            class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-400 focus:border-transparent"></textarea>
                        @error('packageDescription')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        
                        <div>
                            <label for="editPackagePrice" class="block text-sm font-medium text-gray-700 mb-1">Price ($)</label>
                            <input type="number" id="editPackagePrice" name="packagePrice" placeholder="e.g. 25" min="1" 
                                class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-400 focus:border-transparent">
                            @error('packagePrice')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="editPackageDelivery" class="block text-sm font-medium text-gray-700 mb-1">Delivery Time (days)</label>
                            <input type="number" id="editPackageDelivery" name="packageDelivery" placeholder="e.g. 3" min="1" 
                                class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-400 focus:border-transparent">
                            @error('packageDelivery')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    {{-- <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <label for="editPackageRevisions" class="block text-sm font-medium text-gray-700 mb-1">Revisions</label>
                            <input type="number" id="editPackageRevisions" name="packageRevisions" placeholder="e.g. 2" min="0" 
                                class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-400 focus:border-transparent">
                            @error('packageRevisions')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="editPackageType" class="block text-sm font-medium text-gray-700 mb-1">Package Type</label>
                            <select id="editPackageType" name="packageType"
                                class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-400 focus:border-transparent">
                                <option value="basic">Basic</option>
                                <option value="standard">Standard</option>
                                <option value="premium">Premium</option>
                            </select>
                            @error('packageType')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                     
                    </div> --}}
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="toggleEditPackageForm()" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-md text-gray-700 transition">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 primary-gradient text-white rounded-md hover:opacity-90 transition">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Add Feature Form (Hidden by default) -->
        <div id="addFeatureForm" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Add Feature to <span id="featurePackageName">Package</span></h3>
                    <button onclick="toggleAddFeatureForm()" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form id="addFeatureFormContent"  method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="featureDescription" class="block text-sm font-medium text-gray-700 mb-1">Feature Description</label>
                        <input type="text" id="featureDescription" name="featureDescription" placeholder="e.g. Logo in PNG format" 
                            class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-400 focus:border-transparent">
                        @error('featureDescription')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <div class="flex items-center">
                            <input type="checkbox" id="featureIncluded" name="featureIncluded" class="h-4 w-4 text-purple-600" value="1">
                            <label for="featureIncluded" class="ml-2 block text-sm text-gray-700">Feature is included in this package</label>
                        </div>
                        @error('featureIncluded')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="toggleAddFeatureForm()" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-md text-gray-700 transition">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 primary-gradient text-white rounded-md hover:opacity-90 transition">
                            Add Feature
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Image upload functionality
        document.querySelector('.border-dashed')?.addEventListener('click', function() {
            document.getElementById('imageUpload').click();
        });

        // Toggle Add Package Form
        function toggleAddPackageForm() {
            const form = document.getElementById('addPackageForm');
            form.classList.toggle('hidden');
        }

        // Toggle Edit Package Form
        function toggleEditPackageForm(packageId = null, packageName = null, packageDescription = null, packagePrice = null, packageDelivery = null) {
            const form = document.getElementById('editPackageForm');
            const formContent = document.getElementById('editPackageFormContent');
            form.classList.toggle('hidden');

            if (packageId) {
                formContent.action = `/freelancer/services/{{ $service->id }}/packages/${packageId}`;
                document.getElementById('editPackageId').value = packageId;
                document.getElementById('editPackageName').value = packageName;
                document.getElementById('editPackageDescription').value = packageDescription || '';
                // document.getElementById('editPackageType').value = packageType;
                document.getElementById('editPackagePrice').value = packagePrice;
                document.getElementById('editPackageDelivery').value = packageDelivery;
            }
        }  
        // Toggle Add Feature Form
        function toggleAddFeatureForm( packageId = null) {
            
            const form = document.getElementById('addFeatureForm');
            const formContent = document.getElementById('addFeatureFormContent');
            form.classList.toggle('hidden');

            if ( packageId) {
                formContent.action = `/freelancer/services/{{ $service->id }}/packages/${packageId}/features`;
                console.log(' action is:', formContent.action);
            }
        }

        function confirmDeleteImage(imageId) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'This image will be deleted permanently!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-image-form-${imageId}`).submit();
                }
            });
        }

        function confirmDeleteFeature(featureId) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'This feature will be deleted permanently!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-feature-form-${featureId}`).submit();
                }
            });
        }

        function confirmDeletePackage(packageId) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'This package will be deleted permanently!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-package-form-${packageId}`).submit();
                }
            });
        }
    </script>
@endsection