<?php

namespace App\Http\Livewire\Utils;

use Livewire\Component;
use App\Models\film\Film;
use App\Models\film\filmSceance;

class SelectScearch extends Component
{
    public $idElement;
    public $type;
    public $idCinema;

    public $idSelect = 0;

    public $filtre;
    public $foncCall;
    public $label;

    protected $listeners = [
        "updateFilmSeance" => 'updateElementFilmSeance',
        "updateFilm" => 'updateElementFilm'
    ];

    public function updateElementFilmSeance(){
        if ($this->type == 'films_sceance'){ // si du selecteur d'une version de seance du film

        }
    }

    public function updateElementFilm(){
        if ($this->type == 'Film'){ // si du selecteur de version de seance du film

        }
    }

    public function mount($idElement, $type, $foncCall, $label, $idCinema, $idElementPopUp){
        $this->idElement = $idElement;
        $this->type = $type;

        $this->foncCall = $foncCall;
        $this->label = $label;

        $this->idCinema = $idCinema;

        $this->idSelect = $idElementPopUp;
    }

    public function render()
    {
        if ($this->type == 'films'){
            $elements_filtre = Film::where('nom','like', '%'.$this->filtre."%")->where('cinema_id', $this->idCinema)->get();
        } else if ($this->type == 'films_sceance'){
            $elements_filtre = filmSceance::where('nom','like', '%'.$this->filtre."%")->where('cinema_id', $this->idCinema)->get();
        }
        
        return view('livewire.utils.select-scearch',[
            'elementsFiltre' => $elements_filtre,
            'idElement' => $this->idElement,
            'type' => $this->type,
            'filtre' => $this->filtre,
            'label' => $this->label,
            'idSelect' => $this->idSelect
        ]);
    }

    public function refresh($id){
        $this->idSelect = $id;
    }
}
