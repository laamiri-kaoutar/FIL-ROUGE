@extends('layouts.app')

@section('title', 'Order Confirmation - FreelanceHub')

@section('content')
    <main class="flex-grow container mx-auto px-4 py-8">
        <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <h1 class="text-2xl font-semibold text-gray-800">Order Confirmation</h1>
            </div>

            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-700 mb-4">Thank You for Your Order!</h2>
                <p class="text-gray-600 mb-4">Your payment was successful. Here are the details of your order:</p>
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <div class="flex justify-between mb-2">
                        <span class="font-medium">Order ID:</span>
                        <span>{{ $order->id }}</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span class="font-medium">Service:</span>
                        <span>{{ $order->service->title }}</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span class="font-medium">Package:</span>
                        <span>{{ $order->package->name }}</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span class="font-medium">Freelancer:</span>
                        <span>{{ $order->service->user->name }}</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span class="font-medium">Amount:</span>
                        <span>${{ number_format($order->amount, 2) }}</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span class="font-medium">Status:</span>
                        <span class="capitalize">{{ $order->status }}</span>
                    </div>
                </div>
            </div>

            <div class="p-6 border-t border-gray-200 text-center">
                <a href="{{ route('client.services.show', $order->service->id) }}" class="text-purple-600 hover:underline">Return to Service</a>
            </div>
        </div>
    </main>
@endsection