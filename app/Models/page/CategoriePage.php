<?php

namespace App\Models\page;

use App\Models\page\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoriePage extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nom',
        'icone',
    ];

    public function pages(){
        return $this->hasMany(Page::class);
    }

    public function pagesAutorized(){
        $builder = $this->pages()->whereNull('page_parent');
        $ROLE_USER = Auth::user()->role;
        if ($ROLE_USER->is_admin){
            return $builder->get();
        } else {
            $builder->whereIn('id', $ROLE_USER->pages()->get());
        }
    }

    public static function getInfosPagesListePage(){
        $tab_categorie_page = array();
        $CATEGORIES_PAGES = CategoriePage::all();
        foreach($CATEGORIES_PAGES as $CATEGORIE_PAGE){
            $COLLECTION_PAGE = $CATEGORIE_PAGE->pagesAutorized();
            $tab_categorie_page[] = array(
                'nb' => $COLLECTION_PAGE->count(),
                'icone' => $CATEGORIE_PAGE->icone,
                'pages' => $COLLECTION_PAGE,
                'nom' => $CATEGORIE_PAGE->nom
            );
        }
        return $tab_categorie_page;
    }
}
