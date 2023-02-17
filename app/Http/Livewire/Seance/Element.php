<?php

namespace App\Http\Livewire\Seance;

use App\utils\api\IMDB;
use Livewire\Component;
use App\Models\cinema\Salle;
use App\Models\cinema\Cinema;
use App\Models\cinema\Sceance;
use App\Models\film\Film;
use App\Models\film\filmSceance;
use App\utils\form\OptionForm;

class Element extends Component
{
    public $idElement;
    public $idCinema;
    public $typeElement;

    public $nomFilmSceance;
    public $idFilmSceance;

    public $dateSeance;
    public $heureSeance;

    public $isVisibleSite;

    public $salleId;

    public function mount($idElement, $idCinema,$idBase , $typeElement = ''){
        $this->idElement = $idElement;
        $this->idCinema = $idCinema;
        $this->typeElement = $typeElement;

        if ($idElement > 0){
            $seance = Sceance::find($idElement);
            $tab_date = explode(' ', $seance->date_seance);
            $this->dateSeance = $tab_date[0];
            $this->heureSeance = $tab_date[1];

            $this->isVisibleSite = $seance->is_visible_site;
            $this->salleId = $seance->salle_id;
            
            $film = filmSceance::find($seance->film_sceance_id);
            $this->idFilmSceance = $film->id;
            $this->nomFilmSceance = $film->nom;
        }

        if ($idBase != 0){
            $this->idFilmSceance = $idBase;
            $film = filmSceance::find($idBase);
            $this->nomFilmSceance = $film->nom;
        }

    }

    protected $rules = [
        'dateSeance' => 'required|date',
        'heureSeance' => 'required',
        'salleId' => 'required',
        'isVisibleSite' => 'required'
    ];

    function save(){
        $this->validate();
        $this->emit('saveElement');
        $this->dispatchBrowserEvent('hideModal'.$this->typeElement.$this->idElement);
        $seance = Sceance::find($this->idElement);
        $seance->update([
            'date_seance' => $this->dateSeance.' '.$this->heureSeance,
            'film_sceance_id' => $this->idFilmSceance,
            'salle_id' => $this->salleId,
            'is_visible_site' => $this->isVisibleSite
         ]);
    }

    function create(){
        $this->validate();
        $this->emit('saveElement');
        $this->dispatchBrowserEvent('hideModal'.$this->typeElement.$this->idElement);
        Sceance::create([
           'date_seance' => $this->dateSeance.' '.$this->heureSeance,
           'film_sceance_id' => $this->idFilmSceance,
           'salle_id' => $this->salleId,
           'is_visible_site' => $this->isVisibleSite
        ]);
    }

    public function updateFilmSceance($id){
        $film = filmSceance::find($id);
        $this->idFilmSceance = $film->id;
        $this->nomFilmSceance = $film->nom;
    }

    public function render()
    {
        $urlImage = "";
        if ($this->idElement != 0){
            $filmSeance = filmSceance::find(Sceance::find($this->idElement)->film_sceance_id);
            $film = Film::find($filmSeance->film_id);
            $urlImage = IMDB::getUrlImage($film->id_imdb);
        }
        return view('livewire.seance.element', [
            'typeElement' => $this->typeElement,
            'idElement' => $this->idElement,
            'nomFilmSceance' => $this->nomFilmSceance,
            'idCinema' => $this->idCinema,
            'idFilmSceance' => $this->idFilmSceance,
            'urlImage' => $urlImage,
            'salles' => Salle::where('cinema_id', $this->idCinema)->get(),
            "salleActuel" => $this->salleId,
            'OptionOuiNon' => OptionForm::getOptionOuiNon(),
            'isVisibleSite' => $this->isVisibleSite,
            "salleActuel" => $this->salleId
        ]);
    }
}
