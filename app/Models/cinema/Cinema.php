<?php

namespace App\Models\cinema;

use App\Models\user\Roles_page;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cinema extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nom',
        'client_id',
        'slug'
    ];

    public function del(){
        DB::table('roles_pages')->where('cinema_id', $this->id)->delete();
        $pages = $this->salles()->get();
        foreach ($pages as $page){
            $page->del();
        }
        $this->delete();
    }

    public function salles(){
        return $this->hasMany(Salle::class);
    }

    public static function getCinemaSlug($slug){
        return Cinema::where('slug', $slug)->first();
    }

    public static function supCinema($idCinema){
        if (Cinema::cinemaExist($idClient, $idSalle)){
            $CINEMA = Cinema::find($idSalle);
            $CINEMA->delete();
        }
    }

    public static function getNbCinema($idClient, $idCinema){
        return Cinema::where('client_id', $idClient)->where('id', $idCinema)->get()->count();
    }

    public static function cinemaExist($idClient, $idCinema){
        return Cinema::getNbCinema($idClient, $idCinema) != 0;
    }

    public static function getCinema($idclient){
        return Cinema::where('client_id', $idclient);
    }

    public static function getCinemaByClientName($isAdmin){
        $eloquent =  Cinema::join('clients', 'cinemas.client_id', '=', 'clients.id')->select('cinemas.*', 'clients.nom as nom_client');
        if (!$isAdmin) $eloquent->where('clients.id', Auth::user()->client_id);
        return $eloquent->get()->groupBy('nom_client');
    }
}
