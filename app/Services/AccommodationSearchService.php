<?php

namespace App\Services;

use App\Models\Accommodation;

/**
 * Service which is responsible for querying Accommodations based on criteria.
 */
class AccommodationSearchService
{
    public const COUNTRY            = 'country';
    public const CITY               = 'city';
    public const BEDS               = 'beds';
    public const MIN_PRICE          = 'min_price';
    public const MAX_PRICE          = 'max_price';
    public const MIN_RATING         = 'min_rating';
    private const POPULARITY_SCORE  = 'popularity_score';
    private const PAGINATION        = 25;

    public function __construct()
    {
    }

    /**
     * @param array|null $filters
     * @param int|null $paginate
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function search(?array $filters, ?int $paginate = self::PAGINATION)
    {
        $query = Accommodation::query();

        // TODO: map to real world location
        if (isset($filters[self::COUNTRY])) {
            $query->where(self::COUNTRY, $filters[self::COUNTRY]);
        }

        // TODO: map to real world location
        if (isset($filters[self::CITY])) {
            $query->where(self::CITY, $filters[self::CITY]);
        }

        if (isset($filters[self::BEDS])) {
            $query->where(self::BEDS, $filters[self::BEDS]);
        }

        if (isset($filters[self::MIN_PRICE]) && isset($filters[self::MAX_PRICE])) {
            $query->whereBetween('price', [$filters[self::MIN_PRICE], $filters[self::MAX_PRICE]]);
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
