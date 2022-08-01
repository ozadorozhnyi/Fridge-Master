<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bookings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'location_id',
        'access_code',
        'requested_volume',
        'requested_temperature',
        'start_date',
        'end_date',
        'status',
        'total_costs_on_book_date'
    ];

    /**
     * Get the user that owns the booking.
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class, 'user_id', 'id'
        );
    }

    /**
     * Get the location that owns the booking.
     * @return BelongsTo
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(
            Location::class, 'location_id', 'id'
        );
    }
}
