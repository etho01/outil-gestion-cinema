<?php

namespace App\Models\api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class demandeFilm extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_site_id',
        'id_imdb',
    ];
}
