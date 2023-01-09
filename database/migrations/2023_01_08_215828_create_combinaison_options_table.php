<?php

use App\Models\Film;
use App\Models\Option;
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
        Schema::create('combinaison_options', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Option::class)->constrained();
            $table->foreignIdFor(Film::class)->constrained();
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
        Schema::dropIfExists('combinaison_options');
    }
};
