<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CombinaisonOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'film_id',
        'option_id',
   ];
}
