<?php

namespace App\Http\Controllers\Pay;

use App\Contracts\IBooking;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\FlareClient\Http\Exceptions\NotFound;
use Stripe;use Stripe\Checkout\Session;

class StripePaymentController extends Controller
{
    public function paymentSuccess(Request $request, IBooking $bookingService) {
        $sessionId = request()->query('session_id');

        $booking = $bookingService->processBookingPayment($sessionId);

        // 404
        if (!$booking) {
            return Inertia::render('Error', ['status' => 'Not found'])
            ->toResponse($request)
            ->setStatusCode($response->status());
        }

        // return success inertia page, pass booking
        return Inertia::render('Booking/Success', [
            'booking' => $booking->load('accommodation', 'accommodation.images')
        ]);
    }
}
