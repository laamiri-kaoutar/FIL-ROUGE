@extends('layouts.app')

@section('title', 'Complete Your Payment - FreelanceHub')

@section('content')
    <main class="flex-grow container mx-auto px-4 py-8">
        <!-- Main payment container -->
        <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Payment form section -->
            <div id="payment-form-container">
                <div class="p-6 border-b border-gray-200">
                    <h1 class="text-2xl font-semibold text-gray-800">Complete Your Payment</h1>
                    <p class="text-sm text-gray-600 mt-1">Pay for {{ $service->title }} - {{ $package->name }}</p>
                </div>

                <!-- Order Summary -->
                <div class="p-6 bg-gray-50 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-700 mb-4">Order Summary</h2>
                    <div class="bg-white p-4 rounded-lg border border-gray-200">
                        <div class="flex justify-between mb-3">
                            <span class="font-medium text-gray-700">Service:</span>
                            <span class="text-gray-600">{{ $service->title }}</span>
                        </div>
                        <div class="flex justify-between mb-3">
                            <span class="font-medium text-gray-700">Package:</span>
                            <span class="text-gray-600">{{ $package->name }} ({{ ucfirst($package->package_type) }})</span>
                        </div>
                        @if($package->description)
                            <div class="flex justify-between mb-3">
                                <span class="font-medium text-gray-700">Description:</span>
                                <span class="text-gray-600">{{ $package->description }}</span>
                            </div>
                        @endif
                        @if(isset($package->revisions))
                            <div class="flex justify-between mb-3">
                                <span class="font-medium text-gray-700">Revisions:</span>
                                <span class="text-gray-600">{{ $package->revisions }} Revisions</span>
                            </div>
                        @endif
                        <div class="flex justify-between mb-3">
                            <span class="font-medium text-gray-700">Delivery Time:</span>
                            <span class="text-gray-600">{{ $package->delivery_time }} Days</span>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-200 flex justify-between">
                            <span class="text-lg font-semibold text-gray-800">Total Amount:</span>
                            <span class="text-lg font-semibold primary-gradient text-transparent bg-clip-text">${{ number_format($package->price, 2) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Payment Details form -->
                <div class="p-6">
                    <h2 class="text-lg font-medium text-gray-700 mb-4">Payment Details</h2>
                    <form id="payment-form" action="{{ route('client.process_payment') }}" method="POST">
                        @csrf
                        <!-- Hidden fields -->
                        <input type="hidden" id="stripeToken" name="stripeToken">
                        <input type="hidden" name="service_id" value="{{ $service->id }}">
                        <input type="hidden" name="package_id" value="{{ $package->id }}">

                        <div class="mb-5">
                            <label for="card-name" class="block text-sm font-medium text-gray-700 mb-1">Name on Card</label>
                            <input type="text" id="card-name" name="cardName" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors" placeholder="John Doe" required>
                            @error('cardName')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Stripe Elements -->
                        <div class="mb-5">
                            <label for="card-element" class="block text-sm font-medium text-gray-700 mb-1">Card Details</label>
                            <div id="card-element" class="p-4 border border-gray-300 rounded-md bg-white"></div>
                            <div id="card-errors" class="text-red-500 text-sm mt-2" role="alert"></div>
                        </div>

                        <button type="submit" id="payment-button" class="w-full primary-gradient text-white py-3 px-4 rounded-md font-medium hover:opacity-90 transition-opacity focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 disabled:opacity-50 disabled:cursor-not-allowed">
                            Pay ${{ number_format($package->price, 2) }}
                        </button>
                    </form>
                </div>

                <div class="p-6 border-t border-gray-200 text-center">
                    <a href="{{ route('client.orders') }}" class="text-purple-600 hover:text-purple-700 hover:underline transition-colors">Return to Dashboard</a>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{ asset('js/payment.js') }}"></script>
@endsection