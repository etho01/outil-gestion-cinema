<?php

namespace App\Http\Livewire\Parametre\Typeclient;

use Livewire\Component;
use App\Models\client\TypesClient;

class Liste extends Component
{
    public $filtreNom;

    public function render()
    {
        return view('livewire.parametre.typeclient.liste', [
            'typesclient' => TypesClient::where('nom', 'like', '%'.$this->filtreNom.'%')->paginate(30),
            'route' => 'type-client',
            'infostable' => [
                'nom' =>  [ 'nom_col' => 'nom du type de client' ],
            ],
            'filtre' => [
                ['type' => 'text', 'champLivewire' => 'filtreNom', 'placeholder' => 'nom du type du client', 'label' => 'nom', 'class' => 'col-12', 'name' => 'nom']
            ]
        ]);
    }
}
