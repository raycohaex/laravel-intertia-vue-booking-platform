<?php

namespace App\Http\Controllers;

use App\Contracts\IAccommodationPricing;
use App\Contracts\IBooking;
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
    public function checkout(
        Request $request,
        int $accommodation,
        IAccommodationPricing $accommodationPricingService,
        IBooking $bookingService
    ) {
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

        $session = $bookingService->createBookingSession(
            $price,
            $accommodation,
            $request->user(),
            Carbon::parse($dates['start_date']),
            Carbon::parse($dates['end_date'])
        );

        return Inertia::render('Book/Stay/Index', [
            'accommodation' => $accommodation,
            'accommodationPrice' => $price,
            'stripeSessionId' => $session->id,
            'publishableKey' => env('STRIPE_KEY'),
        ]);
    }
}
