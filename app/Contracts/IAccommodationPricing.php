<?php

namespace App\Contracts;

use App\DTO\AccommodationPrice;
use App\Models\Accommodation;
use Carbon\Carbon;

interface IAccommodationPricing
{
    public function getPrice(Carbon $start_date, Carbon $end_date, Accommodation $accommodation);
    public function calculateTax(AccommodationPrice $accommodationPriceDto);
}
