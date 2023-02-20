<?php

namespace App\DTO;

class AccommodationPrice
{
    public float $basePrice;
    public int $days;
    public float $cleaning_cost;
    public float $fees;

    /**
     * @param int $days
     * @param float $basePrice
     * @param float $cleaning_cost
     * @param float $fees
     */
    public function __construct(int $days, float $basePrice, float $cleaning_cost, float $fees) {
        $this->basePrice = $basePrice;
        $this->cleaning_cost = $cleaning_cost;
        $this->fees = $fees;
        $this->days = $days;
    }

    public function getTotalPrice(): float {
        $totalPriceNights = $this->basePrice * $this->days;
        return $totalPriceNights + $this->cleaning_cost + $this->fees;
    }
}
