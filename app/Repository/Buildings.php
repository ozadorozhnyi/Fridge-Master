<?php

namespace App\Repository;

use App\Models\Building;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

/**
 * Locations Repository
 */
class Buildings
{
    /**
     * Collection of location items
     * @var Collection
     */
    protected static Collection $items;

    /**
     * Model class used to retrieve data from db.
     * @var string
     */
    protected $model = Building::class;

    /**
     * Get count of buildings with suitable temperature for the specified location.
     *
     * @param int $location_id
     * @param array $temperatures
     * @return Collection
     */
    public function withSuitableTemperaturesCount(int $location_id, array $temperatures): Collection
    {
        if (!isset(static::$items)) {
            static::$items = Cache::remember(
                'buildings::with-suitable-temperatures',
                Carbon::now()->addHour(),
                function() use ($location_id, $temperatures) {
                    return Building::where('location_id', $location_id)
                        ->whereBetween('temperature', [min($temperatures), max($temperatures)])
                        ->get();
                }
            );
        }
        return static::$items;
    }
}
