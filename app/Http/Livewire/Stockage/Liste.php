<?php

namespace App\Http\Livewire\Stockage;

use Livewire\Component;
use App\Models\film\Film;
use Livewire\WithPagination;
use App\Models\film\filmSceance;
use Illuminate\Support\Facades\DB;
use App\Models\cinema\StockageElement;
use App\Models\cinema\FilmSeanceStockageElement;

class Liste extends Component
{
    protected $infosPage;
    public $slug_cinema;
    public $idClient;
    public $idCinema;

    public $idPage;

    public $idTypeStockage;

    public $livewireObject = "stockage";

    protected $listeners = [
        "saveElement" => 'saveElement'
    ];

    public function saveElement(){
    }

    public function mount($infosPage){
        $this->infosPage = $infosPage;
        $this->slug_cinema = $infosPage->getSlugCinema();
        $this->idClient = $infosPage->instanceCinema()->client_id;
        $this->idCinema = $infosPage->instanceCinema()->id;
        $this->idPage = $infosPage->page->id;
        $this->idTypeStockage = StockageElement::getTypeElementByPage($this->idPage);
    }

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.stockage.liste', [
            'stockage' => $this->getPaginate(),
            'livewireObject' => $this->livewireObject,
            'option' => $this->idTypeStockage,
            'infostable' => [
                'nom' =>  [ 'nom_col' => 'Nom de la version du film de la séance' ],
            ],
            'filtre' => [
                ['type' => 'text', 'champLivewire' => 'filtreNom', 'placeholder' => 'Nom de la séance', 'label' => 'Nom de la séance', 'name' => 'nom', 'class' => 'col-12'],
            ],
            'importOtherPopUp' => [
                ['name' => 'films', 'ids' => Film::where('cinema_id', $this->idCinema)->get()->pluck('id')],
                ['name' => 'films_sceance', 'ids' => filmSceance::where('cinema_id', $this->idCinema)->get()->pluck('id')]
            ]
        ]);
    }


    public function delete($id){
        FilmSeanceStockageElement::find($id)->del();
    }

    public function getPaginate(){
        $paginate = DB::table('stockage_elements')
        ->join('film_sceances_elements', 'film_sceances_elements.stockage_element_id', '=', 'stockage_elements.id')
        ->join('film_sceances', 'film_sceances.id', '=', 'film_sceances_elements.film_sceance_id')
        ->join('salles', 'salles.id', '=', 'stockage_elements.salle_id')
        ->select('film_sceances_elements.*', 'film_sceances.nom')
        ->where('salles.cinema_id', $this->idCinema)
        ->where('type', $this->idTypeStockage);
        return $paginate->paginate(30);
    }
}
