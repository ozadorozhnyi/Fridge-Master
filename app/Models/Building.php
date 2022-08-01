<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Building extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'buildings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'location_id',  'temperature',
    ];

    /**
     * Get the location that owns the building.
     * @return BelongsTo
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(
            Location::class, 'location_id'
        );
    }

    /**
     * Get the blocks for the building.
     * @return HasMany
     */
    public function blocks(): HasMany
    {
        return $this->hasMany(
            Block::class, 'building_id', 'id'
        );
    }

}
