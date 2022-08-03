<?php

namespace App\Repository;

use Carbon\Carbon;
use App\Models\Location;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

/**
 * Locations Repository
 */
class Locations
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
    protected $model = Location::class;

    /**
     * Get all items
     * @return Collection
     */
    public function allWithFreeBlocks():Collection
    {
        if (!isset(static::$items)) {
            static::$items = Cache::remember('locations-with-free-blocks', Carbon::now()->addHour(), function() {
                return Location::withFreeBlocks();
            });
        }
        return static::$items;
    }
}
