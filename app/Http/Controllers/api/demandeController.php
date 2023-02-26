<?php

namespace App\Http\Controllers\api;

use App\utils\api\IMDB;
use App\Models\api\userSite;
use Illuminate\Http\Request;
use App\Models\api\demandeFilm;
use App\Http\Controllers\Controller;

class demandeController extends Controller
{
    function demande(Request $request, $idCinema, $tokenUser){
        $usersite = userSite::where('api_token', $tokenUser)->first();
        if ($usersite == null){ // verification si l'user exist
            return response()->json([
                'message' => 'user don\t exist'
            ], 403);
        }

        if (demandeFilm::where('user_site_id', $usersite->id)->where('id_imdb', $request->id_film)->first() != null){
            return response()->json([ // si la demande n'a pas deja etait faite
                'message' => 'demande already exist'
            ], 403);
        }

        demandeFilm::create([
            'user_site_id' => $usersite->id,
            'id_imdb' => $request->id_film
        ]);
    }

    function getListFilm(Request $request){
        $tabColHide = ['adult', 'genre_ids', 'original_language', 'original_title', 'poster_path',
    'video']; // collonne imbd a enlevé
        $urlImagePath = IMDB::getBaseUrlImage();

        $arrayFilms = IMDB::getListeMovie($request->nom_film); // get la liste des films
        foreach ($arrayFilms as $key => $film){
            $arrayFilms[$key]['poster'] = $urlImagePath . $film['poster_path']; // ajout le lien de l'affiche
            foreach ($tabColHide as $colHide){ // supprime les collones
                unset($arrayFilms[$key][$colHide]);
            }
            if (!str_contains($film['title'], $request->nom_film)){ // enleve le film si la selection n'est pas dans le titre
                unset($arrayFilms[$key]);
            }

        }
        return $arrayFilms;
    }
}
