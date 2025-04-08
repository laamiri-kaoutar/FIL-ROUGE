<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    // return view('welcome');
    return view('home');

})->name('home');

Route::get('/chat', function () {
    // return view('welcome');
    return view('chat');

})->name('chat');


Route::get('/password-request', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Forgot Password routes
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'reset'])->name('password.update');
// Clinets routes : 

Route::get('/client/services', function () {
    return view('client.services');
})->name('client.services');

Route::get('/client/services/{id}', function () {
    return view('client.service-show');
})->name('client.service.show');

Route::get('/client/payment', function () {
    return view('payment');
})->name('client.payment');

Route::get('/client/dashboard', function () {
    return view('client.dashboard');
})->name('client.dashboard');

Route::get('/client/profile', function () {
    return view('client.profile');
})->name('client.profile');

Route::get('/client/orders', function () {
    return view('client.orders');
})->name('client.orders');

Route::get('/client/favorites', function () {
    return view('client.favorites');
})->name('client.favorites');

Route::get('/client/reviews', function () {
    return view('client.reviews');
})->name('client.reviews');


// freelancer routes
Route::get('/freelancer/dashboard', function () {
    return view('freelancer.dashboard');
})->name('freelancer.dashboard');

Route::get('/freelancer/transactions', function () {
    return view('freelancer.transactions');
})->name('freelancer.transactions');

Route::get('/freelancer/profile', function () {
    return view('freelancer.profile');
})->name('freelancer.profile');

Route::get('/freelancer/demands', function () {
    return view('freelancer.demands');
})->name('freelancer.demands');

Route::get('/freelancer/services', function () {
    return view('freelancer.services');
})->name('freelancer.services');

Route::get('/freelancer/orders', function () {
    return view('freelancer.orders');
})->name('freelancer.orders');

Route::get('/freelancer/services/{id}/edit', function ($id) {
    return view('freelancer.service-edit');
})->name('freelancer.service.edit');


// Admin Routes (prefix: /admin)
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    // Dashboard (Landing Page)
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Account Validation
    Route::get('/account-validation', [AdminController::class, 'accountValidation'])->name('admin.account-validation');

    // Categories
    Route::get('/categories', [AdminController::class, 'categories'])->name('admin.categories');

    // Signals (Reported Comments)
    Route::get('/signals', [AdminController::class, 'signals'])->name('admin.signals');

    // Services
    Route::get('/services', [AdminController::class, 'services'])->name('admin.services');

    // Transactions
    Route::get('/transactions', [AdminController::class, 'transactions'])->name('admin.transactions');
});