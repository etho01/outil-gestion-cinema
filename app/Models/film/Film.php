<?php

namespace App\Models\film;

use App\utils\api\IMDB;
use App\Models\cinema\Sceance;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Film extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'distributeur_id',
        'durree',
        'nom',
        'nom_film',
        'id_imdb',
        'option_son',
        'option_image',
        'cinema_id',
   ];

   public static function getFilmAffiche($idCinema, $hideNoShowSite = true){
        $tabElementSup = ['adult', 'budget', 'homepage', 'original_language',
        'original_title', 'status', 'video', 'spoken_languages', 'production_countries',
        'production_companies', 'backdrop_path', 'getSeancesOrderByFilms', 'revenue',
        'poster_path', 'belongs_to_collection'];

        $urlImagePath = IMDB::getBaseUrlImage();

        $listesFilm = Sceance::getBaseRqWithFilm($idCinema, $hideNoShowSite)->groupBy('films.id_imdb')->select('films.id_imdb')->get();
        $tab = array();
        foreach ($listesFilm as $film){
            $infosFilm = IMDB::getInfosFilm($film->id_imdb);
            $infosFilm['poster'] = $urlImagePath.$infosFilm['poster_path'];
            foreach ($tabElementSup as $element){
                unset($infosFilm[$element]);
            }
            $tab[] = $infosFilm;
        }
        return $tab;
    }

    public function del(){
        $filmsSeance = filmSceance::where('film_id', $this->id)->get();
        foreach ($filmsSeance as $filmSeance){
            $filmSeance->del();
        }
        $this->delete();
    }
}
