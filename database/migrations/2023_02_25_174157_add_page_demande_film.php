<?php

use App\Models\page\Page;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Page::insert([
            'id' => 20,
            'nom' => 'Liste des demandes de films',
            'route' => 'demandeFilm.list',
            'pos' => 3,
            'categorie_page_id' => 1
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
