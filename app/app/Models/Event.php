<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'short_description',
        'long_description',
        'date_time',
        'organizer',
        'location',
        'status',
    ];

    public function inscriptions(): HasMany
    {
        return $this->hasMany(Inscription::class);
    }
}
