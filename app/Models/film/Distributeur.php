<?php

namespace App\Models\film;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Distributeur extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nom',
   ];

   public function mail($id_client){
    return DB::table('client_distributeur')->select('mail')->where('distributeur_id', $this->id)->where('client_id', $id_client)->first()->mail;
   }

   public function updateMail($id_client, $newMail){
    DB::table('client_distributeur')->where('distributeur_id', $this->id)->where('client_id', $id_client)->update(['mail' => $newMail]);
   }
   public function insertMail($id_client, $newMail){
    DB::table('client_distributeur')->insert([
        'distributeur_id' => $this->id,
        'client_id' => $id_client,
        'mail' => $newMail
    ]);
   }
}
