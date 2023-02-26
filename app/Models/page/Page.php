<?php

namespace App\Models\page;

use App\Models\client\Client;
use App\Models\client\TypesClient;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\cinema\StockageElement;
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


    public function getPageChildren(){
        return Page::where('categorie_page_id', $this->categorie_page_id)->where('page_parent', $this->id)->get();
    }

    public static function getPageAndCategorieWherePageIn($array_pages, $getPageHide = false){
        $request = Page::join('categorie_pages', 'pages.categorie_page_id', '=', 'categorie_pages.id')->
        select('pages.*', 'categorie_pages.nom as nom_categorie', "categorie_pages.icone as icone_categorie");
        if ($getPageHide){
            $request->whereNotNull('pos');
        }

        return $request->wherein('pages.id', $array_pages)->
        orderby('categorie_pages.pos_categorie')->orderby('pages.pos')->get()->groupBy('nom_categorie');
    }

    public static function pageExist($routePage){
        return Page::where('route', $routePage)->count() != 0;
    }

    public static function getPageByNameRoute($name){
        return Page::where('route', $name)->first();
    }

    public function del(){
        $stockageElements = StockageElement::where('salle_id', $this->id)->get();
        foreach ($stockageElements as $stockageElement){
            $stockageElement->del();
        }
        $this->delete();
    }
}
