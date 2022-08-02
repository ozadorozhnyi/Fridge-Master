<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'locations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'name',  'timezone',
    ];

    /**
     * Get the buildings for the location.
     * @return HasMany
     */
    public function buildings(): HasMany
    {
        return $this->hasMany(
            Building::class, 'location_id', 'id'
        );
    }

    /**
     * Get the bookings for the location.
     * @return HasMany
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(
            Booking::class, 'location_id', 'id'
        );
    }

    /**
     * Load locations with free blocks for now.
     *
     * @return mixed
     */
    public static function withFreeBlocks()
    {
        return self::select('locations.id', 'locations.name', 'locations.timezone')
            ->selectRaw('COUNT(blocks.id) as free_blocks_count')
            ->rightJoin('buildings', 'locations.id', '=', 'buildings.location_id')
            ->rightJoin('blocks', 'buildings.id', '=', 'blocks.building_id')
            ->whereNotIn('blocks.id', function($query) {
                $query->select('busy_blocks.block_id')
                    ->from('busy_blocks')
                    ->whereIn('busy_blocks.status', ['busy', 'reserved']);
            })
            ->groupBy('locations.id')
            ->orderBy('locations.id', 'ASC')
            ->get();
    }
}
