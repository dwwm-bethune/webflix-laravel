<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use HasFactory;

    protected $casts = [
        'birthday' => 'date',
    ];

    public function movies()
    {
        return $this->belongsToMany(Movie::class);
    }
}
