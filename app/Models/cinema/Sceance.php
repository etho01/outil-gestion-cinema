<?php

namespace App\Models\cinema;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sceance extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'salle_id',
        'film_sceance_id',
        'date_seance',
        'is_visible_site'
    ];

    public static function getBaseRqWithFilm($idCinema ,$hideNoShowSite = true){
        $baseEloquent = DB::table('films')->join('film_sceances', 'films.id', '=' , 'film_sceances.film_id')
        ->join('sceances', 'sceances.film_sceance_id' ,'=' ,'film_sceances.id')->where('films.cinema_id', $idCinema)->orderBy('sceances.date_seance')
        ->whereDate('sceances.date_seance', '>=', Carbon::today()->toDateString());
        if ($hideNoShowSite) $baseEloquent = Sceance::addFiltreVisibleSite($baseEloquent);
        return  $baseEloquent;
    }

    public static function addFiltreVisibleSite($eloquent){
        return $eloquent->where('is_visible_site', 2);
    }

    public function del(){
        $this->delete();
    }

    public function StatutFilm(){
        if ( FilmSeanceStockageElement::getJointureElementStockage()->where('stockage_elements.salle_id', $this->salle_id)
        ->where('film_sceances_elements.film_sceance_id', $this->film_sceance_id)->where('stockage_elements.type', config('cinema.TYPE_STOCKAGE.SERVEUR'))->first() != null){
            return config('cinema.STATUT.FILM.2');
        } else if (
            FilmSeanceStockageElement::getJointureElementStockage()
        ->where('film_sceances_elements.film_sceance_id', $this->film_sceance_id)->first() != null
        ){
            return config('cinema.STATUT.FILM.1');
        } else {
            return config('cinema.STATUT.FILM.0');
        }
    }

   public function StatutKdm(){
    if (count( DB::select('SELECT * from sceances s 
        join kdms k on k.film_sceance_id = s.film_sceance_id AND k.salle_id = s.salle_id
        WHERE s.date_seance between k.date_debut and k.date_fin AND s.id = '.$this->id)) == 0){
            return 'PAS DE KDM';
        } else {
            return 'KDM CHARGER';
        }
   }


}
