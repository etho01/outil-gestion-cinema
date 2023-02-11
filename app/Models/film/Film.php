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
        'slug',
        'nom',
        'nom_film',
        'id_imdb',
        'option_son',
        'option_image',
        'cinema_id',
   ];
}
