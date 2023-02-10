<?php

namespace App\Http\Livewire\Films;

use App\Models\film\Film;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Liste extends Component
{
    protected $infosPage;
    public $slug_cinema;
    public $idClient;
    public $idCinema;

    public $livewireObject = "films";
    public $elementUpdate = -1;

    public $filtreSalle;

    public $filtreNom;

    public function mount($infosPage){
        $this->infosPage = $infosPage;
        $this->slug_cinema = $infosPage->getSlugCinema();
        $this->idClient = $infosPage->instanceCinema()->client_id;
        $this->idCinema = $infosPage->instanceCinema()->id;
    }

    public function render()
    {
        return view('livewire.films.liste', [
            'films' => $this->getPaginate(),
            'livewireObject' => $this->livewireObject,
            'elementUpdate' => $this->elementUpdate,
            'infostable' => [
                'nom' =>  [ 'nom_col' => 'Nom du films' ],
            ],
            'filtre' => [

                ['type' => 'text', 'champLivewire' => 'filtreNom', 'placeholder' => 'Nom du film', 'label' => 'Nom du films', 'name' => 'nom', 'class' => 'col-9'],

            ]
        ]);
    }

    public function update($id){
        $this->elementUpdate = $id;
        $this->dispatchBrowserEvent('showModal'.$this->livewireObject.$id);
    }

    public function delete($id){
        Film::find($id)->del();
    }

    public function getPaginate(){
        $paginate = DB::table('films');
        $paginate->where(function ($query){
            $query->where('nom', 'like', '%'.$this->filtreNom.'%');
        });
        $paginate->groupBy('films.id');
        return $paginate->paginate(30);
    }
}
