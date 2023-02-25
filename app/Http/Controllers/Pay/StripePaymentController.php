<?php

namespace App\Http\Controllers\Pay;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

        dd($session);
        return response('OK', 200);
    }
}
