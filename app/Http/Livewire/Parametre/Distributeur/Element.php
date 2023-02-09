<?php

namespace App\Http\Livewire\Parametre\Distributeur;

use App\Models\cinema\Cinema;
use Livewire\Component;
use App\Models\film\Distributeur;
use Illuminate\Support\Facades\Auth;

class Element extends Component
{
    public $idElement;
    public $idCinema;
    public $idClient;

    public $nomDistrib;
    public $mailDistrib;

    private $distributeur;

    public function mount($idElement, $idCinema){
        $this->idElement = $idElement;
        $this->idCinema = $idCinema;

        $this->idClient = Cinema::find($idCinema)->client_id;

        if ($idElement != 0){ // si ne crée pas
            $this->distributeur = Distributeur::find($this->idElement);

            $this->nomDistrib = $this->distributeur->nom;
            $this->mailDistrib = $this->distributeur->mail($this->idClient);
        }
    }

    protected $rules = [
        'mailDistrib' => 'required|email',
        'nomDistrib' => 'required',
    ];

    public function save(){
        $this->validate();
        $this->emit('saveElement');
        $this->dispatchBrowserEvent('hideModal'.'distributeur'.$this->idElement);
        $distributeur = Distributeur::find($this->idElement);
        if (Auth::user()->isSuperAdmin()){
            $distributeur->nom = $this->nomDistrib;
            $distributeur->save();
        }
        $distributeur->updateMail($this->idClient, $this->mailDistrib); 
    }

    public function create(){
        $this->validate();
        $this->emit('saveElement');
        $this->dispatchBrowserEvent('hideModal'.'distributeur'.$this->idElement);
        $distributeur = Distributeur::create([
            'nom' => $this->nomDistrib,
        ]);
        $distributeur->insertMail($this->idClient, $this->mailDistrib);
        $this->mailDistrib = "";
        $this->nomDistrib = "";

    }

    public function render()
    {
        return view('livewire.parametre.distributeur.element', [
            'idElement' => $this->idElement,
            'user' => Auth::user()
        ]);
    }
}
