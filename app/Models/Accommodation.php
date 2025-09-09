<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Accommodation extends Model
{
    /** @use HasFactory<\Database\Factories\AccommodationFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'type',
        'area',
        'capacity',
        'bedrooms',
        'department',
        'municipality',
        'address',
        'description',
        'latitude',
        'longitude',
        'main_image',
        'wifi',
        'air_conditioning',
        'parking',
        'spa',
        'equipped_kitchen',
        'household_linen_provided',
        'bathroom',
        'price_night',
        'min_number_nights',
        'security_deposit',
        'cleaning_charges',
        'arrival_time',
        'departure_time',
        'smokers_allowed',
        'pets_allowed',
        'events_allowed',
        'minimum_age',
        'additional_rules',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(AccommodationImage::class);
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(AccommodationReservation::class);
    }
}
