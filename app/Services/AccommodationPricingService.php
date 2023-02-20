<?php

namespace App\Services;

use App\Contracts\IAccommodationPricing;
use App\DTO\AccommodationPrice;
use App\Models\Accommodation;
use Carbon\Carbon;

class AccommodationPricingService implements IAccommodationPricing {
    private const CONSUMER_FEE_PLACEHOLDER = 5;
    public function __construct() {}


    /**
     * @dev This can be expanded upon with discounts and such.
     * For now it's a simple service returning everything encapsulating the price.
     * @param Carbon $start_date
     * @param Carbon $end_date
     * @param Accommodation $accommodation
     * @return AccommodationPrice
     */
    public function getPrice(Carbon $start_date, Carbon $end_date, Accommodation $accommodation)
    {
        $days = $start_date->diffInDays($end_date);

        $accommodationPriceDto = new AccommodationPrice(
            $days,
            $accommodation->price,
            $accommodation->cleaning_cost,
            5
        );

        return $accommodationPriceDto;
    }
}
