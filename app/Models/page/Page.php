<?php

namespace App\Models\page;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nom',
        'route',
        'pos', // la possition de la page ,
        'page_parent', // si c'est null alors la page est invisible
        'categoriesPages_id'
    ];
}
