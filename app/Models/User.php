<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'role',
        'lastname',
        'firstname',
        'email',
        'phone',
        'password',
        'birthdate',
    ];

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isOwner()
    {
        return $this->role === 'owner';
    }

    public function isTenant()
    {
        return $this->role === 'tenant';
    }

    public function accommodations(): HasMany
    {
        return $this->hasMany(Accommodation::class);
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(AccommodationReservation::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [];
    }
}