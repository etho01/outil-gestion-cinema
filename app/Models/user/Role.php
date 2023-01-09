<?php

namespace App\Models\user;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nom',
        'is_admin',
        'client_id',
    ];

    public function pages(){
        return $this->morphToMany(Page::class, 'paggable');
    }
}
