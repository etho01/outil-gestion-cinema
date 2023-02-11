<?php

namespace App\Http\Livewire\Films\Element;

use App\utils\api\IMDB;
use Livewire\Component;

class ListeFilm extends Component
{
    public $nom;

    public $idElement;

    public function mount($idElement){
        $this->idElement = $idElement;
    }

    public function render()
    {
        return view('livewire.films.element.liste-film',[
            'sizeNom' => strlen($this->nom),
            'films' => strlen($this->nom) >= 4 ? IMDB::getListeMovie($this->nom) : [],
            'idElement' => $this->idElement
        ]);
    }

    public function refresh($id){
        $this->emit('refreshVersionMovie', $id);
    }
}
