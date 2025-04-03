<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::get('register', function () {
    return 'register Page';
})->name('register');


Route::get('home', function () {
    return 'home Page';
})->name('home');

Route::get('login', function () {
    return 'login Page';
})->name('login');

Route::get('logout', function () {
    return 'logout Page';
})->name('logout');



Route::get('/test-navbar', function () {
    return view('test-navbar');
});

Route::get('/explore', function () {
    return 'Explore Page';
})->name('explore');

Route::get('/categories', function () {
    return 'Categories Page';
})->name('categories');

Route::get('/how-it-works', function () {
    return 'How It Works Page';
})->name('how-it-works');