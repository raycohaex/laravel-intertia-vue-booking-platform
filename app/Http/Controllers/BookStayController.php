<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\Booking;
use App\Services\AccommodationPricingService;
use App\Services\AccommodationSearchService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Stripe\Checkout\Session;

class BookStayController extends Controller
{
    public function checkout(Request $request, int $accommodation, AccommodationPricingService $accommodationPricingService) {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $dates = $request->only(['start_date', 'end_date']);
        $accommodation = Accommodation::find($accommodation)
            ->load('images');

        $price = $accommodationPricingService->getPrice(
            Carbon::parse($dates['start_date']),
            Carbon::parse($dates['end_date']),
            $accommodation
        );


        $session = Session::create([
            'payment_method_types' => ['card', 'ideal'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'eur',
                        'unit_amount' => intval($price->totalPrice * 100),
                        'product_data' => [
                            'name' => $accommodation->name,
                            'images' => [$accommodation->images[0]->url]
                        ],
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            // return the id of the session being made
            'success_url' => route('bookings.success', [], true)."?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url' => route('bookings.cancel'),
        ]);

        $booking = new Booking();
        $booking->accommodation()->associate($accommodation);
        $booking->user()->associate($request->user());
        $booking->check_in = Carbon::parse($dates['start_date']);
        $booking->check_out = Carbon::parse($dates['end_date']);
        $booking->status = 'pending';
        $booking->stripe_session_id = $session->id;
        $booking->amount = $price->totalPrice;
        $booking->amount_paid = 0;
        $booking->save();

        return Inertia::render('Book/Stay/Index', [
            'accommodation' => $accommodation,
            'accommodationPrice' => $price,
            'stripeSessionId' => $session->id,
            'publishableKey' => env('STRIPE_KEY'),
        ]);
    }
}
