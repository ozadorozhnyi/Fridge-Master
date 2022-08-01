<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Block extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'blocks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'building_id',
        'current_rent_price',
    ];

    /**
     * Get the building that owns the block.
     * @return BelongsTo
     */
    public function building(): BelongsTo
    {
        return $this->belongsTo(
            Building::class, 'building_id', 'id'
        );
    }

}
