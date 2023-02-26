<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Models\cinema\Sceance;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\film\Film;
use App\utils\api\IMDB;

class seanceContolleur extends Controller
{
    public function getSeances(){

    }

    public function getSeancesOrderByFilms(Request $request, $idCinema){
        $tabFilm = Film::getFilmAffiche($idCinema); // selectionne les films a l'affiche
        foreach($tabFilm as $key => $film){
            $infosSeance = 
            Sceance::getBaseRqWithFilm($idCinema)->where('films.id_imdb', $film['id'])
            ->select('sceances.date_seance')->get(); // ajoute les seance
            $tabFilm[$key]['seances'] = $infosSeance;
        }
        return $tabFilm;
    }
}
