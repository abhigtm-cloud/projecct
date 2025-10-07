<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/categories/{category}', [HomeController::class, 'category'])->name('category.show');

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Property routes
Route::resource('properties', PropertyController::class);
Route::get('/properties/{property}/availability', [PropertyController::class, 'checkAvailability'])->name('properties.availability');

// Authenticated routes
Route::middleware('auth')->group(function () {
    // Host Dashboard
    Route::get('/host/dashboard', [PropertyController::class, 'hostDashboard'])->name('host.dashboard');
    Route::get('/host/properties', [PropertyController::class, 'hostProperties'])->name('host.properties');
    
    // Booking routes
    Route::resource('bookings', BookingController::class);
    Route::get('/trips', [BookingController::class, 'trips'])->name('trips');
    Route::patch('/bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
    
    // Wishlist routes
    Route::get('/wishlists', [WishlistController::class, 'index'])->name('wishlists.index');
    Route::post('/wishlists', [WishlistController::class, 'store'])->name('wishlists.store');
    Route::delete('/wishlists/{property}', [WishlistController::class, 'destroy'])->name('wishlists.destroy');
    
    // API routes for AJAX
    Route::prefix('api')->group(function () {
        Route::post('/wishlist/toggle', [WishlistController::class, 'toggle'])->name('api.wishlist.toggle');
        Route::get('/properties/{property}/availability', [PropertyController::class, 'checkAvailability'])->name('api.properties.availability');
    });
});
