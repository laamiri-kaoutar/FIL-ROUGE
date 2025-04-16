<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CategoryController;

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

// Route::get('/freelancer/services', function () {
//     return view('freelancer.services');
// })->name('freelancer.services');

Route::get('/freelancer/orders', function () {
    return view('freelancer.orders');
})->name('freelancer.orders');

// Route::get('/freelancer/services/{id}/edit', function ($id) {
//     return view('freelancer.service-edit');
// })->name('freelancer.service.edit');


// Admin Routes (prefix: /admin)
Route::prefix('freelancer')->middleware(['auth', 'freelancer'])->group(function () {
    Route::get('/services/{id}/edit',[ServiceController::class, 'edit'])->name('freelancer.service.edit');
    Route::get('/services', [ServiceController::class, 'freelancerServices'])->name('freelancer.services');
    Route::post('/services', [ServiceController::class, 'create'])->name('services.create');
    

});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/account-validation', [AdminController::class, 'accountValidation'])->name('admin.account-validation');
    // Route::get('/categories', [AdminController::class, 'categories'])->name('admin.categories');
    Route::get('/signals', [AdminController::class, 'signals'])->name('admin.signals');
    Route::get('/services', [AdminController::class, 'services'])->name('admin.services');
    Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::get('/transactions', [AdminController::class, 'transactions'])->name('admin.transactions');
});


Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('admin.categories');
    Route::post('/', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('edit');
    Route::put('/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});

Route::prefix('tags')->group(function () {
    Route::get('/', [TagController::class, 'index'])->name('admin.tags');
    Route::post('/', [TagController::class, 'store'])->name('tags.store');
    Route::get('/{id}/edit', [TagController::class, 'edit'])->name('edit');
    Route::put('/{id}', [TagController::class, 'update'])->name('tags.update');
    Route::delete('/{id}', [TagController::class, 'destroy'])->name('tags.destroy');
});


// Route::prefix('admin')->group(function () {
//     Route::get('/tags', [TagController::class, 'index'])->name('admin.tags');

//     Route::post('/tags', [TagController::class, 'store'])->name('tags.store');

//     Route::get('/tags/${id}/edit',  [TagController::class, 'edit'])->name('tags.edit');
//     Route::put('/tags/{tag}', [TagController::class, 'update'])->name('tags.update');
//     Route::delete('/tags/{tag}', [TagController::class, 'destroy'])->name('tags.destroy');
// });
