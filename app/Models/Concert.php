<?php

namespace App\Models;

use Database\Factories\ConcertFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concert extends Model
{
    /** @use HasFactory<ConcertFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'date',
        'venue',
        'price',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];
}
