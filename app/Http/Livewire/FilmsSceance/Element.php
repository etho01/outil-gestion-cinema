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
    // variables sur la page
    public $idElement;
    public $idCinema;
    public $idClient;
    public $typeElement;

    // variable sur l'element
    public $nomFilmSceance;
    public $filtreDim;
    public $filtreLangue;

    public $idFilmVersion;

    public $id_film_imdb = 0;
    public $nom_film_version = "";

    public $isUpdated;

    // initisalisation de l'element
    public function mount($idCinema, $typeElement = '', $isUpdated = false){
        $this->idCinema = $idCinema;
        $this->typeElement = $typeElement;

        $this->isUpdated = $isUpdated;

        $this->setValueElement(0,0);
    }

    // change les valeurs en fonction de l'element chargé
    public function setValueElement($idElement, $idBase){
        // initialise les variable a null
        $this->idElement = $idElement;
        $this->nomFilmSceance = null;
        $this->filtreDim = null;
        $this->filtreLangue = null;
        $this->idFilmVersion = null;
        $this->id_film_imdb = null;
        $this->nom_film_version = null;

        if ($idElement > 0){ // si element existe deja recuperation des infos
            $filmSceance = filmSceance::find($idElement);

            $this->nomFilmSceance = $filmSceance->nom;
            $this->filtreDim = $filmSceance->option_dimention;
            $this->filtreLangue = $filmSceance->option_langue;
            $this->idFilmVersion = $filmSceance->film_id;
            $film = Film::find($this->idFilmVersion);
            $this->id_film_imdb = $film->id_imdb;
            $this->nom_film_version = $film->nom;
        }

        // set les information si ajout depuis un element enfant
        if ($idBase != '' && $idBase != 0){
            $this->idFilmVersion = $idBase;
            $film = Film::find($idBase);
            $this->id_film_imdb = $film->id_imdb;
            $this->nom_film_version = $film->nom;
        }
    }

    // rules sur les champs
    protected $rules = [
        'nomFilmSceance' => 'required',
        'filtreDim' => 'required',
        'filtreLangue' => 'required',
        'idFilmVersion' => 'required'
    ];

    // message d'erreur
    protected $messages = [
        'nomFilmSceance.required' => 'Le nom du format de la séance ne doit pas etre null',
        'filtreDim.required' => 'La dimmention de la seance ne doit pas etre null',
        'filtreLangue.required' => 'La langue du film ne doit pas etre null',
        'idFilmVersion.required' => "Le nom de la version du film ne doit pas etre null "
    ];

    // ecoute l'event showElement pour charger un autre element
    protected $listeners = ['showElementfilms_sceance' => 'setValueElement'];

    // fonction change la version du film
    public function updateFilmBase($idFilmVersion){
        $this->idFilmVersion = $idFilmVersion;
        $this->dispatchBrowserEvent('updateFilmSeance'.$this->idElement);
        if ($this->idFilmVersion != 0){
            $film = Film::find($idFilmVersion);
            $this->id_film_imdb = $film->id_imdb;
            $this->nom_film_version = $film->nom;
        } else {
            $this->id_film_imdb = 0;
            $this->nom_film_version = "";
        }
        if ($this->idFilmVersion == 0){
            $this->idFilmVersion = null;
        }
    }

    // save les modifications
    public function save(){
        $this->validate();
        if ($this->isUpdated){
            $this->emit('updateFilmSeance');
            $this->dispatchBrowserEvent('updateFilmSeance'.$this->idElement);
            $this->dispatchBrowserEvent('elementUpdated');
        } else {
            $this->emit('saveElement');
        }
        $this->dispatchBrowserEvent('hideModal'.$this->typeElement);
        $film = filmSceance::find($this->idElement);
        $film->update([
            'option_langue' => $this->filtreLangue,
            'option_dimention' => $this->filtreDim,
            'film_id' => $this->idFilmVersion,
            'nom' => $this->nomFilmSceance
        ]);

    }

    // crée l'element
    public function create(){
        $this->validate();
        if ($this->isUpdated){
            $this->emit('updateFilmSeance');
            $this->dispatchBrowserEvent('elementUpdated');
        } else {
            $this->emit('saveElement');
        }
        $this->dispatchBrowserEvent('hideModal'.$this->typeElement);
        filmSceance::create([
            'option_langue' => $this->filtreLangue,
            'option_dimention' => $this->filtreDim,
            'film_id' => $this->idFilmVersion,
            'nom' => $this->nomFilmSceance,
            'cinema_id' => $this->idCinema
        ]);
    }

    //rendu 
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
