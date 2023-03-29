<?php

namespace App\Models\film;

use App\Models\cinema\Sceance;
use Illuminate\Database\Eloquent\Model;
use App\Models\cinema\FilmSeanceStockageElement;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

   public function del(){
        $Kdms = Kdm::where('film_sceance_id', $this->id)->get();
        foreach ($Kdms as $Kdm){
            $Kdm->del();
        }
        $Sceances = Sceance::where('film_sceance_id', $this->id)->get();
        foreach ($Sceances as $Sceance){
            $Sceance->del();
        }
        $FilmSeanceStockageElements = FilmSeanceStockageElement::where('film_sceance_id', $this->id)->get();
        foreach ($FilmSeanceStockageElements as $FilmSeanceStockageElement){
            $FilmSeanceStockageElement->del();
        }
        $this->delete();
    }
}
