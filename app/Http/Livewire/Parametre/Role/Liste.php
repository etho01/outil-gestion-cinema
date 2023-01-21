<?php

namespace App\Http\Livewire\Parametre\Role;

use Livewire\Component;
use App\Models\user\Role;
use App\utils\form\Option;
use App\Models\cinema\Salle;
use App\Models\cinema\Cinema;
use App\Models\client\Client;
use App\Models\client\TypesClient;

class Liste extends Component
{
    protected $infosPage;
    public $filtreNom;
    public $filtreCinema;
    public $pageAccecible;
    public $isAdmin;
    public $slug_cinema;
    public $idClient;

    public function mount($infosPage){
        $this->infosPage = $infosPage;
        $this->slug_cinema = $infosPage->getSlugCinema();
        $this->idClient = $infosPage->instanceCinema()->client_id;
    }

    public function render()
    {
        return view('livewire.parametre.role.liste', [
            'roles' => $this->getPaginate(),
            'route' => 'role',
            'infostable' => [
                'nom' =>  [ 'nom_col' => 'nom du role' ],
                'is_admin' => [ 'nom_col' => 'est administrateur',
                                'datas' => Option::getOptionOuiNon()->all()]
            ],
            'filtre' => [
                ['type' => 'select', 'champLivewire' => 'filtreCinema', 
                'elements' => Cinema::where('client_id', $this->idClient)->get(),
                 'label' => 'Cinema accesible', 'class' => 'col-2', 'name' => 'cinema',
                'defaultValue' => 0],

                ['type' => 'select', 'champLivewire' => 'isAdmin', 
                'elements' => Option::getOptionOuiNon(),
                 'label' => 'Est admin', 'class' => 'col-1', 'name' => 'cinema',
                'defaultValue' => 0],

                ['type' => 'text', 'champLivewire' => 'filtreNom', 'placeholder' => 'nom du type du client', 'label' => 'nom du client', 'name' => 'nom', 'class' => 'col-9'],

            ]
        ]);
    }
    public function getPaginate(){
        $paginate = Role::where('nom', 'like', '%'.$this->filtreNom.'%');
        if ($this->filtreCinema){
            $paginate->join('roles_pages', 'roles.id', '=', 'roles_pages.role_id')->where('cinema_id', $this->filtreCinema);
        }
        if ($this->isAdmin){
            if ($this->isAdmin == 1 || $this->isAdmin == 2){
                $paginate->where('is_admin', $this->isAdmin);
            }
        }
        $paginate->groupBy('roles.id');
        return $paginate->paginate(30);
    }
}
