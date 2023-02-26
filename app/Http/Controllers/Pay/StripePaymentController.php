<?php

namespace App\Http\Controllers\Pay;

use App\Contracts\IBooking;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Stripe;use Stripe\Checkout\Session;

class StripePaymentController extends Controller
{
    public function paymentSuccess(Request $request, IBooking $bookingService) {
        $sessionId = request()->query('session_id');

        $booking = $bookingService->processBookingPayment($sessionId);

        // return success inertia page, pass booking
        return Inertia::render('Booking/Success', [
            'booking' => $booking->load('accommodation', 'accommodation.images')
        ]);
    }
}
