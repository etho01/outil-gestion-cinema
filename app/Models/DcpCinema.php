<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DcpCinema extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'cinema_id',
        'combinaison_option_id',
   ];
}
