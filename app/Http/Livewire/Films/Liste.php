<?php

namespace App\Http\Livewire\Films;
// meme modele que pour le filmSeance
use Livewire\Component;
use App\Models\film\Film;
use App\Models\film\Option;
use Livewire\WithPagination;
use App\utils\form\OptionForm;
use App\Models\film\filmSceance;
use Illuminate\Support\Facades\DB;

class Liste extends Component
{
    protected $infosPage;
    public $slug_cinema;
    public $idClient;
    public $idCinema;

    public $livewireObject = "films";

    public $filtreSalle;

    public $filtreNom;
    public $filtreSon;
    public $filtreImage;

    protected $listeners = [
        "saveElement" => 'saveElement'
    ];

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

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
        return view('livewire.films.liste', [
            'films' => $this->getPaginate(),
            'livewireObject' => $this->livewireObject,
            'infostable' => [
                'nom' =>  [ 'nom_col' => 'Nom de la version' ],
                'nom_film' => ['nom_col' => 'Nom du film'],
                'option_son' => ['nom_col' => 'Option du son', 'datas' => OptionForm::getoptionClass(Option::all())],
                'option_image' => ['nom_col' => 'Option de l\'image', 'datas' => OptionForm::getoptionClass(Option::all())],
                '' => ['nom_col' => "", "class" => "text-end", 'col' => 'id' , 'pop_up' => [
                    ['type' => "films_sceance", 'icone' => "fa-solid fa-film", "title" => "Ajouter un film sceance"]
                ]]
            ],
            'filtre' => [
                ['type' => 'select', 'champLivewire' => 'filtreSon','defaultValue' => 0 , 'class' => 'col-12 col-md-3' , 'label' => 'Filtre son', 'name' => 'filtreSom' , 'elements' => Option::getElmentByType(3)],
                ['type' => 'select', 'champLivewire' => 'filtreImage','defaultValue' => 0 , 'class' => 'col-12 col-md-3' , 'label' => 'Filtre image', 'name' => 'filtreImage' , 'elements' => Option::getElmentByType(4)],
                ['type' => 'text', 'champLivewire' => 'filtreNom', 'placeholder' => 'Nom du film ou de la version', 'label' => 'Nom du film', 'name' => 'nom', 'class' => 'col-12 col-md-6'],
            ],
            'useModal' => [
                $this->livewireObject,
                'films_sceance'
            ]
        ]);
    }

    public function delete($id){
        Film::find($id)->del();
    }

    public function getPaginate(){
        $paginate = DB::table('films');
        $paginate->where(function ($query){
            $query->where('nom', 'like', '%'.$this->filtreNom.'%');
        });
        if ($this->filtreSon){
            $paginate->where('option_son', $this->filtreSon);
        }
        if ($this->filtreImage){
            $paginate->where('filtre_image', $this->filtreImage);
        }
        $paginate->where('cinema_id', $this->idCinema);
        $paginate->groupBy('films.id');
        return $paginate->paginate(30);
    }
}
