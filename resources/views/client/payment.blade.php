<!-- resources/views/payment.blade.php -->
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
                </div>

                <!-- Order summary -->
                <div class="p-6 bg-gray-50 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-700 mb-4">Order Summary</h2>
                    <div class="bg-white p-4 rounded-lg border border-gray-200">
                        <div class="flex justify-between mb-2">
                            <span class="font-medium">Package:</span>
                            <span>Basic Package</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="font-medium">Pages:</span>
                            <span>5 Pages</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="font-medium">Delivery Time:</span>
                            <span>7 Days</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="font-medium">Revisions:</span>
                            <span>2 Revisions</span>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-200 flex justify-between">
                            <span class="text-lg font-semibold">Total Amount:</span>
                            <span class="text-lg font-semibold primary-gradient text-transparent bg-clip-text">$499.00</span>
                        </div>
                    </div>
                </div>

                <!-- Payment details form -->
                <div class="p-6">
                    <h2 class="text-lg font-medium text-gray-700 mb-4">Payment Details</h2>
            
                    <form id="payment-form" action="/process-payment" method="POST">
                        <!-- Hidden field for Stripe token -->
                        <input type="hidden" id="stripeToken" name="stripeToken">
                        
                        <div class="mb-4">
                            <label for="card-name" class="block text-sm font-medium text-gray-700 mb-1">Name on Card</label>
                            <input type="text" id="card-name" name="cardName" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="John Doe">
                        </div>
                        
                        <!-- Stripe Elements will be mounted here -->
                        <div class="mb-4">
                            <label for="card-element" class="block text-sm font-medium text-gray-700 mb-1">Card Details</label>
                            <div id="card-element" class="p-3 border border-gray-300 rounded-md"></div>
                            <div id="card-errors" class="text-red-500 text-sm mt-2" role="alert"></div>
                        </div>
                        
                        <button type="submit" id="payment-button" class="w-full primary-gradient text-white py-3 px-4 rounded-md font-medium hover:opacity-90 transition-opacity focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                            Complete Payment
                        </button>
                    </form>
                </div>
                
                <div class="p-6 border-t border-gray-200 text-center">
                    <a href="{{ route('client.orders') }}" class="text-purple-600 hover:underline">Return to Dashboard</a>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{ asset('js/payment.js') }}"></script>
@endsection