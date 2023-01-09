<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockageElement extends Model
{
    use HasFactory;

    protected $fillable = [
        'combinaison_option_id',
        'stockage_element_id',
        'type',
    ];
}
