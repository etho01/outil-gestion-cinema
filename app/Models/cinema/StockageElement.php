<?php

namespace App\Models\cinema;

use App\Models\film\CombinaisonOption;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockageElement extends Model
{
    use HasFactory;

    protected $fillable = [
        'combinaison_option_id',
        'stockage_element_id',
        'type',
    ];

    public function films(){
        return $this->hasMany(CombinaisonOption::class);
    }

    public function del(){
        $this->films()->detach();
        $this->delete;
    }
}
