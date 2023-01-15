<?php

namespace App\Models\client;

use App\Models\page\Page;
use App\Models\client\TypesClient;
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

    public function clients(){
        return $this->hasMany(Client::class);
    }

    public static function getBySlug($slug){
        return TypesClient::where('slug', $slug)->first();
    } 

    public function del(){
        $clients = $this->clients()->get();
        foreach ($clients as $client) $client->del();
        $this->pages()->detach();
        $this->delete();
    }

}
