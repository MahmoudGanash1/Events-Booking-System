<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Event\EventController;
use App\Http\Controllers\Booking\BookingController;
use App\Http\Controllers\Event\EventMediaController;
use App\Http\Controllers\Categories\CategoriesController;


// Auth 

Route::post('register', [AuthController::class, 'register']);
Route::post('/verify-email-otp', [AuthController::class, 'verifyEmailOtp']);
Route::post('/resend-email-otp', [AuthController::class, 'resendEmailOtp']);
Route::post('login', [AuthController::class, 'login']);


// Events

Route::middleware('auth:sanctum')->group(function () {
    
                  // CRUD 
    Route::post('/events', [EventController::class, 'store']);
    Route::put('/events/{event}', [EventController::class, 'update']);
    Route::delete('/events/{event}', [EventController::class, 'destroy']);

               // Show Events

    Route::get('/events', [EventController::class, 'index']);
    Route::get('/events/{event}', [EventController::class, 'show']);
});




// Bookings 

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/events/{event}/book', [BookingController::class, 'book']);
    Route::get('/my-bookings', [BookingController::class, 'myBookings']);
    Route::delete('/bookings/{booking}', [BookingController::class, 'cancelBooking']);
});





// Categories
Route::middleware('auth:sanctum')->group(function () {

Route::get('/categories', [CategoriesController::class, 'showall']);
Route::get('/categories/{category}', [CategoriesController::class, 'showone']);
Route::post('/categories', [CategoriesController::class, 'store']);
Route::put('/categories/{category}', [CategoriesController::class, 'update']);
Route::delete('/categories/{category}', [CategoriesController::class, 'destroy']);

});


//media

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/events/{event}/media', [EventMediaController::class, 'store']);
    Route::delete('/events/{event}/media/{media}', [EventMediaController::class, 'destroy']);

});
