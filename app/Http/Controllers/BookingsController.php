<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookingsController extends Controller
{
    public function bookings(Request $request)
    {
        $bookings = Booking::where('userid', '=', $request->user()->id);

        return Inertia::render('Bookings/Index', [
            'bookings' => $bookings,
        ]);
    }
}
