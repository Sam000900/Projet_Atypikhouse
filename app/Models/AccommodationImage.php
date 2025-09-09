<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AccommodationImage extends Model
{
    /** @use HasFactory<\Database\Factories\AccommodationImageFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'accommodation_id',
        'image_path',
        'is_main',
    ];

    /**
     * Get the accommodation that owns the image.
     */
    public function accommodation(): BelongsTo
    {
        return $this->belongsTo(Accommodation::class);
    }

    /**
     * Get the full URL for the image.
     */
    public function getUrlAttribute(): string
    {
        return asset('storage/' . $this->image_path);
    }
}
