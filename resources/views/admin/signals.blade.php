@extends('layouts.admin')

@section('title', 'Signals - Admin Panel')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Page Header -->
        <div class="mb-8 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-900">Reported Reviews</h1>
        </div>

        <!-- Success/Error Messages -->
        @if (session('success'))
            <div id="success-message" class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div id="error-message" class="mb-6 p-4 bg-red-100 text-red-800 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        <!-- Signals Table -->
        @if ($signals->isNotEmpty())
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Review Comment</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reported By</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reason</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reported At</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($signals as $signal)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <p class="text-sm text-gray-900">
                                        {{ Str::limit($signal->review->comment ?? 'No comment', 50) }}
                                    </p>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <p class="text-sm text-gray-900">
                                        {{ $signal->review->service->title ?? 'N/A' }}
                                    </p>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <p class="text-sm text-gray-900">
                                        {{ $signal->user->name }}
                                    </p>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm text-gray-600">
                                        {{ $signal->reason }}
                                    </p>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <p class="text-sm text-gray-500">
                                        {{ $signal->created_at->format('M d, Y H:i') }}
                                    </p>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex gap-2">
                                        <form action="{{ route('admin.signals.dismiss', $signal->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to dismiss this signal?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-gray-600 hover:text-gray-800">Dismiss</button>
                                        </form>
                                        <form action="{{ route('admin.signals.deleteReview', $signal->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this review? This will remove all associated signals.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800">Delete Review</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-lg shadow-md p-8 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">No Signals Yet</h3>
                <p class="text-gray-600">No reviews have been reported yet.</p>
            </div>
        @endif
    </div>

    @section('scripts')
        <script>
            // Auto-hide success/error messages after 5 seconds
            document.addEventListener('DOMContentLoaded', function () {
                const successMessage = document.getElementById('success-message');
                const errorMessage = document.getElementById('error-message');

                if (successMessage) {
                    setTimeout(() => {
                        successMessage.style.display = 'none';
                    }, 5000);
                }

                if (errorMessage) {
                    setTimeout(() => {
                        errorMessage.style.display = 'none';
                    }, 5000);
                }
            });
        </script>
    @endsection
@endsection