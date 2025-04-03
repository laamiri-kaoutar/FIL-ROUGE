<!-- resources/views/freelancer/profile.blade.php -->
@extends('layouts.app')

@section('title', 'Freelancer Profile - FreelanceHub')

@section('content')
    <main class="max-w-4xl mx-auto px-4 py-12 sm:px-6 lg:px-8">
        <div class="mb-12 text-center">
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 tracking-tight">Freelancer Profile</h1>
            <p class="mt-2 text-lg text-gray-600">Manage your personal details and services</p>
        </div>

        <!-- Profile Card -->
        <div class="bg-white rounded-xl shadow-lg gradient-border p-6 sm:p-8 mb-6 sm:mb-8">
            <div class="flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-6 mb-6 sm:mb-8">
                <img id="profileImagePreview" src="https://via.placeholder.com/100" alt="Profile Image" class="w-24 h-24 sm:w-28 sm:h-28 rounded-full object-cover border-4 border-gray-100 shadow-sm">
                <div class="text-center sm:text-left">
                    <h2 id="profileName" class="text-xl sm:text-2xl font-bold text-gray-900">John Doe</h2>
                    <p id="profileEmail" class="text-gray-600 text-base sm:text-lg">john.doe@example.com</p>
                </div>
            </div>

            <!-- Profile Form -->
            <form id="profileForm" class="space-y-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Profile Image</label>
                        <input type="file" id="profileImage" name="profileImage" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                        <input type="text" id="firstName" name="firstName" value="John" class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 shadow-sm">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                        <input type="text" id="lastName" name="lastName" value="Doe" class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 shadow-sm">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" id="email" name="email" value="john.doe@example.com" class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 shadow-sm">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Biography</label>
                        <textarea id="biography" name="biography" rows="4" class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 shadow-sm">Experienced web developer with 5+ years in the field.</textarea>
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Rate ($/hour)</label>
                        <input type="number" id="rate" name="rate" value="50" step="0.01" class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 shadow-sm">
                    </div>
                </div>
                <div class="flex justify-end space-x-4 pt-4">
                    <button type="button" id="cancelBtn" class="px-4 sm:px-6 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors font-medium">Cancel</button>
                    <button type="submit" id="saveBtn" class="px-4 sm:px-6 py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-lg hover:from-purple-700 hover:to-pink-700 transition-colors font-medium disabled:opacity-50" disabled>Save Changes</button>
                </div>
            </form>
        </div>

        <!-- Change Password Button -->
        <div class="text-center mb-6 sm:mb-8">
            <button id="changePasswordBtn" class="px-6 sm:px-8 py-2 sm:py-3 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-lg hover:from-purple-700 hover:to-pink-700 transition-colors font-semibold shadow-md">Change Password</button>
        </div>

        <!-- Services Section -->
        <div class="bg-white rounded-xl shadow-lg p-6 sm:p-8">
            <h2 class="text-xl sm:text-2xl font-bold text-gray-900 mb-4 sm:mb-6">Your Services</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                <div class="bg-gray-50 rounded-lg p-3 sm:p-4 shadow-sm">
                    <h3 class="text-base sm:text-lg font-semibold text-gray-800">Web Development</h3>
                    <p class="text-gray-600 text-sm sm:text-base mt-1">Custom web solutions for all industries.</p>
                    <a href="{{ route('freelancer.service.edit', 1) }}" class="text-purple-600 hover:text-purple-800 font-medium mt-1 sm:mt-2 inline-block">Manage</a>
                </div>
                <div class="bg-gray-50 rounded-lg p-3 sm:p-4 shadow-sm">
                    <h3 class="text-base sm:text-lg font-semibold text-gray-800">UI/UX Design</h3>
                    <p class="text-gray-600 text-sm sm:text-base mt-1">Designing intuitive user experiences.</p>
                    <a href="{{ route('freelancer.service.edit', 2) }}" class="text-purple-600 hover:text-purple-800 font-medium mt-1 sm:mt-2 inline-block">Manage</a>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        // Store initial values
        const initialValues = {
            firstName: document.getElementById('firstName').value,
            lastName: document.getElementById('lastName').value,
            email: document.getElementById('email').value,
            biography: document.getElementById('biography').value,
            rate: document.getElementById('rate').value
        };
        const initialImage = document.getElementById('profileImagePreview').src;
        const saveBtn = document.getElementById('saveBtn');
        const cancelBtn = document.getElementById('cancelBtn');

        // Check for changes
        document.querySelectorAll('input, textarea').forEach(input => {
            input.addEventListener('input', () => {
                const changed = input.type === 'file' ? input.files.length > 0 :
                    input.value !== initialValues[input.id] ||
                    document.getElementById('profileImagePreview').src !== initialImage;
                saveBtn.disabled = !changed;
            });
        });

        // Cancel resets form
        cancelBtn.addEventListener('click', () => {
            document.getElementById('firstName').value = initialValues.firstName;
            document.getElementById('lastName').value = initialValues.lastName;
            document.getElementById('email').value = initialValues.email;
            document.getElementById('biography').value = initialValues.biography;
            document.getElementById('rate').value = initialValues.rate;
            document.getElementById('profileImagePreview').src = initialImage;
            document.getElementById('profileImage').value = '';
            saveBtn.disabled = true;
        });

        // Image preview
        document.getElementById('profileImage').addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    document.getElementById('profileImagePreview').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        // Password change
        document.getElementById('changePasswordBtn').addEventListener('click', () => {
            alert('Password change initiated—check your email for further instructions.');
        });

        // Form submission
        document.getElementById('profileForm').addEventListener('submit', (e) => {
            e.preventDefault();
            console.log('Form submitted with changes');
            saveBtn.disabled = true;
        });
    </script>
@endsection