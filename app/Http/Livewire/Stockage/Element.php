<?php

namespace App\Http\Livewire\Stockage;

use Livewire\Component;
use App\Models\cinema\Salle;
use App\Models\film\filmSceance;
use App\Models\cinema\StockageElement;
use App\Models\cinema\FilmSeanceStockageElement;
use App\utils\form\OptionForm;

class Element extends Component
{
    public $idElement;
    public $idCinema;
    public $idClient;
    public $typeElement;

    public $nomFilmSceance;
    public $idFilmSceance = 0;

    public $idSalle;
    public $type;

    public function mount($idElement, $idCinema,$idBase , $typeElement = ''){
        $this->idElement = $idElement;
        $this->idCinema = $idCinema;
        $this->typeElement = $typeElement;

        if ($idElement != 0){
            $stockage = FilmSeanceStockageElement::find($this->idElement);

            $stockage_salle = StockageElement::find($stockage->stockage_element_id);
            $this->type = $stockage_salle->type;
            $this->idSalle = $stockage_salle->salle_id;

            $film = filmSceance::find($stockage->film_sceance_id);
            $this->idFilmSceance = $film->id;
            $this->nomFilmSceance = $film->nom;
        }
        if ($idBase != 0){
            $film = filmSceance::find($idBase);
            $this->idFilmSceance = $film->id;
            $this->nomFilmSceance = $film->nom;
        }
    }

    function updateFilmSceance($id){
        $film = filmSceance::find($id);
        $this->idFilmSceance = $film->id;
        $this->nomFilmSceance = $film->nom;
    }

    protected $rules = [
        'idSalle' => 'required',
        'type' => 'required'
    ];

    function save(){
        $this->validate();
        $this->emit('saveElement');
        $this->dispatchBrowserEvent('hideModal'.$this->typeElement.$this->idElement);
        $stockage = FilmSeanceStockageElement::find($this->idElement);
        $stockage->update([
            'film_sceance_id' => $this->idFilmSceance,
            'stockage_element_id' => StockageElement::getIdElementStockage($this->type, $this->idSalle)
        ]);
    }

    function create(){
        $this->validate();
        $this->emit('saveElement');
        $this->dispatchBrowserEvent('hideModal'.$this->typeElement.$this->idElement);
        FilmSeanceStockageElement::create([
           'film_sceance_id' => $this->idFilmSceance,
           'stockage_element_id' =>  StockageElement::getIdElementStockage($this->type, $this->idSalle)
        ]);
    }

    public function render()
    {
        return view('livewire.stockage.element', [
            'typeElement' => $this->typeElement,
            'idElement' => $this->idElement,
            'nomFilmSceance' => $this->nomFilmSceance,
            'idFilmSceance' => $this->idFilmSceance,
            'salles' => Salle::where('cinema_id', $this->idCinema)->get(),
            'Listetype' => OptionForm::getOption(StockageElement::getListeTypeElementStockage())
        ]);
    }
}
