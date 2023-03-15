<?php

namespace App\Http\Livewire\Parametre\Option;

use Livewire\Component;
use App\Models\film\Option;
use Livewire\WithPagination;
use App\utils\form\OptionForm;
use Illuminate\Support\Facades\DB;

class Liste extends Component
{
    public $livewireObject = "option";
    protected $infosPage;

    public $elementUpdate = -1;

    public $slug_cinema;
    public $idClient;
    public $idCinema;

    public $filtreNom;
    public $typeOption;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function mount($infosPage){
        $this->infosPage = $infosPage;
        $this->slug_cinema = $infosPage->getSlugCinema();
        $this->idClient = $infosPage->instanceCinema()->client_id;
        $this->idCinema = $infosPage->getIdcinema();
    }

    protected $listeners = [
        "saveElement" => 'saveElement'
    ];

    public function saveElement(){
        $this->elementUpdate = -1;
        $this->reset('elementUpdate');
    }

    public function update($id){
        $this->elementUpdate = $id;
        $this->dispatchBrowserEvent('showModal'.$this->livewireObject.$id);
    }

    public function delete($id){
        Option::find($id)->del();
    }

    public function render()
    {
        return view('livewire.parametre.option.liste', [
            'distributeur' => $this->getPaginate(),
            'livewireObject' => $this->livewireObject,
            'elementUpdate' => $this->elementUpdate,
            'infostable' => [
                'nom' =>  [ 'nom_col' => 'Nom de l\'option' ],
                'visibilite' => [ 'nom_col' => 'Visibilité de l\'option', 'datas' => OptionForm::getOption(config('cinema.OPTIONS.TYPE_OPTION'))->all()],
                'type' => [ 'nom_col' => 'Type de l\'option', 'datas' => OptionForm::getOption(Option::getAllOptionTypes()->all())],
            ],
            'filtre' => [
                ['type' => 'select', 'champLivewire' => 'typeOption', 
                'elements' => OptionForm::getOption(config('cinema.OPTIONS.TYPE_OPTION')),
                 'label' => 'Type option', 'class' => 'col-12 col-md-2', 'name' => 'option',
                'defaultValue' => 0],

                ['type' => 'text', 'champLivewire' => 'filtreNom', 'placeholder' => 'Nom de l\'option', 'label' => 'Nom de l\'option', 'name' => 'nom', 'class' => 'col-12 col-md-10'],

            ]
        ]);
    }

    public function getPaginate(){
        $paginate = DB::table('options')->where(function ($query){
            $query->where('nom', 'like', '%'.$this->filtreNom.'%');
        })->where('client_id', $this->idClient);
        if ($this->typeOption){
            $paginate->where('type', $this->typeOption);
        }
        $paginate->groupBy('options.id');
        return $paginate->paginate(30);
    }
}
