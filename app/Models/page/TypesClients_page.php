<?php

namespace App\Models\page;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypesClients_page extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'types_client_id',
        'page_id'
    ];
}
