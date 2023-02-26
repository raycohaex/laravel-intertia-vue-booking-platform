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
    public function getPrice(Carbon $start_date, Carbon $end_date, Accommodation $accommodation): AccommodationPrice
    {
        $days = $start_date->diffInDays($end_date);

        // calculate total price
        $totalPrice = $accommodation->price * $days + $accommodation->cleaning_cost;
        $serviceFee = $totalPrice / 100 * self::CONSUMER_FEE_PLACEHOLDER;
        $totalPrice += $serviceFee;

        $accommodationPriceDto = new AccommodationPrice(
            $days,
            $accommodation->price,
            $accommodation->cleaning_cost,
            $serviceFee,
            $totalPrice
        );

        // calculate and apply taxes
        $accommodationPriceDto = $this->calculateTax($accommodationPriceDto);

        return $accommodationPriceDto;
    }

    /**
     * @param AccommodationPrice $accommodationPriceDto
     * @return AccommodationPrice
     */
    public function calculateTax(AccommodationPrice $accommodationPriceDto): AccommodationPrice
    {
        // Tax rates differ per country. A strategy pattern could be used to use the right algorithm.
        // For now it's hardcoded to 21%, the Dutch tax rate. Because the project is intended to be a demo.
        $tax = $accommodationPriceDto->totalPrice / 100 * 21;
        $accommodationPriceDto->totalPrice += $tax;
        $accommodationPriceDto->tax = $tax;
        return $accommodationPriceDto;
    }
}
