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
}
