<?php

namespace App\Models\cinema;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salle extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nom',
        'cinema_id',
        'slug'
    ];
}
