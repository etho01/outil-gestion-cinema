<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nom_page',
        'pos_page', // la possition de la page ,
        'page_parent', // si c'est null alors la page est invisible
        'categoriesPages_id'
    ];
}
