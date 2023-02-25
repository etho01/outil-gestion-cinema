<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use App\utils\form\OptionForm;
use App\Models\cinema\Cinema;

class Liste extends Component
{
    protected $infosPage;
    public $slug_cinema;
    public $idClient;

    public $filtreCinema;
    public $isAdmin;
    public $isValidate;

    public $filtreNom;

    public function mount($infosPage){
        $this->infosPage = $infosPage;
        $this->slug_cinema = $infosPage->getSlugCinema();
        $this->idClient = $infosPage->instanceCinema()->client_id;
    }

    public function render()
    {

        return view('livewire.user.liste', [
            'users' => $this->getPaginate(),
            'route' => 'user',
            'infostable' => [
                'nom' =>  [ 'nom_col' => 'nom du l\'utilisateur' ],
                'email' =>  [ 'nom_col' => 'email de l\'utilisateur' ],
                'is_validate' => ['nom_col' => 'est validé' , 'datas' => OptionForm::getOptionOuiNon()->all()]
            ],
            'filtre' => [
                ['type' => 'select', 'champLivewire' => 'filtreCinema', 
                'elements' => Cinema::where('client_id', $this->idClient)->get(),
                 'label' => 'Cinema accesible', 'class' => 'col-12 col-md-2', 'name' => 'cinema',
                'defaultValue' => 0],

                ['type' => 'select', 'champLivewire' => 'isAdmin', 
                'elements' => OptionForm::getOptionOuiNon(),
                 'label' => 'Est admin', 'class' => 'col-12 col-md-1', 'name' => 'cinema',
                'defaultValue' => 0],

                ['type' => 'select', 'champLivewire' => 'isValidate', 
                'elements' => OptionForm::getOptionOuiNon(),
                 'label' => 'Est valide', 'class' => 'col-12 col-md-1', 'name' => 'cinema',
                'defaultValue' => 0],

                ['type' => 'text', 'champLivewire' => 'filtreNom', 'placeholder' => 'nom du type du client', 'label' => 'nom du client', 'name' => 'nom', 'class' => 'col-12 col-md-8'],

            ]
        ]);
    }

    public function getPaginate(){
        $paginate = User::where(function ($query){
            $query->where('users.nom', 'like', '%'.$this->filtreNom.'%');
            $query->orwhere('users.email', 'like', '%'.$this->filtreNom.'%');
        });

        if ($this->isAdmin || $this->filtreCinema){
            $paginate->join('users_roles', 'users.id', '=', 'users_roles.user_id');
            $paginate->join('roles', 'users_roles.role_id', '=', 'roles.id');
            if ($this->filtreCinema){
                $paginate->join('roles_pages', 'roles.id', '=', 'roles_pages.role_id')->where('cinema_id', $this->filtreCinema);
            }
            if ($this->isAdmin){
                if ($this->isAdmin == 1 || $this->isAdmin == 2){
                    $paginate->where('roles.is_admin', $this->isAdmin);
                }
            }
        }

        if ($this->isValidate == 1 || $this->isValidate == 2){
            $paginate->where('users.is_validate', $this->isValidate);
        }

        $paginate->groupBy('users.id');
        return $paginate->paginate(30);
    }
}
