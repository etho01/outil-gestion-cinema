<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\page\Page;
use App\Models\user\Role;
use Laravel\Sanctum\HasApiTokens;
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

    public function getPageForRoleUser($hideShow){
        $eloquent = Page::join('roles_pages', 'roles_pages.page_id', '=', 'pages.id')
        ->join('users_roles', 'users_roles.role_id', '=', 'roles_pages.role_id')
        ->where('users_roles.user_id', $this->id);
        if ($hideShow) $eloquent->whereNull('page_parent');
        return $eloquent->groupby('page_id')->get()->pluck('page_id');
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

}
