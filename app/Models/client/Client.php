<?php

namespace App\Models\client;

use App\Models\User;
use App\Models\user\Role;
use Illuminate\Support\Str;
use App\Models\cinema\Salle;
use App\Models\cinema\Cinema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nom',
        'logo',
        'email'
    ];

    public function cinemas(){
        return $this->hasMany(Cinema::class);
    }

    public function roles(){
        return $this->hasMany(Role::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }

    public static function getBySlug($slug){
        return Client::where('slug', $slug)->first();
    } 

    public function del(){
        $cinemas = $this->cinemas()->get();
        foreach ($cinemas as $cinema) $cinema->del();
        $roles = $this->roles()->get();
        foreach ($roles as $role) $role->del();
        $users = $this->users()->get();
        foreach ($users as $user) $user->del();
        $this->delete();

    }

    //sous la forme collecion => lise de cinemas => [infos cinema] => liste salle
    public function updateCinemaClient($ListeCinema){
        $listIdCinema = array();
        $listIdSalle = array();
        foreach ($ListeCinema as $cinema){
            if (Cinema::cinemaExist($this->id, $cinema['id'])){
                $CINEMA = Cinema::find($cinema['id']);  // le cinema existe
                $CINEMA->update([
                    'nom' => $cinema['nom'],
                    'slug' => Str::of($cinema['nom'])->slug('-'),
                ]);
            } else {
                $CINEMA = Cinema::create([
                    'nom' => $cinema['nom'],
                    'client_id' => $this->id,
                    'slug' => Str::of($cinema['nom'])->slug('-'),
                ]);
            }
            $listIdCinema[] = $CINEMA->id;
            foreach ($cinema['listeSalle'] as $salle){
                if(Salle::SalleExist($CINEMA->id, $salle['id'])){
                    $SALLE = Salle::find($salle['id']);
                    $SALLE->update([
                        'nom' => $salle['nom']
                    ]);
                } else {
                    $SALLE = Salle::create([
                        'cinema_id' => $CINEMA->id,
                        'nom' => $salle['nom']
                    ]);
                }
                $listIdSalle[] = $SALLE->id;
            }
        }
        $cinemasASup = Cinema::where('client_id' , $this->id)->whereNotIn('id', $listIdCinema)->get();
        foreach ($cinemasASup as $cinemaASup) $cinemaASup->del();
        $sallesAsup = Salle::whereIn('cinema_id', $listIdCinema)->whereNotin('id', $listIdSalle)->get();
        foreach ($sallesAsup as $salleAsup) $salleAsup->del();
    }
}
