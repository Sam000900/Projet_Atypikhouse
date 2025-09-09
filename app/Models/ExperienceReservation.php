<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExperienceReservation extends Model
{
    /** Factory does not exist for now */
    /** @use HasFactory<\Database\Factories\ExperienceReservationFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'experience_id',
        'user_id',
        'date',
    ];

    /**
     * Get the experience that owns the reservation.
     */
    public function experience(): BelongsTo
    {
        return $this->belongsTo(Experience::class);
    }

    /**
     * Get the user that owns the reservation.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
