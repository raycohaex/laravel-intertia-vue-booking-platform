<?php

use App\Http\Controllers\AccommodationController;
use App\Http\Controllers\BookingsController;
use App\Http\Controllers\BookStayController;
use App\Http\Controllers\Pay\StripePaymentController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AccommodationController::class, 'index'])->name('accommodation.index');
Route::get('/accommodation/{accommodation}', [AccommodationController::class, 'show'])->name('accommodation.show');
Route::get('/accommodation/{accommodation}/calculate-price', [AccommodationController::class, 'calculatePrice'])->name('accommodations.price');

// group with required auth
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/book/stay/{accommodation}', [BookStayController::class, 'checkout'])->name('book.stay');

    Route::get('/bookings', [BookingsController::class, 'bookings'])->name('bookings');
});

Route::controller(StripePaymentController::class)->group(function(){
    Route::post('stripe/checkout', 'stripePost')->name('stripe.post');
    Route::get('/bookings/success', 'paymentSuccess')->name('bookings.success');
    Route::get('/bookings/cancel', 'paymentCancel')->name('bookings.cancel');
});
