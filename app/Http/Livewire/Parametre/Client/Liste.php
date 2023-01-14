<?php

namespace App\Http\Livewire\Parametre\Client;

use Livewire\Component;
use App\Models\client\Client;
use App\Models\client\TypesClient;

class Liste extends Component
{
    public $filtreNom;

    public function render()
    {
        return view('livewire.parametre.client.liste', [
            'typesclient' => Client::where('nom', 'like', '%'.$this->filtreNom.'%')->paginate(30),
            'route' => 'client',
            'infostable' => [
                'nom' => 'nom du client'
            ],
            'filtre' => [
                ['type' => 'text', 'champLivewire' => 'filtreNom', 'placeholder' => 'nom du type du client', 'label' => 'nom du client', 'name' => 'nom', 'class' => 'col-10'],
                ['type' => 'select', 'champLivewire' => 'filtreTypeClient', 'elements' => TypesClient::all(), 'label' => 'type de client', 'class' => 'col-2', 'name' => 'type_client',
                'defaultValue' => 0]
            ]
        ]);
    }
}
