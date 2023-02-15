<?php

namespace App\Models\film;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kdm extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'film_sceance_id',
        'date_debut',
        'date_fin',
        'salle_id'
   ];

   function del(){
    $this->delete();
   }
}
