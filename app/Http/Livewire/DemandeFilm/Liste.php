<?php

namespace App\Http\Livewire\DemandeFilm;
// meme modele que pour le filmSeance
use Livewire\Component;
use App\Models\api\demandeFilm;

class Liste extends Component
{
    protected $infosPage;
    public $slug_cinema;
    public $idClient;
    public $idCinema;


    public function mount($infosPage){
        $this->infosPage = $infosPage;
        $this->slug_cinema = $infosPage->getSlugCinema();
        $this->idClient = $infosPage->instanceCinema()->client_id;
        $this->idCinema = $infosPage->instanceCinema()->id;
    }

    public function render()
    {
        return view('livewire.demande-film.liste', [
            'demandes' => $this->getPaginate(),
            'infostable' => [
                '' =>  [ 'nom_col' => 'Nom du film' , 'nomfilmDemande' => ''],
                '-' => ['nom_col' => 'Nombre de demande', 'nombrefilmDemande' => ''],
            ],
        ]);
    }

    public function getPaginate(){
        return demandeFilm::join('user_sites', 'demande_films.user_site_id', '=', 'user_sites.id')
        ->where('user_sites.cinema_id', $this->idCinema)->groupBy('demande_films.id_imdb')
        ->select('demande_films.*')
        ->paginate(30);
    }
}
