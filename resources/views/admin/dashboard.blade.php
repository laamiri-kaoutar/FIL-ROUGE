@extends('layouts.admin')

@section('title', 'Admin Dashboard - FreelanceHub')
@section('page-title', 'Dashboard')
@section('search-placeholder', 'Search...')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Services by Category -->
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Services by Category</h2>
            <div class="h-80">
                <canvas id="servicesByCategoryChart"></canvas>
            </div>
        </div>

        <!-- Service Status Distribution -->
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Service Status Distribution</h2>
            <div class="h-80">
                <canvas id="serviceStatusChart"></canvas>
            </div>
        </div>

        <!-- User Distribution -->
        <div class="bg-white p-6 rounded-xl shadow-md lg:col-span-2">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">User Distribution</h2>
            <div class="h-80">
                <canvas id="userDistributionChart"></canvas>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
@endsection