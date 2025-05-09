<?php

use App\Models\Feature;
use App\Models\ServicePackage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FreelancerController;

// Route::get('/', function () {
//     // return view('welcome');
//     return view('home');

// })->name('home');

Route::get('/', [WelcomeController::class, 'index'])->name('home');

Route::get('/test', function () {
    // $data = ServicePackage::All();
    // foreach ($data as $value) {
    //     var_dump($value->features);
    //     // dd("tttttttttttttttt");
    // }
    // dd($data);
    $package = App\Models\ServicePackage::find(3);

    var_dump($package->features);
    foreach ($package->features as $value) {
        
    }

})->name('test');



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


Route::get('/freelancer/transactions', function () {
    return view('freelancer.transactions');
})->name('freelancer.transactions');



Route::get('/freelancer/demands', function () {
    return view('freelancer.demands');
})->name('freelancer.demands');



// Admin Routes (prefix: /admin)
Route::prefix('freelancer')->middleware(['auth', 'freelancer'])->group(function () {
    Route::get('/services/{id}/edit',[ServiceController::class, 'edit'])->name('freelancer.service.edit');
    Route::get('/services', [ServiceController::class, 'freelancerServices'])->name('freelancer.services');
    Route::post('/services', [ServiceController::class, 'create'])->name('services.create');
    Route::post('/services/{id}', [ServiceController::class, 'update'])->name('services.update');
    Route::post('/services/{id}/images', [ServiceController::class, 'addImage'])->name('services.addImage');
    Route::delete('/services/{id}/images/{imageId}', [ServiceController::class, 'deleteImage'])->name('services.deleteImage');
    Route::post('/services/{id}/packages', [ServiceController::class, 'addPackage'])->name('services.addPackage');
    Route::post('/services/{id}/packages/{packageId}', [ServiceController::class, 'updatePackage'])->name('services.updatePackage');
    Route::delete('/services/{id}/packages/{packageId}', [ServiceController::class, 'deletePackage'])->name('services.deletePackage');
    Route::post('/services/{id}/packages/{packageId}/features', [ServiceController::class, 'addFeature'])->name('services.addFeature');
    Route::delete('/services/{id}/packages/{packageId}/features/{featureId}', [ServiceController::class, 'deleteFeature'])->name('services.deleteFeature');   
    Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');
    Route::get('/orders', [FreelancerController::class, 'orders'])->name('freelancer.orders');
    Route::post('/orders/{id}/update-status', [FreelancerController::class, 'updateOrderStatus'])->name('freelancer.orders.update-status');
    Route::get('/dashboard', [FreelancerController::class, 'dashboard'])->name('freelancer.dashboard');

    
});


Route::prefix('client')->middleware(['auth' , 'client'])->group(function () {
    Route::get('/services/{id}', [ServiceController::class, 'show'])->name('client.services.show');
    Route::post('/services/{id}/favorite', [ClientController::class, 'toggleFavorite'])->name('client.services.favorite');
    Route::post('/services/{id}/review', [ClientController::class, 'storeReview'])->name('client.services.review');
    Route::get('/services/{service_id}/reviews/{review_id}/edit', [ClientController::class, 'editReview'])->name('client.services.reviews.edit');
    Route::put('/services/{service_id}/reviews/{review_id}', [ClientController::class, 'updateReview'])->name('client.services.reviews.update');
    Route::delete('/services/{service_id}/reviews/{review_id}', [ClientController::class, 'deleteReview'])->name('client.services.reviews.delete');
    Route::get('/services/{service_id}/order', [ClientController::class, 'showPaymentPage'])->name('client.services.order');
    Route::post('/process-payment', [ClientController::class, 'processPayment'])->name('client.process_payment');
    Route::get('/order-confirmation/{order_id}', [ClientController::class, 'orderConfirmation'])->name('client.order_confirmation');
    Route::get('/order/{order_id}/invoice', [ClientController::class, 'downloadInvoice'])->name('client.order_invoice');
    Route::get('/orders', [ClientController::class, 'orders'])->name('client.orders');
    Route::get('/reviews', [ClientController::class, 'reviews'])->name('client.reviews');
    Route::get('/favorites', [ClientController::class, 'favorites'])->name('client.favorites');
    Route::post('/reviews/{id}/report', [ReviewController::class, 'report'])->name('client.reviews.report');
    Route::get('/dashboard', [ClientController::class, 'dashboard'])->name('client.dashboard');
});

Route::get('/services', [ServiceController::class, 'services'])->name('client.services');


Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/chat/{conversation?}', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/conversation/start', [ChatController::class, 'startConversation'])->name('conversation.start');
    Route::get('/conversations', [ChatController::class, 'getConversations'])->name('conversations.get');
    Route::get('/conversations/{conversation}/messages', [ChatController::class, 'getMessages'])->name('messages.get');
    Route::post('/conversations/{conversation}/messages', [ChatController::class, 'sendMessage'])->name('messages.send');
});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/services', [AdminController::class, 'services'])->name('admin.services');
    Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::get('/transactions', [AdminController::class, 'transactions'])->name('admin.transactions');
    Route::get('/signals', [AdminController::class, 'signals'])->name('admin.signals');
    Route::delete('/signals/{id}/dismiss', [AdminController::class, 'dismissSignal'])->name('admin.signals.dismiss');
    Route::delete('/signals/{id}/review', [AdminController::class, 'deleteReviewFromSignal'])->name('admin.signals.deleteReview');
    Route::get('/reviews', [AdminController::class, 'reviews'])->name('admin.reviews');
    Route::delete('/reviews/{id}', [AdminController::class, 'deleteReview'])->name('admin.reviews.delete');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::post('/users/{id}/suspend', [AdminController::class, 'suspendUser'])->name('admin.users.suspend');
    Route::post('/users/{id}/ban', [AdminController::class, 'banUser'])->name('admin.users.ban');
    Route::post('/users/{id}/unban', [AdminController::class, 'unbanUser'])->name('admin.users.unban');
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::get('/orders/export', [AdminController::class, 'exportOrders'])->name('admin.orders.export');
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

