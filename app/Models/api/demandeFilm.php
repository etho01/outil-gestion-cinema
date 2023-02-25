<?php

namespace App\Models\api;

use App\utils\api\IMDB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class demandeFilm extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_site_id',
        'id_imdb',
    ];

    public function getNomFilm(){
        return IMDB::getInfosFilm($this->id_imdb)['title'];
    }

    public function getNombreDemande($idCinema){
        return demandeFilm::join('user_sites', 'demande_films.user_site_id', '=', 'user_sites.id')
        ->where('user_sites.cinema_id', $idCinema)->groupBy('demande_films.id_imdb')
        ->where('id_imdb', $this->id_imdb)->count();
    }
}
