<!-- resources/views/freelancer/service-edit.blade.php -->
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

        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4">Service Details</h2>
            <form id="serviceDetailsForm">
                <div class="mb-4">
                    <label for="serviceTitle" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                    <input type="text" id="serviceTitle" name="serviceTitle" value="Logo Design Service" 
                        class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-400 focus:border-transparent">
                </div>
                <div class="mb-4">
                    <label for="serviceDescription" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea id="serviceDescription" name="serviceDescription" rows="4"
                        class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-400 focus:border-transparent">I will design a modern and professional logo for your business or brand. My designs are unique, creative, and tailored to your specific needs.</textarea>
                </div>
                <div class="mb-6">
                    <label for="serviceStatus" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select id="serviceStatus" name="serviceStatus"
                        class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-400 focus:border-transparent">
                        <option value="Active" selected>Active</option>
                        <option value="Inactive">Inactive</option>
                        <option value="Draft">Draft</option>
                    </select>
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

        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4">Service Images</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-6">
                <div class="relative group">
                    <img src="https://via.placeholder.com/300x200" alt="Service Image" class="w-full h-40 object-cover rounded-md">
                    <button class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="relative group">
                    <img src="https://via.placeholder.com/300x200" alt="Service Image" class="w-full h-40 object-cover rounded-md">
                    <button class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="border-2 border-dashed border-gray-300 rounded-md flex flex-col items-center justify-center h-40 cursor-pointer hover:border-purple-400 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span class="text-sm font-medium text-gray-500 mt-2">Add Image</span>
                    <input type="file" accept="image/*" class="hidden" id="imageUpload">
                </div>
            </div>
            <div class="text-sm text-gray-500">
                <p>* You can upload up to 5 images for your service.</p>
                <p>* Recommended image size: 1200 x 800 pixels.</p>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">Service Packages</h2>
                <button id="btnAddPackage" class="flex items-center text-purple-600 hover:text-purple-800 transition" onclick="toggleAddPackageForm()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Package
                </button>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="border border-gray-200 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition" data-package-id="1">
                    <div class="bg-gray-50 p-4 border-b border-gray-200">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="font-semibold text-gray-800">Basic</h3>
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Basic</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-2">Simple logo design with 2 revisions</p>
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-bold text-gray-900">$25</span>
                            <span class="text-sm text-gray-500">2 days delivery</span>
                        </div>
                    </div>
                    
                    <div class="p-4">
                        <h4 class="text-sm font-medium text-gray-700 mb-2">Features</h4>
                        <ul class="space-y-2 mb-4">
                            <li class="flex items-center justify-between text-sm">
                                <span>Logo in JPG format</span>
                                <button class="text-red-600 hover:text-red-800" onclick="showDeleteFeatureModal('1')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </li>
                            <li class="flex items-center justify-between text-sm">
                                <span>Source File</span>
                                <button class="text-red-600 hover:text-red-800 delete-feature-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </li>
                            <li class="flex items-center justify-between text-sm">
                                <span>Commercial Use</span>
                                <button class="text-red-600 hover:text-red-800 delete-feature-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </li>
                        </ul>
                        
                        <div class="flex justify-between">
                            <button class="text-purple-600 hover:text-purple-800 text-sm font-medium" onclick="toggleAddFeatureForm('Basic')">
                                + Add Feature
                            </button>
                            <div class="space-x-2">
                                <button class="text-blue-600 hover:text-blue-800 text-sm font-medium" onclick="toggleEditPackageForm('1', 'Basic')">
                                    Edit
                                </button>
                                <button class="text-red-600 hover:text-red-800 text-sm font-medium">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete confirmation popup -->
        <div id="deleteFeatureModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-sm p-6">
                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Confirm Delete</h3>
                    <p class="text-sm text-gray-600 mt-2">Are you sure you want to delete this feature?</p>
                </div>
                <form id="deleteFeatureForm">
                    <input type="hidden" id="featureIdToDelete" name="featureId">
                    <div class="flex justify-end gap-3">
                        <button type="button" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-md text-gray-700 transition" onclick="hideDeleteFeatureModal()">
                            No
                        </button>
                        <button type="button" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md transition" onclick="confirmFeatureDelete()">
                            Yes
                        </button>
                    </div>
                </form>
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
                <form>
                    <div class="mb-4">
                        <label for="packageName" class="block text-sm font-medium text-gray-700 mb-1">Package Name</label>
                        <input type="text" id="packageName" name="packageName" placeholder="e.g. Basic, Standard, Premium" 
                            class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-400 focus:border-transparent">
                    </div>
                    <div class="mb-4">
                        <label for="packageDescription" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea id="packageDescription" name="packageDescription" rows="2" placeholder="Brief description of the package"
                            class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-400 focus:border-transparent"></textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="packageType" class="block text-sm font-medium text-gray-700 mb-1">Package Type</label>
                            <select id="packageType" name="packageType"
                                class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-400 focus:border-transparent">
                                <option value="Basic">Basic</option>
                                <option value="Standard">Standard</option>
                                <option value="Premium">Premium</option>
                            </select>
                        </div>
                        <div>
                            <label for="packagePrice" class="block text-sm font-medium text-gray-700 mb-1">Price ($)</label>
                            <input type="number" id="packagePrice" name="packagePrice" placeholder="e.g. 25" min="1" 
                                class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-400 focus:border-transparent">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <label for="packageRevisions" class="block text-sm font-medium text-gray-700 mb-1">Revisions</label>
                            <input type="number" id="packageRevisions" name="packageRevisions" placeholder="e.g. 2" min="0" 
                                class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-400 focus:border-transparent">
                        </div>
                        <div>
                            <label for="packageDelivery" class="block text-sm font-medium text-gray-700 mb-1">Delivery Time (days)</label>
                            <input type="number" id="packageDelivery" name="packageDelivery" placeholder="e.g. 3" min="1" 
                                class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-400 focus:border-transparent">
                        </div>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="toggleAddPackageForm()" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-md text-gray-700 transition">
                            Cancel
                        </button>
                        <button type="button" class="px-4 py-2 primary-gradient text-white rounded-md hover:opacity-90 transition">
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
                <form>
                    <input type="hidden" id="editPackageId" name="packageId">
                    <div class="mb-4">
                        <label for="editPackageName" class="block text-sm font-medium text-gray-700 mb-1">Package Name</label>
                        <input type="text" id="editPackageName" name="packageName" placeholder="e.g. Basic, Standard, Premium" 
                            class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-400 focus:border-transparent">
                    </div>
                    <div class="mb-4">
                        <label for="editPackageDescription" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea id="editPackageDescription" name="packageDescription" rows="2" placeholder="Brief description of the package"
                            class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-400 focus:border-transparent"></textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="editPackageType" class="block text-sm font-medium text-gray-700 mb-1">Package Type</label>
                            <select id="editPackageType" name="packageType"
                                class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-400 focus:border-transparent">
                                <option value="Basic">Basic</option>
                                <option value="Standard">Standard</option>
                                <option value="Premium">Premium</option>
                            </select>
                        </div>
                        <div>
                            <label for="editPackagePrice" class="block text-sm font-medium text-gray-700 mb-1">Price ($)</label>
                            <input type="number" id="editPackagePrice" name="packagePrice" placeholder="e.g. 25" min="1" 
                                class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-400 focus:border-transparent">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <label for="editPackageRevisions" class="block text-sm font-medium text-gray-700 mb-1">Revisions</label>
                            <input type="number" id="editPackageRevisions" name="packageRevisions" placeholder="e.g. 2" min="0" 
                                class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-400 focus:border-transparent">
                        </div>
                        <div>
                            <label for="editPackageDelivery" class="block text-sm font-medium text-gray-700 mb-1">Delivery Time (days)</label>
                            <input type="number" id="editPackageDelivery" name="packageDelivery" placeholder="e.g. 3" min="1" 
                                class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-400 focus:border-transparent">
                        </div>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="toggleEditPackageForm()" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-md text-gray-700 transition">
                            Cancel
                        </button>
                        <button type="button" class="px-4 py-2 primary-gradient text-white rounded-md hover:opacity-90 transition">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>

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
                <form>
                    <div class="mb-4">
                        <label for="featureDescription" class="block text-sm font-medium text-gray-700 mb-1">Feature Description</label>
                        <input type="text" id="featureDescription" name="featureDescription" placeholder="e.g. Logo in PNG format" 
                            class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-400 focus:border-transparent">
                    </div>
                    <div class="mb-6">
                        <div class="flex items-center">
                            <input type="checkbox" id="featureIncluded" name="featureIncluded" class="h-4 w-4 text-purple-600">
                            <label for="featureIncluded" class="ml-2 block text-sm text-gray-700">Feature is included in this package</label>
                        </div>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="toggleAddFeatureForm()" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-md text-gray-700 transition">
                            Cancel
                        </button>
                        <button type="button" class="px-4 py-2 primary-gradient text-white rounded-md hover:opacity-90 transition">
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
        document.querySelector('.border-dashed').addEventListener('click', function() {
            document.getElementById('imageUpload').click();
        });
        
        document.getElementById('imageUpload').addEventListener('change', function(e) {
            console.log('File selected:', e.target.files[0].name);
        });
        
        // Toggle Add Package Form
        function toggleAddPackageForm() {
            const form = document.getElementById('addPackageForm');
            form.classList.toggle('hidden');
        }
        
        // Toggle Edit Package Form
        function toggleEditPackageForm(packageId = null, packageName = null) {
            const form = document.getElementById('editPackageForm');
            form.classList.toggle('hidden');
            
            if (packageId && packageName) {
                document.getElementById('editPackageId').value = packageId;
                document.getElementById('editPackageName').value = packageName;
                // In a real implementation, you'd populate other fields with existing package data
            }
        }
        
        // Toggle Add Feature Form
        function toggleAddFeatureForm(packageName = null) {
            const form = document.getElementById('addFeatureForm');
            form.classList.toggle('hidden');
            
            if (packageName) {
                const formattedName = packageName.charAt(0).toUpperCase() + packageName.slice(1);
                document.getElementById('featurePackageName').textContent = formattedName;
            }
        }

        function showDeleteFeatureModal(featureId) {
            const modal = document.getElementById('deleteFeatureModal');
            const featureIdInput = document.getElementById('featureIdToDelete');
            
            featureIdInput.value = featureId;
            modal.classList.remove('hidden');
        }

        function hideDeleteFeatureModal() {
            const modal = document.getElementById('deleteFeatureModal');
            modal.classList.add('hidden');
        }

        function confirmFeatureDelete() {
            const featureId = document.getElementById('featureIdToDelete').value;
            
            // This is where you'd put your backend call
            console.log(`Sending delete request for feature ID: ${featureId}`);
            
            // Close the modal after confirming
            hideDeleteFeatureModal();
            
            // Example of how you might remove the feature after backend confirmation:
            // const featureElement = document.querySelector(`button[onclick="showDeleteFeatureModal('${featureId}')"]`).closest('li');
            // featureElement.remove();
        }
    </script>
@endsection