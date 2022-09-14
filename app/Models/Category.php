<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function movies()
    {
        // ONE category TO MANY movie
        return $this->hasMany(Movie::class);
    }
}
