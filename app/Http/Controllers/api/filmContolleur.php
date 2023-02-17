<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\film\Film;
use Illuminate\Http\Request;

class filmContolleur extends Controller
{
    public function getAffiche(Request $request, $idCinema){
        return Film::getFilmAffiche($idCinema);
    }
}
