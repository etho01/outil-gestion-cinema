<?php

namespace App\Models\cinema;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sceance extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'salle_id',
        'combinaison_option_id',
        'date'
    ];

}
