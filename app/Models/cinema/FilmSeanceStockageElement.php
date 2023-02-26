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
}
