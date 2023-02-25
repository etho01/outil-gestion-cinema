<?php

namespace App\Http\Livewire\Parametre\Distributeur;

use Livewire\Component;
use App\utils\form\OptionForm;
use App\Models\cinema\Cinema;
use App\Models\film\Distributeur;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Liste extends Component
{
    public $livewireObject = "distributeur";

    protected $infosPage;
    public $filtreNom;

    public $isParam;
    public $slug_cinema;
    public $idClient;
    public $idCinema;

    public $elementUpdate = -1;

    protected $listeners = [
        "saveElement" => 'saveElement'
    ];

    public function saveElement(){
        $this->elementUpdate = -1;
        $this->reset('elementUpdate');
    }

    public function mount($infosPage){
        $this->infosPage = $infosPage;
        $this->slug_cinema = $infosPage->getSlugCinema();
        $this->idClient = $infosPage->instanceCinema()->client_id;
        $this->idCinema = $infosPage->getIdcinema();
    }

    public function update($id){
        if (Auth::user()->isSuperAdmin()){
            $this->elementUpdate = $id;
            $this->dispatchBrowserEvent('showModal'.$this->livewireObject.$id);
        }
    }

    public function delete($id){
        if (Auth::user()->isSuperAdmin()){
            Distributeur::find($id)->del();
        }
    }

    public function render()
    {
        return view('livewire.parametre.distributeur.liste', [
            'distributeur' => $this->getPaginate(),
            'livewireObject' => $this->livewireObject,
            'elementUpdate' => $this->elementUpdate,
            'canCreateDelete' => Auth::user()->isSuperAdmin(),
            'infostable' => [
                'nom' =>  [ 'nom_col' => 'Nom du distributeur' ],
                'mail' => [ 'nom_col' => 'Email']
            ],
            'filtre' => [
                ['type' => 'select', 'champLivewire' => 'isParam', 
                'elements' => OptionForm::getOptionOuiNon(),
                 'label' => 'Est parametré', 'class' => 'col-12 col-md-2', 'name' => 'cinema',
                'defaultValue' => 0],

                ['type' => 'text', 'champLivewire' => 'filtreNom', 'placeholder' => 'Nom du type du client', 'label' => 'Nom du client', 'name' => 'nom', 'class' => 'col-12 col-md-9'],

            ]
        ]);
    }

    public function getPaginate(){
        $paginate = DB::table('distributeurs')->select('distributeurs.*', 'client_distributeur.mail');
        $paginate->where(function ($query){
            $query->where('nom', 'like', '%'.$this->filtreNom.'%');
            $query->orwhere('mail', 'like', '%'.$this->filtreNom.'%');
        });
        if ($this->isParam){
            if ($this->isParam == 2){
                $paginate->join('client_distributeur', 'client_distributeur.distributeur_id', '=', 'distributeurs.id' );
            } else {
                $paginate->leftjoin('client_distributeur', 'client_distributeur.distributeur_id', '=', 'distributeurs.id' );
                $paginate->whereNotIn('distributeurs.id', DB::table('client_distributeur')->select('client_distributeur.distributeur_id')->get()->pluck('distributeur_id')->all());
            }
        } else {
            $paginate->leftjoin('client_distributeur', 'client_distributeur.distributeur_id', '=', 'distributeurs.id' );
        }
        $paginate->where(function ($query){
            $query->where('client_distributeur.client_id', $this->idClient);
            $query->orwhereNull('client_distributeur.client_id');
        });
        $paginate->groupBy('distributeurs.id');
        return $paginate->paginate(30);
    }
}
