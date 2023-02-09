<?php

namespace App\Models\film;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nom',
        'client_id',
        'type'
   ];
}
