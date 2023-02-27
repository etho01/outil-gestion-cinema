<?php

namespace App\Models\cinema;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilmSeanceStockageElement extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'film_sceance_id',
        'stockage_element_id',
   ];

   protected $table = 'film_sceances_elements';

   public function del(){
    $this->delete();
   }

   public static function getJointureElementStockage(){
    return FilmSeanceStockageElement::join('stockage_elements', 'stockage_elements.id', '=', 'film_sceances_elements.stockage_element_id');
   }

}
