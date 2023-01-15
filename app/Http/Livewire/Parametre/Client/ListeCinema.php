<?php

namespace App\Http\Livewire\Parametre\Client;

use Livewire\Component;
use App\Models\cinema\Salle;
use App\Models\cinema\Cinema;

class ListeCinema extends Component
{
    public $idClient;
    public $ListeCinema = array();
    public $valueCinema = array();
    public $valueSalle = array();

    public function mount($idClient){
        $this->idClient = $idClient;
        $LISTE_CINEMA = Cinema::where('client_id', $idClient)->get();
        foreach ($LISTE_CINEMA as $CINEMA){
            $this->ListeCinema[$CINEMA->id] = array();
            $this->valueCinema[$CINEMA->id] = $CINEMA->nom;
            $LISTE_SALLE = Salle::where('cinema_id', $CINEMA->id)->get();
            foreach ($LISTE_SALLE as $SALLE){
                $this->ListeCinema[$CINEMA->id][$SALLE->id] = 'salle';
                $this->valueSalle[$CINEMA->id][$SALLE->id] = $SALLE->nom;
            }
        }
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
