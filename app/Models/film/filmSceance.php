<?php

namespace App\Models\film;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class filmSceance extends Model
{
    use HasFactory;

        protected $fillable = [
        'id',
        'film_id',
        'option_langue',
        'option_dimention',
        'nom',
        'cinema_id'
   ];
}
