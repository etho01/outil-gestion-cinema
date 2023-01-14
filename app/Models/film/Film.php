<?php

namespace App\Models\film;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'distributeur_id',
        'durree',
        'slug'
   ];
}
