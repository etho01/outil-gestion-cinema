<?php

namespace App\Models\cinema;

use App\Models\film\filmSceance;
use App\Models\film\CombinaisonOption;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockageElement extends Model
{
    use HasFactory;

    protected $fillable = [
        'salle_id',
        'id',
        'type',
    ];

    public function films(){
        return $this->hasMany(filmSceance::class);
    }

    public function del(){
        $this->films()->detach();
        $this->delete;
    }

    // recupere l'id de l'element de stockage si n'exite pas alors je le crée
    public static function getIdElementStockage($type, $idSalle){
        $stockage = StockageElement::where('type', $type)->where('salle_id', $idSalle)->first();
        if ($stockage == null){
            $stockage = StockageElement::create([
                'salle_id' => $idSalle,
                'type' => $type
            ]);
        }
        return $stockage->id;
    }

    // get le type en fonction de la page
    public static function getTypeElementByPage($idPage){
        if ($idPage == config('global.PAGES.PAGE_LIST_NAS')){
            return config('cinema.TYPE_STOCKAGE.NAS');

        } else if ($idPage == config('global.PAGES.PAGE_LIST_DCP')){
            return config('cinema.TYPE_STOCKAGE.DCP');

        } else if ($idPage == config('global.PAGES.PAGE_LIST_GLOBECAST')){
            return config('cinema.TYPE_STOCKAGE.GLOBECAST');

        } else if ($idPage == config('global.PAGES.PAGE_LIST_SERVEUR')){
            return config('cinema.TYPE_STOCKAGE.SERVEUR');
        }
    }

    public static function getListeTypeElementStockage(){
        $tab_config = config('cinema.TYPE_STOCKAGE');
        $tab_liste = [];
        foreach ($tab_config as $nom => $key){
            $tab_liste[$key] = $nom;
        }
        return $tab_liste;
    }
}
