<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\user\Role;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'email',
        'password',
        'client_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin(){
        $roles = $this->roles()->get();
        foreach ($roles as $role){
            if ($role->is_admin) return true;
        }
        return false;
    }

    public function getPageAutorized($idClient){
        if ($this->isAdmin()){
            $Client = Client::find($idClient);
            return Typesclient::find($Client->types_client_id)->pages();
        } else {

        }
    }

    public function roles(){
        return $this->belongsToMany(Role::class, 'users_roles');
    }

    public function del(){
        $this->roles()->detach();
        $this->delete(); 
    }
}
