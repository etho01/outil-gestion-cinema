<?php

namespace App\Models\page;

use Illuminate\Support\Facades\DB;
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

    public static function getPageAndCategorieWherePageIn($array_pages){
        return Page::join('categorie_pages', 'pages.categorie_page_id', '=', 'categorie_pages.id')->
        select('pages.*', 'categorie_pages.nom as nom_categorie', "categorie_pages.icone as icone_categorie")->wherein('pages.id', $array_pages)->
        orderby('categorie_pages.id')->get()->groupBy('nom_categorie');
    }
}
