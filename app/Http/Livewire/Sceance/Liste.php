<?php

namespace App\Http\Livewire\Sceance;

use Livewire\Component;
use App\utils\form\OptionForm;
use App\Models\cinema\Cinema;
use App\Models\cinema\Sceance;

class Liste extends Component
{
    protected $infosPage;
    public $slug_cinema;
    public $idClient;

    public $filtreSalle;

    public function mount($infosPage){
        $this->infosPage = $infosPage;
        $this->slug_cinema = $infosPage->getSlugCinema();
        $this->idClient = $infosPage->instanceCinema()->client_id;
    }
    public function render()
    {
        return view('livewire.sceance.liste', [
            'sceance' => $this->getPaginate(),
            'infostable' => [
            ],
            'filtre' => [
                ['type' => 'select', 'champLivewire' => 'filtreSalle', 
                'elements' => Cinema::where('slug', $this->slug_cinema)->first()->salles()->get(),
                 'label' => 'Cinema accesible', 'class' => 'col-2', 'name' => 'cinema',
                'defaultValue' => 0],

                ['type' => 'select', 'champLivewire' => 'isAdmin', 
                'elements' => OptionForm::getOptionOuiNon(),
                 'label' => 'Est admin', 'class' => 'col-1', 'name' => 'cinema',
                'defaultValue' => 0],

                ['type' => 'select', 'champLivewire' => 'isValidate', 
                'elements' => OptionForm::getOptionOuiNon(),
                 'label' => 'Est valide', 'class' => 'col-1', 'name' => 'cinema',
                'defaultValue' => 0],

                ['type' => 'text', 'champLivewire' => 'filtreNom', 'placeholder' => 'nom du type du client', 'label' => 'nom du client', 'name' => 'nom', 'class' => 'col-8'],

            ]
        ]);
    }

    public function getPaginate(){
        $paginate = Sceance::whereDate('date_sceance', '>=', 'now()');
        if ($this->filtreSalle) $paginate->where('salle_id', $this->filtreSalle);
        $paginate->groupBy('sceances.id');
        return $paginate->paginate(30);
    }
}
