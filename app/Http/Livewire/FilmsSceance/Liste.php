<?php

namespace App\Http\Livewire\FilmsSceance;

use Livewire\Component;
use App\Models\film\Film;
use App\Models\film\filmSceance;
use App\Models\film\Option;
use App\utils\form\OptionForm;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class Liste extends Component
{
    // varialbe sur la page
    protected $infosPage;
    public $slug_cinema;
    public $idClient;
    public $idCinema;

    public $livewireObject = "films_sceance"; // objet livewire

    public $filtreSon;
    public $filtreImage;
    public $filtreLangue;
    public $filtreDim;
    public $filtreNom;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    // ecoute l'evenement pour raffraichir la liste
    protected $listeners = [
        "saveElement" => 'saveElement'
    ];

    // fonction qui a pour unique but de render le composant
    public function saveElement(){
    }

    public function mount($infosPage){
        // set les variables de pages
        $this->infosPage = $infosPage;
        $this->slug_cinema = $infosPage->getSlugCinema();
        $this->idClient = $infosPage->instanceCinema()->client_id;
        $this->idCinema = $infosPage->instanceCinema()->id;
    }

    // rend 
    public function render()
    {
        return view('livewire.films-sceance.liste', [
            'films' => $this->getPaginate(), // liste d'element
            'livewireObject' => $this->livewireObject,
            'infostable' => [ // colonne du tableau
                'nom' =>  [ 'nom_col' => 'Nom de la version pour la séance' ],
                'nom_version' =>  [ 'nom_col' => 'Nom de la version' ],
                'nom_film' => ['nom_col' => 'Nom du film'],
                'option_son' => ['nom_col' => 'Option du son', 'datas' => OptionForm::getoptionClass(Option::all())],
                'option_image' => ['nom_col' => 'Option de l\'image', 'datas' => OptionForm::getoptionClass(Option::all())],
                'option_langue' => ['nom_col' => 'Langue du film', 'datas' => OptionForm::getoptionClass(Option::all())],
                'option_dimention' => ['nom_col' => 'Dimention de la séance', 'datas' => OptionForm::getoptionClass(Option::all())],
                '' => ['nom_col' => "", "class" => "text-end", 'col' => 'id' , 'pop_up' => [
                    ['type' => "kdm", 'icone' => "fa-solid fa-key", "title" => "Ajouter une KDM"],
                    ['type' => "seance", 'icone' => "fa-solid fa-circle-play", "title" => "Ajouter une séance"],
                    ['type' => "stockage", 'icone' => "fa-solid fa-server", "title" => "Ajouter dans un stockage"],
                ]]
            ],
            'filtre' => [ // filtre
                ['type' => 'select', 'champLivewire' => 'filtreSon','defaultValue' => 0 , 'class' => 'col-12 col-md-3' , 'label' => 'Filtre son', 'name' => 'filtreSon' , 'elements' => Option::getElmentByType(3)],
                ['type' => 'select', 'champLivewire' => 'filtreImage','defaultValue' => 0 , 'class' => 'col-12 col-md-3' , 'label' => 'Filtre image', 'name' => 'filtreImage' , 'elements' => Option::getElmentByType(4)],
                ['type' => 'select', 'champLivewire' => 'filtreLangue','defaultValue' => 0 , 'class' => 'col-12 col-md-3' , 'label' => 'Filtre Lanque', 'name' => 'filtreLangue' , 'elements' => Option::getElmentByType(1)],
                ['type' => 'select', 'champLivewire' => 'filtreDim','defaultValue' => 0 , 'class' => 'col-12 col-md-3' , 'label' => 'Filtre dimention', 'name' => 'filtreDim' , 'elements' => Option::getElmentByType(2)],
                ['type' => 'text', 'champLivewire' => 'filtreNom', 'placeholder' => 'Nom du film ou de la version', 'label' => 'Nom du film', 'name' => 'nom', 'class' => 'col-12'],
            ],
            'useModal' => [ // modal load
                $this->livewireObject,
                'films',
                'kdm',
                'seance',
                'stockage'
            ]
        ]);
    }

    // supprimer le composant
    public function delete($id){
        filmSceance::find($id)->del();
    }

    // methode pour avoir les donnée
    public function getPaginate(){
        $paginate = DB::table('film_sceances');
        $paginate->join('films', 'film_sceances.film_id', '=', 'films.id');
        $paginate->where(function ($query){
            $query->where('film_sceances.nom', 'like', '%'.$this->filtreNom.'%');
            $query->Orwhere('films.nom', 'like', '%'.$this->filtreNom.'%');
            $query->Orwhere('films.nom_film', 'like', '%'.$this->filtreNom.'%');
        });
        if ($this->filtreSon){
            $paginate->where('films.option_son', $this->filtreSon);
        }
        if ($this->filtreImage){
            $paginate->where('films.option_image', $this->filtreImage);
        }
        if ($this->filtreLangue){
            $paginate->where('film_sceances.option_langue', $this->filtreLangue);
        }
        if ($this->filtreDim){
            $paginate->where('film_sceances.option_dimention', $this->filtreDim);
        }
        $paginate->where('film_sceances.cinema_id', $this->idCinema);
        $paginate->select('film_sceances.*', 'films.nom as nom_version', 'films.nom_film', 'films.option_son', 'films.option_image');
        $paginate->groupBy('film_sceances.id');
        return $paginate->paginate(30);
    }
}
