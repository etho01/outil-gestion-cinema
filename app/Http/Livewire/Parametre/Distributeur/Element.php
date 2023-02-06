<?php

namespace App\Http\Livewire\Parametre\Distributeur;

use Livewire\Component;
use App\Models\film\Distributeur;
use Illuminate\Support\Facades\Auth;

class Element extends Component
{
    public $idElement;

    public $nomDistrib;
    public $mailDistrib;

    public function mount($idElement){
        $this->idElement = $idElement;
    }

    protected $rules = [
        'mailDistrib' => 'required|email',
        'nomDistrib' => 'required'
    ];

    public function save(){
        $this->validate();
        $distributeur = Distributeur::find($this->idElement);
        if (Auth::user()->isSuperAdmin()){
            $distributeur->nom = $this->nomDistrib;
            $distributeur->save();
        }
        $this->emit('saveElement');
        $this->dispatchBrowserEvent('hideModal');
    }

    public function render()
    {
        return view('livewire.parametre.distributeur.element', [
            'idElement' => $this->idElement,
            'element' => Distributeur::find($this->idElement),
            'user' => Auth::user()
        ]);
    }
}
