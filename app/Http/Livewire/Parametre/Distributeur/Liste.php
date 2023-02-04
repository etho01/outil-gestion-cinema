<?php

namespace App\Http\Livewire\Parametre\Distributeur;

use Livewire\Component;
use App\utils\form\Option;
use App\Models\cinema\Cinema;
use App\Models\film\Distributeur;
use Illuminate\Support\Facades\DB;

class Liste extends Component
{
    protected $infosPage;
    public $filtreNom;

    public $isParam;
    public $slug_cinema;
    public $idClient;

    public function mount($infosPage){
        $this->infosPage = $infosPage;
        $this->slug_cinema = $infosPage->getSlugCinema();
        $this->idClient = $infosPage->instanceCinema()->client_id;
    }

    public function render()
    {
        return view('livewire.parametre.distributeur.liste', [
            'distributeur' => $this->getPaginate(),
            'infostable' => [
                'nom' =>  [ 'nom_col' => 'nom du distributeur' ],
                'mail' => [ 'nom_col' => 'email']
            ],
            'filtre' => [
                ['type' => 'select', 'champLivewire' => 'isParam', 
                'elements' => Option::getOptionOuiNon(),
                 'label' => 'Est parametré', 'class' => 'col-1', 'name' => 'cinema',
                'defaultValue' => 0],

                ['type' => 'text', 'champLivewire' => 'filtreNom', 'placeholder' => 'nom du type du client', 'label' => 'nom du client', 'name' => 'nom', 'class' => 'col-9'],

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
