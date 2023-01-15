<?php

namespace App\Models\page;

use App\Models\page\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoriePage extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nom',
        'icone',
    ];

    public function pages(){
        return $this->hasMany(Page::class);
    }
}
