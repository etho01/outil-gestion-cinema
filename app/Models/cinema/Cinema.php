<?php

namespace App\Models\cinema;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cinema extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nom',
        'client_id',
        'slug'
    ];
}
