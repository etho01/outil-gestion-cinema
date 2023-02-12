<?php

namespace App\Http\Livewire\Utils;

use Livewire\Component;

class SelectScearch extends Component
{
    public $elements;
    public $idElement;
    public $type;

    public $idSelect = 0;

    public $filtre;
    public $foncCall;
    public $label;

    public function mount($elements, $idElement, $type, $foncCall, $label){
        $this->elements = $elements;
        $this->idElement = $idElement;
        $this->type = $type;

        $this->foncCall = $foncCall;
        $this->label = $label;
    }

    public function render()
    {
        if ($this->filtre == ""){
            $elements_filtre = $this->elements;
        } else {
            $tab_filtre = [];
            foreach ($this->elements as $element){
                if (str_contains($element->nom, $this->filtre)){
                    $tab_filtre[] = $element;
                }
            }
            $elements_filtre = collect($tab_filtre);
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
