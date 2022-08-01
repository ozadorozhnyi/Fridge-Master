<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BusyBlock extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'busy_blocks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'block_id',
        'booking_id',
        'status',
        'start_date',
        'end_date',
        'rent_price'
    ];

    /**
     * Get the block that owns the busy block.
     * @return BelongsTo
     */
    public function block(): BelongsTo
    {
        return $this->belongsTo(
            Block::class, 'block_id', 'id'
        );
    }

    /**
     * Get the booking that owns the busy block.
     * @return BelongsTo
     */
    public function booking(): BelongsTo
    {
        return $this->belongsTo(
            Booking::class, 'booking_id', 'id'
        );
    }
}
