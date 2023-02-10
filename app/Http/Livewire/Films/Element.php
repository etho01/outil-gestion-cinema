<?php

namespace App\Http\Livewire\Films;

use Livewire\Component;
use App\Models\film\Film;
use App\Models\cinema\Cinema;

class Element extends Component
{

    public $idElement;
    public $idCinema;
    public $idClient;

    public $nom;

    private $distributeur;

    public function mount($idElement, $idCinema){
        $this->idElement = $idElement;
        $this->idCinema = $idCinema;

        $this->idClient = Cinema::find($idCinema)->client_id;

        if ($idElement != 0){ // si ne crée pas
            $this->distributeur = Film::find($this->idElement);
        }
    }

    public function render()
    {
        return view('livewire.films.element');
    }
}
