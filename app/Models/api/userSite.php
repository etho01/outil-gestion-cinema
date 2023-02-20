<?php

namespace App\Models\api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userSite extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'email' ,
        'password',
        'cinema_id',
        'api_token'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];
}
