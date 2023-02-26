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

}
