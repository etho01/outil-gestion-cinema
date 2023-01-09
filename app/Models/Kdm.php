<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kdm extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'combinaison_option_id',
        'date_debut',
        'date_fin'
   ];
}
