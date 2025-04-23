@extends('layouts.admin')

@section('title', 'Account Validation - FreelanceHub Admin')
@section('page-title', 'Account Validation')
@section('search-placeholder', 'Search users...')

@section('content')
    <div class="bg-white rounded-xl shadow-md p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-6">Manage Users</h2>

        <!-- User Statistics -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <p class="text-sm text-gray-600">Total Users</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $totalUsers }}</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <p class="text-sm text-gray-600">Total Freelancers</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $totalFreelancers }}</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <p class="text-sm text-gray-600">Total Clients</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $totalClients }}</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <p class="text-sm text-gray-600">Banned Users</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $bannedUsers }}</p>
            </div>
        </div>

        <!-- Filter and Search -->
        <form method="GET" action="{{ route('admin.users') }}" class="flex flex-col sm:flex-row gap-4 mb-6">
            <select name="status" class="border border-gray-300 rounded-lg p-2 w-full sm:w-48 focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                <option value="All Statuses" {{ request('status', 'All Statuses') === 'All Statuses' ? 'selected' : '' }}>All Statuses</option>
                <option value="Active" {{ request('status') === 'Active' ? 'selected' : '' }}>Active</option>
                <option value="Suspended" {{ request('status') === 'Suspended' ? 'selected' : '' }}>Suspended</option>
                <option value="Banned" {{ request('status') === 'Banned' ? 'selected' : '' }}>Banned</option>
            </select>
        </form>

        <!-- User Table -->
        <div class="overflow-x-auto">
            @if ($users->isNotEmpty())
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="py-3 px-4 text-sm font-semibold text-gray-700">Name</th>
                            <th class="py-3 px-4 text-sm font-semibold text-gray-700">Email</th>
                            <th class="py-3 px-4 text-sm font-semibold text-gray-700">Role</th>
                            <th class="py-3 px-4 text-sm font-semibold text-gray-700">Status</th>
                            <th class="py-3 px-4 text-sm font-medium text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="py-4 px-4 text-gray-700">{{ $user->name }}</td>
                                <td class="py-4 px-4 text-gray-700">{{ $user->email }}</td>
                                <td class="py-4 px-4 text-gray-700">{{ $user->role->name }}</td>
                                <td class="py-4 px-4">
                                    @if ($user->status === 'Active')
                                        <span class="inline-block px-2 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full">Active</span>
                                    @elseif ($user->status === 'Suspended')
                                        <span class="inline-block px-2 py-1 text-xs font-medium text-yellow-800 bg-yellow-100 rounded-full">Suspended</span>
                                    @elseif ($user->status === 'Banned')
                                        <span class="inline-block px-2 py-1 text-xs font-medium text-red-800 bg-red-100 rounded-full">Banned</span>
                                    @endif
                                </td>
                                <td class="py-4 px-4 flex gap-2">
                                    @if ($user->status === 'Active')
                                        <form id="suspend-user-form-{{ $user->id }}" action="{{ route('admin.users.suspend', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="button" onclick="confirmAction('Are you sure you want to suspend this user?', 'suspend-user-form-{{ $user->id }}')" class="px-3 py-1 text-sm text-yellow-600 bg-yellow-100 rounded-lg hover:bg-yellow-200">Suspend</button>
                                        </form>
                                        <form id="ban-user-form-{{ $user->id }}" action="{{ route('admin.users.ban', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="button" onclick="confirmAction('Are you sure you want to ban this user?', 'ban-user-form-{{ $user->id }}')" class="px-3 py-1 text-sm text-red-600 bg-red-100 rounded-lg hover:bg-red-200">Ban</button>
                                        </form>
                                    @elseif ($user->status === 'Suspended')
                                        <form id="unban-user-form-{{ $user->id }}" action="{{ route('admin.users.unban', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="button" onclick="confirmAction('Are you sure you want to unban this user?', 'unban-user-form-{{ $user->id }}')" class="px-3 py-1 text-sm text-green-600 bg-green-100 rounded-lg hover:bg-green-200">Unban</button>
                                        </form>
                                        <form id="ban-user-form-{{ $user->id }}" action="{{ route('admin.users.ban', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="button" onclick="confirmAction('Are you sure you want to ban this user?', 'ban-user-form-{{ $user->id }}')" class="px-3 py-1 text-sm text-red-600 bg-red-100 rounded-lg hover:bg-red-200">Ban</button>
                                        </form>
                                    @elseif ($user->status === 'Banned')
                                        <form id="unban-user-form-{{ $user->id }}" action="{{ route('admin.users.unban', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="button" onclick="confirmAction('Are you sure you want to unban this user?', 'unban-user-form-{{ $user->id }}')" class="px-3 py-1 text-sm text-green-600 bg-green-100 rounded-lg hover:bg-green-200">Unban</button>
                                        </form>
                                    @endif
                                    <form id="delete-user-form-{{ $user->id }}" action="{{ route('admin.users.delete', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmAction('Are you sure you want to delete this user?', 'delete-user-form-{{ $user->id }}')" class="px-3 py-1 text-sm text-red-600 bg-red-100 rounded-lg hover:bg-red-200">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="text-center py-8">
                    <p class="text-gray-600">No users found.</p>
                </div>
            @endif
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $users->appends(request()->query())->links('pagination::tailwind') }}
        </div>
    </div>

    @section('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const successMessage = document.getElementById('success-message');
                const errorMessage = document.getElementById('error-message');

                if (successMessage) {
                    setTimeout(() => {
                        successMessage.style.display = 'none';
                    }, 3000);
                }

                if (errorMessage) {
                    setTimeout(() => {
                        errorMessage.style.display = 'none';
                    }, 3000);
                }

                const searchInput = document.getElementById('searchInput');
                searchInput.addEventListener('keypress', function (e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        var searchTerm = this.value.trim();
                        if (searchTerm) {
                            window.location.href = '/admin/users?search=' + encodeURIComponent(searchTerm);
                        }
                    }
                });
            });

            // Reusable SweetAlert confirmation function
            function confirmAction(message, formId) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: message,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, proceed!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(formId).submit();
                    }
                });
            }
        </script>
    @endsection
@endsection