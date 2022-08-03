<?php

namespace App\Repository;

use App\Models\Block;
use Illuminate\Support\Collection;

class Blocks
{
    /**
     * Get a free blocks on the current date and at the booking start date.
     *
     * @param Collection $suitable_buildings
     * @param string $start_date
     * @return Collection
     */
    public function getFree(Collection $suitable_buildings, string $start_date): Collection
    {
        return Block::select('blocks.id', 'blocks.current_rent_price', 'buildings.temperature')
            ->rightJoin('buildings', 'blocks.building_id', '=', 'buildings.id')
            ->rightJoin('locations', 'buildings.location_id', '=', 'locations.id')
            ->whereIn('buildings.id', $suitable_buildings->pluck('id'))
            ->whereNotIn('blocks.id', function ($query) use ($start_date) {
                $query->select('busy_blocks.id')
                    ->from('busy_blocks')
                    ->whereIn('busy_blocks.status', ['reserved', 'busy'])
                    ->whereDate('busy_blocks.end_date', '>', $start_date);
            })
            ->orderBy('blocks.current_rent_price', 'DESC')
            ->get();
    }
}
