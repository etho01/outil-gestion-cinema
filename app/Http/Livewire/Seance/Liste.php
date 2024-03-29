<?php

namespace App\Http\Livewire\Seance;
// meme modele que pour le filmSeance
use Livewire\Component;
use App\Models\film\Film;
use App\Models\film\Option;
use Carbon\CarbonImmutable;
use App\Models\cinema\Salle;
use Livewire\WithPagination;
use App\Models\cinema\Cinema;
use App\Models\cinema\Sceance;
use App\utils\form\OptionForm;
use Illuminate\Support\Carbon;
use App\Models\film\filmSceance;

class Liste extends Component
{
    protected $infosPage;
    public $slug_cinema;
    public $idClient;
    public $idCinema;

    public $filtreVisibilite;

    public $filtreSalle;

    public $livewireObject = 'seance';

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
        return view('livewire.seance.liste', [
            'sceance' => $this->getPaginate(),
            'livewireObject' => $this->livewireObject,
            'idCinema' => $this->idCinema,
            'infostable' => [
                'film_nom' => ['nom_col' => 'Nom du film'],
                'option_langue' => ['nom_col' => 'Langue du film', 'datas' => OptionForm::getoptionClass(Option::all())],
                'option_dimention' => ['nom_col' => 'Dimmention de la séance', 'datas' => OptionForm::getoptionClass(Option::all())],
                'salle_id' => ['nom_col' => 'Salle', 'datas' => OptionForm::getoptionClass(Salle::all())],
                'is_visible_site' => ['nom_col' => 'Est visible sur le site', 'datas' => OptionForm::getOptionOuiNon()->all()],
                'date_seance' => ['nom_col' => 'Date de la séance', 'date' => 'true', 'carbon' => CarbonImmutable::class, "format" => "d/m/Y H:i"],
                '' => ['nom_col' => 'Statut du film', 'StatutFilm' => ''],
                '-' => ['nom_col' => 'Statut de la KDM', 'StatutKdm' => ''],
                '--' => ['nom_col' => "", "class" => "text-end", 'col' => 'id_film_seance' , 'pop_up' => [
                    ['type' => "kdm", 'icone' => "fa-solid fa-key", "title" => "Ajouter une KDM"],
                    ['type' => "stockage", 'icone' => "fa-solid fa-server", "title" => "Ajouter dans un stockage"],
                ]]
            ],
            'filtre' => [
                ['type' => 'select', 'champLivewire' => 'filtreSalle', 
                'elements' => Cinema::where('slug', $this->slug_cinema)->first()->salles()->get(),
                 'label' => 'Salle', 'class' => 'col-12 col-md-2', 'name' => 'filtreSalle',
                'defaultValue' => 0],

                ['type' => 'select', 'champLivewire' => 'filtreVisibilite', 
                'elements' => OptionForm::getOptionOuiNon(),
                 'label' => 'Est visible sur le site', 'class' => 'col-12 col-md-2', 'name' => 'filtreVisibilite',
                'defaultValue' => 0],

                ['type' => 'text', 'champLivewire' => 'filtreNom', 'placeholder' => 'Nom de la séance', 'label' => 'Nom de la séance', 'name' => 'nom', 'class' => 'col-12 col-md-8'],

            ],
            'useModal' => [
                $this->livewireObject,
                'films',
                'films_sceance',
                'kdm',
                'stockage'
            ]
        ]);
    }

    public function delete($id){
        Sceance::find($id)->del();
    }

    public function getPaginate(){
        $paginate = Sceance::join('film_sceances', 'film_sceances.id', '=', 'sceances.film_sceance_id')
        ->join('films' ,'film_sceances.film_id','=', 'films.id')
        ->join('salles', 'salles.id', '=', 'sceances.salle_id')
        ->where('salles.cinema_id', $this->idCinema)
        ->whereDate('sceances.date_seance', '>=', Carbon::today()->toDateString())
        ->orderby('sceances.date_seance');
        $paginate->select('sceances.*' , 'films.nom as film_nom', 'film_sceances.option_langue', 'film_sceances.option_dimention', 'film_sceances.id as id_film_seance');
        if ($this->filtreSalle) $paginate->where('salle_id', $this->filtreSalle);
        if ($this->filtreVisibilite) $paginate->where('is_visible_site', $this->filtreVisibilite);
        $paginate->groupBy('sceances.id');
        return $paginate->paginate(30);
    }
}
