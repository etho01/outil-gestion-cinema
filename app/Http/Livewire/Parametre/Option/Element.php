<?php

namespace App\Http\Livewire\Parametre\Option;
// meme modele que pour le filmSeance
use Livewire\Component;
use App\Models\film\Option;
use App\Models\cinema\Cinema;
use App\utils\form\OptionForm;

class Element extends Component
{
    public $idElement;
    public $idCinema;
    public $typeElement;

    public $idClient;

    public $nom;
    public $type;
    public $visibilite;

    public function mount($idCinema, $typeElement = ''){
        $this->idCinema = $idCinema;
        $this->typeElement = $typeElement;

        $this->idClient = Cinema::find($idCinema)->client_id;

        $this->setValueElement(0,0);
    }

    public function setValueElement($idElement, $idBase){
        $this->idElement = $idElement;
        $this->nom = null;
        $this->type = null;
        $this->visibilite = null;

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

    protected $listeners = ['showElementoption' => 'setValueElement'];

    public function save(){
        $this->validate();
        $this->emit('saveElement');
        $this->dispatchBrowserEvent('hideModal'.'option');
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
        $this->dispatchBrowserEvent('hideModal'.'option');
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
            'typeElement' => $this->typeElement
        ]);
    }
}
