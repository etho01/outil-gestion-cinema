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
            'route' => 'TypeClient.show',
            'infostable' => [
                'nom' => 'nom du type de client'
            ],
            'filtre' => [
                ['type' => 'text', 'datas' => 'filtreNom', 'placeholder' => 'nom du type du client']
            ]
        ]);
    }
}
