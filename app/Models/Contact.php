<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'firstname',
        'lastname',
        'phone',
        'message',
        'is_read'
    ];

    protected $attributes = [
        'is_read' => false,
    ];
}
