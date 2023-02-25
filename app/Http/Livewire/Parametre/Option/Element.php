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
    public $visibilite;

    public function mount($idElement, $idCinema){
        $this->idElement = $idElement;
        $this->idCinema = $idCinema;

        $this->idClient = Cinema::find($idCinema)->client_id;


        if ($idElement != 0){ // si ne crée pas
            $option = Option::find($idElement);
            $this->nom = $option->nom;
            $this->type = $option->type;
            $this->visibilite = $option->visibilite;
        }
    }

    protected $rules = [
        'nom' => 'required',
        'type' => 'required',
        'visibilite' => 'required'
    ];

    protected $messages = [
        'nom.required' => 'Le nom de l\'option ne doit pas etre null',
        'type.required' => 'Le tyoe de l\'option ne doit pas etre null',
        'visibilite.required' => 'La visibilité de l\'option ne doit pas etre null'
    ];

    public function save(){
        $this->validate();
        $this->emit('saveElement');
        $this->dispatchBrowserEvent('hideModal'.'option'.$this->idElement);
        $option = Option::find($this->idElement);
        $option->update([
            'nom' => $this->nom,
            'type' => $this->type,
            'visibilite' => $this->visibilite
        ]);
    }

    public function create(){
        $this->validate();
        $this->emit('saveElement');
        $this->dispatchBrowserEvent('hideModal'.'option'.$this->idElement);
        Option::create([
            'nom' => $this->nom,
            'client_id' => $this->idClient,
            'type' => $this->type,
            'visibilite' => $this->visibilite
        ]);
        $this->nom = "";
        $this->type = 0;
    }

    function changeType(){
        $this->type = "";
    }

    public function render()
    {
        return view('livewire.parametre.option.element', [
            'idElement' => $this->idElement,
            'visibiliteOption' => OptionForm::getOption(config('cinema.OPTIONS.TYPE_OPTION')),
            'visibilite' => $this->visibilite,
            'typeOption' => OptionForm::getOption(Option::getTypeOptionByVisibilite($this->visibilite)),
        ]);
    }
}
