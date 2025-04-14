@extends('layouts.admin')

@section('title', 'Tags Management - FreelanceHub Admin')
@section('page-title', 'Tags Management')
@section('search-placeholder', 'Search categories...')

@section('content')
    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-semibold text-gray-800">Manage Tags</h2>
            <button id="openFormBtn" class="px-4 py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-lg hover:from-purple-700 hover:to-pink-700">Add Tag</button>
        </div>

        <!-- Tags Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="py-3 px-4 text-sm font-semibold text-gray-700">Name</th>
                        <th class="py-3 px-4 text-sm font-semibold text-gray-700">Color</th>
                        <th class="py-3 px-4 text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tags as $tag)
                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                        <td class="py-4 px-4 text-gray-700">{{ $tag->tag_title }}</td>
                        <td class="py-4 px-4">
                            <span class="inline-block px-3 py-1 rounded-full text-white" style="background-color: {{ $tag->tag_color }};">
                                {{ $tag->tag_color }}
                            </span>
                        </td>
                        <td class="py-4 px-4 flex gap-2">
                            <button class="editBtn px-3 py-1 text-sm text-blue-600 bg-blue-100 rounded-lg hover:bg-blue-200"
                                    data-id="{{ $tag->tag_id }}">
                                Edit
                            </button>
                            <form id="delete-form-{{ $tag->tag_id }}" action="{{ route('tags.destroy', $tag->tag_id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmDelete({{ $tag->tag_id }})" class="px-3 py-1 text-sm text-red-600 bg-red-100 rounded-lg hover:bg-red-200">
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

    <div id="tagFormPopup" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-xl p-6 w-full max-w-md">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Add New Tag</h3>
    
            <form action="{{ route('tags.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tag Name</label>
                    <input type="text" name="tag_title" class="w-full border border-gray-300 rounded-lg p-2" required>
                </div>
    
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tag Color</label>
                    <input type="color" name="tag_color" class="w-full border border-gray-300 rounded-lg p-2" required>
                </div>
    
                <div class="flex justify-end gap-3">
                    <button type="button" id="closeFormBtn"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">Cancel</button>
                    <button type="submit"
                        class="px-4 py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-lg hover:from-purple-700 hover:to-pink-700">Save</button>
                </div>
            </form>
        </div>
    </div>

    <div id="editTagPopup" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-xl p-6 w-full max-w-md">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Edit Tag</h3>
    
            <form id="edit-tag-form" method="POST">
                @csrf
                @method('PUT')
    
                <input type="hidden" name="tag_id" id="editTagId">
    
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tag Name</label>
                    <input type="text" name="tag_title" id="editTagTitle" class="w-full border border-gray-300 rounded-lg p-2" required>
                </div>
    
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tag Color</label>
                    <input type="color" name="tag_color" id="editTagColor" class="w-full border border-gray-300 rounded-lg p-2" required>
                </div>
    
                <div class="flex justify-end gap-3">
                    <button type="button" id="closeEditBtn"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">Cancel</button>
                    <button type="submit"
                        class="px-4 py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-lg hover:from-purple-700 hover:to-pink-700">Update</button>
                </div>
            </form>
        </div>
    </div>
     
@endsection


@section('scripts')
    <script>
        const openFormBtn = document.getElementById('openFormBtn');
        const closeFormBtn = document.getElementById('closeFormBtn');
        const tagFormPopup = document.getElementById('tagFormPopup');

        openFormBtn.addEventListener('click', () => {
            tagFormPopup.classList.remove('hidden');
        });

        closeFormBtn.addEventListener('click', () => {
            tagFormPopup.classList.add('hidden');
        });

        tagFormPopup.addEventListener('click', (e) => {
            if (e.target === tagFormPopup) {
                tagFormPopup.classList.add('hidden');
            }
        });
    </script>
@endsection