<?php

namespace App\Models\page;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriePage extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nom',
        'icone',
    ];
}
