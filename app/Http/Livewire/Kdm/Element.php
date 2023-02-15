<?php

namespace App\Http\Livewire\Kdm;

use Livewire\Component;
use App\Models\film\Kdm;
use App\Models\cinema\Salle;
use App\Models\cinema\Cinema;
use App\Models\film\filmSceance;

class Element extends Component
{
    public $idElement;
    public $idCinema;
    public $idClient;
    public $typeElement;

    public $nomFilmSceance;
    public $idFilmSceance = 0;

    public $dateDebut;
    public $dateFin;
    public $idSalle;

    public function mount($idElement, $idCinema,$idBase , $typeElement = ''){
        $this->idElement = $idElement;
        $this->idCinema = $idCinema;
        $this->typeElement = $typeElement;

        $this->idClient = Cinema::find($idCinema)->client_id;
        if ($idElement > 0){
            $kdm = Kdm::find($idElement);

            $this->dateDebut = $kdm->date_debut;
            $this->dateFin = $kdm->date_fin;
            $this->idSalle = $kdm->salle_id;
            
            $film = filmSceance::find($kdm->film_sceance_id);
            $this->idFilmSceance = $film->id;
            $this->nomFilmSceance = $film->nom;
        }

        if ($idBase != 0){
            $this->idFilmSceance = $idBase;
            $film = filmSceance::find($idBase);
            $this->nomFilmSceance = $film->nom;
        }

    }

    function updateFilmSceance($id){
        $film = filmSceance::find($id);
        $this->idFilmSceance = $film->id;
        $this->nomFilmSceance = $film->nom;
    }

    protected $rules = [
        'dateDebut' => 'required|date',
        'dateFin' => 'required|date',
    ];

    function save(){
        $this->validate();
        $this->emit('saveElement');
        $this->dispatchBrowserEvent('hideModal'.$this->typeElement.$this->idElement);
        $kdm = Kdm::find($this->idElement);
        $kdm->update([
            'date_debut' =>  $this->dateDebut,
            'date_fin' => $this->dateFin,
            'film_sceance_id' => $this->idFilmSceance,
            'salle_id' => $this->idSalle
        ]);
    }

    function create(){
        $this->validate();
        $this->emit('saveElement');
        $this->dispatchBrowserEvent('hideModal'.$this->typeElement.$this->idElement);
        Kdm::create([
           'date_debut' =>  $this->dateDebut,
           'date_fin' => $this->dateFin,
           'film_sceance_id' => $this->idFilmSceance,
           'salle_id' => $this->idSalle
        ]);
    }

    public function render()
    {
        return view('livewire.kdm.element', [
            'typeElement' => $this->typeElement,
            'idElement' => $this->idElement,
            'nomFilmSceance' => $this->nomFilmSceance,
            'idFilmSceance' => $this->idFilmSceance,
            'salles' => Salle::where('cinema_id', $this->idCinema)->get()
        ]);
    }
}
