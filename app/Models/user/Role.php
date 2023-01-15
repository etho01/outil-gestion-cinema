<?php

namespace App\Models\user;

use App\Models\User;
use App\Models\page\Page;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nom',
        'is_admin',
        'client_id',
        'slug'
    ];

    public function pages(){
        return $this->morphToMany(Page::class, 'role', 'roles_pages');
    }

    public function users(){
        return $this->belongsToMany(User::class, 'users_roles');
    }

    public function del(){
        Roles_page::where('role_id', $this->id)->delete();
        $this->users()->detach();
        $this->delete();
    }
}
