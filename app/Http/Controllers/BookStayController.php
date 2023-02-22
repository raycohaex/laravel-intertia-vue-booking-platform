<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Services\AccommodationPricingService;
use App\Services\AccommodationSearchService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookStayController extends Controller
{
    public function checkout(Request $request, int $accommodation, AccommodationPricingService $accommodationPricingService) {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $dates = $request->only(['start_date', 'end_date']);

        // get accommodation with images
        $accommodation = Accommodation::find($accommodation)
            ->load('images');

        $price = $accommodationPricingService->getPrice(
            Carbon::parse($dates['start_date']),
            Carbon::parse($dates['end_date']),
            $accommodation
        );

        // TODO: proper route
        return Inertia::render('Book/Stay/Index', [
            'accommodation' => $accommodation,
            'accommodationPrice' => $price
        ]);
    }
}
