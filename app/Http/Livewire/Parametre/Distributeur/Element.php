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
    public $typeElement;

    public $nomDistrib;
    public $mailDistrib;

    private $distributeur;

    public function mount($idElement, $idCinema, $typeElement = ''){
        $this->idElement = $idElement;
        $this->idCinema = $idCinema;
        $this->typeElement = $typeElement;

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

    protected $messages = [
        'mailDistrib.required' => 'Le mail du distributeur ne doit pas etre null',
        'mailDistrib.email' => 'Le mail du distributeur doit etre un mail',
        'nomDistrib.required' => 'le nom du distributeur ne doit pas etre null'
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
            'user' => Auth::user(),
            'typeElement' => $this->typeElement
        ]);
    }
}
