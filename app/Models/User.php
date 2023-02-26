<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\page\Page;
use App\Models\user\Role;
use App\Models\client\Client;
use Laravel\Sanctum\HasApiTokens;
use App\Models\client\TypesClient;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        'client_id',
        'is_validate',
        'slug'
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
            if ($role->is_admin == "2") return true;
        }
        return false;
    }

    public function isSuperAdmin(){
        return $this->isAdmin() && $this->client_id == 1;
    }

    public function getPageForRoleUser($hideShow){
        $eloquent = Page::join('roles_pages', 'roles_pages.page_id', '=', 'pages.id')
        ->join('users_roles', 'users_roles.role_id', '=', 'roles_pages.role_id')
        ->where('users_roles.user_id', $this->id);
        if ($hideShow) $eloquent->whereNull('page_parent');
        return $eloquent->groupby('page_id')->get()->pluck('page_id');
    }

    public function getPageAutorized( $CINEMA = null, $hideShow = null) {
        $basePageAutorized = collect();
        if ($this->isSuperAdmin()){ // si administrateur de l'entreprise gerant le site
            $basePageAutorized = $basePageAutorized->merge(collect([config('global.PAGES.PAGE_LIST_CLIENT'), config('global.PAGES.PAGE_LIST_TYPE_CLIENT')]));
        }
        if ($CINEMA == null){// le cinema n'est pas selectionner donc page global
            return $basePageAutorized;
        } else {
            if ($this->isAdmin()){
                $CLIENT = Client::find($CINEMA->client_id);
                $eloquent = TypesClient::find($CLIENT->types_client_id)->pages();
                if ($hideShow) $eloquent->whereNull('page_parent');
                return $basePageAutorized->concat($eloquent->get()->pluck('id'));
            } else {
                return $this->getPageForRoleUser($hideShow);
            }
        }
    }

    public function roles(){
        return $this->belongsToMany(Role::class, 'users_roles');
    }

    public function del(){
        $this->roles()->detach();
        $this->delete(); 
    }

    public function getKey(){
        return Hash::make($this->email.$this->nom);
    }
    public function getBySlug($slug){
        return User::where('slug', $slug)->first();
    }

}
