<?php

namespace App\Models\user;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles_page extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_id',
        'page_id',
        'salle_id'
    ];
}
