<?php

namespace App\Models\cinema;

use App\Models\cinema\Sceance;
use App\Models\cinema\StockageElement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Salle extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nom',
        'cinema_id',
        'slug'
    ];

    public function sceances(){
        return $this->hasMany(Sceance::class);
    }

    public function stockageElements(){
        return $this->hasMany(StockageElement::class);
    }

    public function del(){
        foreach ($this->sceances()->get() as $sceance){
            $sceance->delete();
        }
        foreach ($this->stockageElements()->get() as $stockageElement){
            $stockageElement->del();
        }
        $this->delete();
    }

    public static function getNbSalle($id_cinema, $id){
        return Salle::where('cinema_id', $id_cinema)->where('id', $id)->get()->count();
    }

    public static function SalleExist($id_cinema, $id){
        return Salle::getNbSalle($id_cinema, $id) != 0;
    }
}
