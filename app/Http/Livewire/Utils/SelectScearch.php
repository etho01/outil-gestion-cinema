<?php

namespace App\Http\Livewire\Utils;

use Livewire\Component;
use App\Models\film\Film;

class SelectScearch extends Component
{
    public $idElement;
    public $type;
    public $idCinema;

    public $idSelect = 0;

    public $filtre;
    public $foncCall;
    public $label;

    public function mount($idElement, $type, $foncCall, $label, $idCinema){
        $this->idElement = $idElement;
        $this->type = $type;

        $this->foncCall = $foncCall;
        $this->label = $label;
    }

    public function render()
    {
        if ($this->type == 'films'){
            $elements_filtre = Film::where('nom','like', '%'.$this->filtre."%")->where('cinema_id', $this->idCinema)->get();
        }
        
        return view('livewire.utils.select-scearch',[
            'elementsFiltre' => $elements_filtre,
            'idElement' => $this->idElement,
            'type' => $this->type,
            'filtre' => $this->filtre,
            'label' => $this->label
        ]);
    }

    public function refresh($id){
        $this->idSelect = $id;
    }
}
