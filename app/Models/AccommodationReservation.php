<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AccommodationReservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'accommodation_id',
        'user_id',
        'arrival_date',
        'departure_date',
        'price_paid',
    ];

    /**
     * Get the accommodation that owns the reservation.
     */
    public function accommodation(): BelongsTo
    {
        return $this->belongsTo(Accommodation::class);
    }

    /**
     * Get the user that owns the reservation.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
