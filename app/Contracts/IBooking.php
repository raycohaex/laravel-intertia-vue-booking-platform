<?php

namespace App\Contracts;

use App\DTO\AccommodationPrice;
use App\Models\Accommodation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

interface IBooking
{
    public function createBookingSession(AccommodationPrice $accommodationPrice, Accommodation $accommodation, User $user, Carbon $checkIn, Carbon $checkOut);
    public function processBookingPayment(string $stripeSessionId);
}
