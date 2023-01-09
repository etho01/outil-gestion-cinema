<?php

namespace App\Models\cinema;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CombinaisonOptions_stockageElement extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'stockage_element_id',
        'combinaison_option_id',
   ];

   protected $table = 'combinaison_stockage_elements';
}
