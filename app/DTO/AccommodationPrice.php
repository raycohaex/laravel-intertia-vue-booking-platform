<?php

namespace App\DTO;

/**
 * @dev Public properties on DTOs are debatable in my opinion. This one only contains structured data with no logic
 * instead of sending an array or collection.
 * Beforehand I knew this project wouldn't scale, so I chose convenience. I wouldn't always do this just to be clear.
 */
class AccommodationPrice
{
    public float $basePrice;
    public int $days;
    public float $cleaning_cost;
    public float $fees;
    public float $tax;
    public float $totalPrice;

    /**
     * @param int $days
     * @param float $basePrice
     * @param float $cleaning_cost
     * @param float $fees
     * @param float $totalPrice
     */
    public function __construct(int $days, float $basePrice, float $cleaning_cost, float $fees, float $totalPrice) {
        $this->basePrice = $basePrice;
        $this->cleaning_cost = $cleaning_cost;
        $this->fees = $fees;
        $this->days = $days;
        $this->totalPrice = $totalPrice;
    }
}
