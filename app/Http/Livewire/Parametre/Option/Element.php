<?php

namespace App\Http\Livewire\Parametre\Option;

use Livewire\Component;
use App\Models\film\Option;
use App\Models\cinema\Cinema;
use App\utils\form\OptionForm;

class Element extends Component
{
    public $idElement;
    public $idCinema;

    public $idClient;

    public $nom;
    public $type;

    public function mount($idElement, $idCinema){
        $this->idElement = $idElement;
        $this->idCinema = $idCinema;

        $this->idClient = Cinema::find($idCinema)->client_id;


        if ($idElement != 0){ // si ne crée pas
            $option = Option::find($idElement);
            $this->nom = $option->nom;
            $this->type = $option->type;
        }
    }

    protected $rules = [
        'nom' => 'required',
        'type' => 'required'
    ];

    public function save(){
        $this->validate();
        $this->emit('saveElement');
        $this->dispatchBrowserEvent('hideModal'.'option'.$this->idElement);
        $option = Option::find($this->idElement);
        $option->update([
            'nom' => $this->nom,
            'type' => $this->type
        ]);
    }

    public function create(){
        $this->validate();
        $this->emit('saveElement');
        $this->dispatchBrowserEvent('hideModal'.'option'.$this->idElement);
        Option::create([
            'nom' => $this->nom,
            'client_id' => $this->idClient,
            'type' => $this->type
        ]);
        $this->nom = "";
        $this->type = 0;
    }

    public function render()
    {
        return view('livewire.parametre.option.element', [
            'idElement' => $this->idElement,
            'typeOption' => OptionForm::getOption(config('cinema.OPTIONS.TYPE_OPTION'))
        ]);
    }
}
