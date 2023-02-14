<?php

namespace App\Http\Livewire\FilmsSceance;

use App\utils\api\IMDB;
use Livewire\Component;
use App\Models\film\Option;
use App\Models\cinema\Cinema;
use App\Models\film\Film;
use App\Models\film\filmSceance;

class Element extends Component
{
    public $idElement;
    public $idCinema;
    public $idClient;
    public $typeElement;

    public $nomFilmSceance;
    public $filtreDim;
    public $filtreLangue;

    public $idFilmVersion = 0;

    public $id_film_imdb = 0;
    public $nom_film_version = "";

    public function mount($idElement, $idCinema, $typeElement = ''){
        $this->idElement = $idElement;
        $this->idCinema = $idCinema;
        $this->typeElement = $typeElement;

        $this->idClient = Cinema::find($idCinema)->client_id;
        if ($idElement > 0){
            $filmSceance = filmSceance::find($idElement);

            $this->nomFilmSceance = $filmSceance->nom;
            $this->filtreDim = $filmSceance->option_dimention;
            $this->filtreLangue = $filmSceance->option_langue;
            $this->idFilmVersion = $filmSceance->film_id;
            $film = Film::find($this->idFilmVersion);
            $this->id_film_imdb = $film->id_imdb;
            $this->nom_film_version = $film->nom;
        }

    }

    protected $rules = [
        'nomFilmSceance' => 'required',
        'filtreDim' => 'required',
        'filtreLangue' => 'required',
    ];

    public function updateFilmBase($idFilmVersion){
        $this->idFilmVersion = $idFilmVersion;
        if ($this->idFilmVersion != 0){
            $film = Film::find($idFilmVersion);
            $this->id_film_imdb = $film->id_imdb;
            $this->nom_film_version = $film->nom;
        } else {
            $this->id_film_imdb = 0;
            $this->nom_film_version = "";
        }
    }

    public function save(){
        $this->validate();
        $this->emit('saveElement');
        $this->dispatchBrowserEvent('hideModal'.$this->typeElement.$this->idElement);
        $film = filmSceance::find($this->idElement);
        $film->update([
            'option_langue' => $this->filtreLangue,
            'option_dimention' => $this->filtreDim,
            'film_id' => $this->idFilmVersion,
            'nom' => $this->nomFilmSceance
        ]);

    }

    public function create(){
        $this->validate();
        $this->emit('saveElement');
        $this->dispatchBrowserEvent('hideModal'.$this->typeElement.$this->idElement);
        filmSceance::create([
            'option_langue' => $this->filtreLangue,
            'option_dimention' => $this->filtreDim,
            'film_id' => $this->idFilmVersion,
            'nom' => $this->nomFilmSceance,
            'cinema_id' => $this->idCinema
        ]);
    }

    public function render()
    {
        return view('livewire.films-sceance.element',[
            'idElement' => $this->idElement,
            'urlImage' => IMDB::getUrlImage($this->id_film_imdb),
            'listeLangue' => Option::getElmentByType(1),
            'listeDim' => Option::getElmentByType(2),
            'listeFilmBase' => Film::where('cinema_id', $this->idCinema)->get(),
            'nomFilmVersion' => $this->nom_film_version,
            'idFilmVersion' => $this->idFilmVersion,
            'idCinema' => $this->idCinema,
            'typeElement' => $this->typeElement,
            'IdElementSelect' => $this->idFilmVersion
        ]);
    }
}
