<?php

namespace App\Models\page;

use App\Models\client\Client;
use App\Models\client\TypesClient;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nom',
        'route',
        'pos', // la possition de la page ,
        'page_parent', // si c'est null alors la page est invisible
        'categoriesPages_id'
    ];

    public static function getPageAutorized($publicPageBase, $CINEMA = null, $hideShow = null){
        $basePageAutorized = collect();
        if (Auth::user()->isAdmin() && Auth::user()->client_id == 1){ // si administrateur de l'entreprise gerant le site
            $basePageAutorized = $basePageAutorized->merge(collect([config('global.PAGES.PAGE_LIST_CLIENT'), config('global.PAGES.PAGE_LIST_TYPE_CLIENT')]));
        }
        if ($publicPageBase){// le cinema n'est pas selectionner
            return $basePageAutorized;
        } else {
            if (Auth::user()->isAdmin()){
                $CLIENT = Client::find($CINEMA->client_id);
                $eloquent = TypesClient::find($CLIENT->types_client_id)->pages();
                if ($hideShow) $eloquent->whereNull('page_parent');
                return $basePageAutorized->concat($eloquent->get()->pluck('id'));
            }
        }
    }

    public static function getPageAndCategorieWherePageIn($array_pages){
        return Page::join('categorie_pages', 'pages.categorie_page_id', '=', 'categorie_pages.id')->
        select('pages.*', 'categorie_pages.nom as nom_categorie', "categorie_pages.icone as icone_categorie")->wherein('pages.id', $array_pages)->
        orderby('categorie_pages.id')->get()->groupBy('nom_categorie');
    }
}
