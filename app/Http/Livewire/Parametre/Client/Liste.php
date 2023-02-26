<?php

namespace App\Http\Livewire\Parametre\Client;

use Livewire\Component;
use App\Models\client\Client;
use App\Models\client\TypesClient;

class Liste extends Component
{
    public $filtreNom;
    public $filtreTypeClient = '';

    public function render()
    {
        return view('livewire.parametre.client.liste', [
            'typesclient' => $this->getPaginate(),
            'route' => 'client',
            'infostable' => [
                'nom' =>  [ 'nom_col' => 'Nom du client' ],
            ],
            'filtre' => [
                ['type' => 'select', 'champLivewire' => 'filtreTypeClient', 'elements' => TypesClient::all(), 'label' => 'Type de client', 'class' => 'col-12 col-md-2', 'name' => 'type_client',
                'defaultValue' => 0],
                ['type' => 'text', 'champLivewire' => 'filtreNom', 'placeholder' => 'Nom du type du client', 'label' => 'Nom du type du client', 'name' => 'nom', 'class' => 'col-12 col-md-10'],

            ]
        ]);
    }

    public function getPaginate(){
        $paginate = Client::where('nom', 'like', '%'.$this->filtreNom.'%');
        if ($this->filtreTypeClient != ''){
            $paginate->where('types_client_id', $this->filtreTypeClient);
        }
        return $paginate->paginate(30);
    }
}
