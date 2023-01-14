<?php

namespace App\Models\client;

use App\Models\page\Page;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypesClient extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nom',
        "slug"
    ];

    public function pages(){
        return $this->belongsToMany(Page::class, 'types_clients_pages');
    }
}
