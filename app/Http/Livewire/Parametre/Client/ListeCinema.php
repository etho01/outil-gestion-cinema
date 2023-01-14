<?php

namespace App\Http\Livewire\Parametre\Client;

use Livewire\Component;

class ListeCinema extends Component
{
    public $idClient;
    public $ListeCinema = array();
    public $valueCinema = array();
    public $valueSalle = array();

    public function mount($idClient){
        $this->idClient = $idClient;
    }

    public function render()
    {
        return view('livewire.parametre.client.liste-cinema',[
            'ListeCinema' => $this->ListeCinema,
            'valueCinema' => $this->valueCinema,
            'valueSalle' => $this->valueSalle
        ]);
    }

    public function add_cinema(){
        $this->ListeCinema[] = array();
    }

    public function add_salle($idCinema){
        $this->ListeCinema[$idCinema][] = 'd';
    }

    public function supp_cinema($idCinema){
        unset($this->ListeCinema[$idCinema]);
    }

    public function supp_salle($idCinema, $idSalle){
        unset($this->ListeCinema[$idCinema][$idSalle]);
    }
}
