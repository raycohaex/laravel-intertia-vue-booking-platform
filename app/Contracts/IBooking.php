<?php

namespace App\Contracts;

interface IBooking
{
    public function createBookingSession(AccommodationPrice $accommodationPrice, Accommodation $accommodation);
    
}
