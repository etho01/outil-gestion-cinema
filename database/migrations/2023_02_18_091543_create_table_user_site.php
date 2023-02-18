<?php

use App\Models\api\userSite;
use App\Models\cinema\Cinema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_sites', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('email');
            $table->string('password');
            $table->string('api_token');
            $table->foreignIdFor(Cinema::class)->constrained();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('demande_films', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(userSite::class)->constrained();
            $table->integer('id_imdb');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('demande_films');
        Schema::dropIfExists('user_sites');
    }
};
