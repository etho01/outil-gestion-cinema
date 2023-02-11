<?php

namespace App\Models\film;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nom',
        'client_id',
        'type',
        'visibilite'
   ];

   public static function getTypeOptionByVisibilite($visibilite){
    if ($visibilite == 1){
        return config('cinema.OPTIONS.TYPE_OPTION_SCEANCE');
    } else if ($visibilite == 2){
        return config('cinema.OPTIONS.TYPE_OPTION_FILM');
    } else {
        return [];
    }
   }
    public static function getAllOptionTypes(){
        return collect( config('cinema.OPTIONS.TYPE_OPTION_SCEANCE') +  config('cinema.OPTIONS.TYPE_OPTION_FILM'));
   }
   public static function getElmentByType($type){
    return Option::where('type', $type)->get();
   }
}
