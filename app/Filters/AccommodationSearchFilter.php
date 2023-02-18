<?php

namespace App\Filters;

class AccommodationSearchFilter
{
    protected array $filters = [];

    public const COUNTRY            = 'country';
    public const CITY               = 'city';
    public const BEDS               = 'beds';
    public const MIN_PRICE          = 'min_price';
    public const MAX_PRICE          = 'max_price';
    public const MIN_RATING         = 'min_rating';
    private const POPULARITY_SCORE  = 'popularity_score';


    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }

    /*
     * 
     */
    public function apply($query): mixed
    {
        // TODO: map to real world location
        if (isset($this->filters[self::COUNTRY])) {
            $query->where(self::COUNTRY, $this->filters[self::COUNTRY]);
        }

        // TODO: map to real world location
        if (isset($this->filters[self::CITY])) {
            $query->where(self::CITY, $this->filters[self::CITY]);
        }

        if (isset($this->filters[self::BEDS])) {
            $query->where(self::BEDS, $this->filters[self::BEDS]);
        }

        if (isset($this->filters[self::MIN_PRICE]) && isset($this->filters[self::MAX_PRICE])) {
            $query->whereBetween('price', [$this->filters[self::MIN_PRICE], $this->filters[self::MAX_PRICE]]);
        }

        if (isset($this->filters[self::MIN_RATING])) {
            // ...
        }

        return $query->orderByDesc('popularity_score');
    }
}
