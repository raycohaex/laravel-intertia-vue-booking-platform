<?php

namespace App\Services;

use App\Filters\AccommodationSearchFilter;
use App\Models\Accommodation;

class AccommodationSearchService
{
    protected array $filters = [];

    public const COUNTRY            = 'country';
    public const CITY               = 'city';
    public const BEDS               = 'beds';
    public const MIN_PRICE          = 'min_price';
    public const MAX_PRICE          = 'max_price';
    public const MIN_RATING         = 'min_rating';
    private const POPULARITY_SCORE  = 'popularity_score';

    public function __construct()
    {
    }

    /**
     * @param AccommodationSearchFilter $filters
     * @param int|null $paginate
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function search(?array $filters, ?int $paginate = 35)
    {
        $query = Accommodation::query();

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

        $query->with(['images' => function($query){
            $query->orderBy('order');
        }]);

        return $query->paginate($paginate);
    }

    /**
     * @return array<string>
     */
    public function params(): array
    {
        return [
            self::COUNTRY,
            self::CITY,
            self::BEDS,
            self::MIN_PRICE,
            self::MAX_PRICE,
            self::MIN_RATING,
            self::POPULARITY_SCORE
        ];
    }
}
