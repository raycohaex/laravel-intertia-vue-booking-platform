<?php

namespace App\DTO;

class AccommodationPrice
{
    private float $basePrice;
    private int $days;
    private float $cleaning_cost;
    private float $fees;

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

    public function getBasePrice(): float {
        return $this->basePrice;
    }

    public function getDays(): int {
        return $this->days;
    }

    public function getCleaningCost(): float {
        return $this->cleaning_cost;
    }

    public function getFees(): float {
        return $this->fees;
    }
}
