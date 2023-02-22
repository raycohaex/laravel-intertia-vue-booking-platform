<?php

namespace App\DTO;

class AccommodationPrice
{
    public float $basePrice;
    public int $days;
    public float $cleaning_cost;
    public float $fees;
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
