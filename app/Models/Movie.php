<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'released_at' => 'datetime',
    ];

    // Créer un accessor qui permet de transformer la durée (144)
    // en heures (2h24)
    public function duration(): Attribute
    {
        return Attribute::make(function ($value) {
            $hours = floor($value / 60); // 2h...
            $minutes = $value % 60; // ...11m
            $minutes = $minutes < 10 ? '0'.$minutes : $minutes;

            return $hours.'h'.$minutes.'m';
        });
    }

    // Ancienne méthode pour les attributs
    public function getPriceWithTaxAttribute()
    {
        return number_format(
            $this->price / 100 * (100 + 20) / 100,
            2, ',', ' '
        ).' €';
    }

    public function getPriceWithoutTaxAttribute()
    {
        return number_format(
            $this->price / 100,
            2, ',', ' '
        ).' €';
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function actors()
    {
        return $this->belongsToMany(Actor::class);
    }
}
