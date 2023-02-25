<?php

namespace App\Http\Controllers\Pay;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Stripe;use Stripe\Checkout\Session;

class StripePaymentController extends Controller
{
    public function paymentSuccess(Request $request) {
        // Verify the request is from the payment gateway using your secret key
        $secretKey = env('STRIPE_SECRET');
        $sessionId = request()->query('session_id');

        try {
            $session = Session::retrieve($sessionId, $secretKey);
        } catch (\Exception $e) {
            return response('Payment not successful', 400);
        }

        if ($session->payment_status !== 'paid') {
            return response('Payment not successful', 400);
        }

        // get Booking where session_id = $sessionId, firstOrFail
        $booking = Booking::where('stripe_session_id', $sessionId)->firstOrFail();

        if(!$booking) {
            return response('Payment not successful', 400);
        }

        $booking->status = 'paid';
        $booking->amount_paid = $session->amount_total / 100;
        $booking->save();

        // return success inertia page, pass booking
        return Inertia::render('Booking/Success', [
            'booking' => $booking->load('accommodation', 'accommodation.images')
        ]);
    }
}
