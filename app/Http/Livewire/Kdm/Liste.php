<?php

namespace App\Http\Livewire\Kdm;
// meme modele que pour le filmSeance
use Livewire\Component;
use App\Models\film\Kdm;
use App\Models\film\Film;
use App\Models\film\Option;
use Carbon\CarbonImmutable;
use App\utils\form\OptionForm;
use App\Models\film\filmSceance;
use Illuminate\Support\Facades\DB;

class Liste extends Component
{
    protected $infosPage;
    public $slug_cinema;
    public $idClient;
    public $idCinema;

    public $filtreNom;

    public $livewireObject = "kdm";

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
    }

    public function render()
    {
        return view('livewire.kdm.liste', [
            'kdm' => $this->getPaginate(),
            'livewireObject' => $this->livewireObject,
            'infostable' => [
                'nom' =>  [ 'nom_col' => 'Nom de la séance' ],
                'date_debut' => ['nom_col' => 'Date de debut', 'date' => 'true', 'carbon' => CarbonImmutable::class, "format" => "d/m/Y"],
                'date_fin' => ['nom_col' => 'Date de fin', 'date' => 'true', 'carbon' => CarbonImmutable::class, "format" => "d/m/Y"],
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
        Kdm::find($id)->del();
    }

    public function getPaginate(){
        $paginate = DB::table('kdms')->join('film_sceances', 'film_sceances.id', '=', 'kdms.film_sceance_id');
        $paginate->where(function ($query){
            $query->where('nom', 'like', '%'.$this->filtreNom.'%');
        });
        $paginate->where('cinema_id', $this->idCinema)->select('kdms.*', 'film_sceances.nom');
        $paginate->groupBy('kdms.id');
        return $paginate->paginate(30);
    }
}
