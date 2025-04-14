@extends('layouts.admin')

@section('title', 'Categories Management - FreelanceHub Admin')
@section('page-title', 'Categories Management')
@section('search-placeholder', 'Search categories...')

@section('content')
    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-semibold text-gray-800">Manage Categories</h2>
            <button id="openFormBtn" class="px-4 py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-lg hover:from-purple-700 hover:to-pink-700">Add Category</button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="py-3 px-4 text-sm font-semibold text-gray-700">Name</th>
                        <th class="py-3 px-4 text-sm font-semibold text-gray-700">Description</th>
                        <th class="py-3 px-4 text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                        <td class="py-4 px-4 text-gray-700">{{ $category->name }}</td>
                        <td class="py-4 px-4 text-gray-700">{{ $category->description }}</td>
                        <td class="py-4 px-4 flex gap-2">
                            <button class="editBtn px-3 py-1 text-sm text-blue-600 bg-blue-100 rounded-lg hover:bg-blue-200" 
                                    data-id="{{ $category->id }}">
                                Edit
                            </button>
                            <form id="delete-form-{{ $category->id }}" action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmDelete({{ $category->id }})" class="px-3 py-1 text-sm text-red-600 bg-red-100 rounded-lg hover:bg-red-200">
                                    Delete
                                </button>
                            </form>
                            
                        </td>
                    </tr>
                    @endforeach

              
                </tbody>
            </table>
        </div>
        <div class="mt-6 flex justify-center gap-3">
            <button class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100">Previous</button>
            <button class="px-4 py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-lg">1</button>
            <button class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100">2</button>
            <button class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100">Next</button>
        </div>
    </div>

    <!-- Add Category Popup -->
    <div id="categoryFormPopup" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-xl p-6 w-full max-w-md">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Add New Category</h3>
    
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
    
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Category Name</label>
                    <input type="text" name="name" id="name"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                        placeholder="Enter category name" required>
                </div>
    
                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" id="description"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                        rows="4" placeholder="Enter category description" required></textarea>
                </div>
    
                <div class="flex justify-end gap-3">
                    <button type="button" id="closeFormBtn"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">Cancel</button>
                    <button type="submit"
                        class="px-4 py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-lg hover:from-purple-700 hover:to-pink-700">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
    

    <!-- Edit Category Popup -->
    <div id="editCategoryPopup" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-xl p-6 w-full max-w-md">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Edit Category</h3>
            <form id="edit-category-form" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="category_id" id="editCategoryId">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Category Name</label>
                    <input type="text" id="editCategoryName" name="name" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-purple-500 focus:border-purple-500" required>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea id="editCategoryDescription" name="description" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-purple-500 focus:border-purple-500" rows="4" required></textarea>
                </div>
                <div class="flex justify-end gap-3">
                    <button type="button" id="closeEditBtn" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-lg hover:from-purple-700 hover:to-pink-700">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const openFormBtn = document.getElementById('openFormBtn');
        const closeFormBtn = document.getElementById('closeFormBtn');
        const categoryFormPopup = document.getElementById('categoryFormPopup');
        const editButtons = document.querySelectorAll('.editBtn');
        const closeEditBtn = document.getElementById('closeEditBtn');
        const editCategoryPopup = document.getElementById('editCategoryPopup');
        const editForm = document.getElementById('edit-category-form');


        openFormBtn.addEventListener('click', () => categoryFormPopup.classList.remove('hidden'));
        closeFormBtn.addEventListener('click', () => categoryFormPopup.classList.add('hidden'));
        categoryFormPopup.addEventListener('click', (e) => { if (e.target === categoryFormPopup) categoryFormPopup.classList.add('hidden'); });

        editButtons.forEach(button => {
            button.addEventListener('click', () => {
                const categoryId = button.getAttribute('data-id');
                fetchCategoryData(categoryId);

                const updateUrl = `/categories/${categoryId}`;
                console.log(updateUrl);
                
                editForm.setAttribute('action', updateUrl);

                editCategoryPopup.classList.remove('hidden');
            });
        });

        closeEditBtn.addEventListener('click', () => editCategoryPopup.classList.add('hidden'));
        editCategoryPopup.addEventListener('click', (e) => { if (e.target === editCategoryPopup) editCategoryPopup.classList.add('hidden'); });

        function fetchCategoryData(categoryId) {
            fetch(`categories/${categoryId}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('editCategoryId').value = categoryId;
                    document.getElementById('editCategoryName').value = data.name || '';
                    document.getElementById('editCategoryDescription').value = data.description || '';
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('editCategoryId').value = categoryId;
                    document.getElementById('editCategoryName').value = 'Sample Name';
                    document.getElementById('editCategoryDescription').value = 'Sample Description';
                });
        }

        function confirmDelete(id) {
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
                    document.getElementById(`delete-form-${id}`).submit();
                }
            });
        }

    </script>
@endsection