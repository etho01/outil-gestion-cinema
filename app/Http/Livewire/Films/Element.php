<?php

namespace App\Http\Livewire\Films;

use App\utils\api\IMDB;
use Livewire\Component;
use App\Models\film\Film;
use App\Models\film\Option;
use Illuminate\Support\Str;
use App\Models\cinema\Cinema;
use App\Models\film\Distributeur;

class Element extends Component
{

    public $idElement;
    public $idCinema;
    public $idClient;

    public $nomFilm;
    public $nomVersion;
    public $distributeur;

    public $formatImage;
    public $formatSon;

    public $id_film = 0;

    public $isUpdated;

    public function mount($idElement, $idCinema, $isUpdated = false){
        $this->idElement = $idElement;
        $this->idCinema = $idCinema;

        $this->idClient = Cinema::find($idCinema)->client_id;

        $this->isUpdated = $isUpdated;

        if ($idElement != 0){ // si ne crée pas
            $film = Film::find($idElement);

            $this->formatImage = $film->option_image;
            $this->formatSon = $film->option_son;
            $this->nomFilm = $film->nom_film;
            $this->nomVersion = $film->nom;
            $this->distributeur = $film->distributeur_id;
            $this->id_film = $film->id_imdb;
        }
    }

    protected $rules = [
        'nomFilm' => 'required',
        'nomVersion' => 'required',
        'distributeur' => 'required',
    ];

    public function changeFilm($id, $nomFilm){
        $this->id_film = $id;
        $this->nomFilm = htmlspecialchars_decode($nomFilm);
    }

    public function save(){
        $this->validate();
        if ($this->isUpdated){
            $this->emit('updateFilm');
            $this->dispatchBrowserEvent('updateFilm'.$this->idElement);
            $this->dispatchBrowserEvent('elementUpdated');
        } else {
            $this->emit('saveElement');
        }
        
        $this->dispatchBrowserEvent('hideModal'.'films'.$this->idElement);
        $film = Film::find($this->idElement);
        $film->update([
            'option_image' => $this->formatImage,
            'option_son' => $this->formatSon,
            'id_imdb' => $this->id_film,
            'nom_film' => $this->nomFilm,
            'nom' => $this->nomVersion,
            'distributeur_id' => $this->distributeur,
            'cinema_id'=> $this->idCinema,
            'slug' => Str::of($this->nomVersion)
        ]);
    }

    public function create(){
        $this->validate();
        if ($this->isUpdated){
            $this->emit('updateFilm');
            $this->dispatchBrowserEvent('elementUpdated');
        } else {
            $this->emit('saveElement');
        }
        $this->dispatchBrowserEvent('hideModal'.'films'.$this->idElement);
        Film::create([
            'option_image' => $this->formatImage,
            'option_son' => $this->formatSon,
            'id_imdb' => $this->id_film,
            'nom_film' => $this->nomFilm,
            'nom' => $this->nomVersion,
            'distributeur_id' => $this->distributeur,
            'cinema_id'=> $this->idCinema,
            'slug' => Str::of($this->nomVersion)
        ]);
    }

    public function render()
    {
        return view('livewire.films.element', [
            'listeFormatSon' => Option::getElmentByType(3),
            'listeFormatImage' =>  Option::getElmentByType(4),
            'urlImage' => IMDB::getUrlImage($this->id_film),
            'nomFilm' => $this->nomFilm,
            'listeDistrib' => Distributeur::all(),
        ]);
    }
}
