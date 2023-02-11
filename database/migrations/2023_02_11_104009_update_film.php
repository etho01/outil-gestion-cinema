<?php

use App\Models\cinema\Cinema;
use App\Models\film\Option;
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
        Schema::table("films", function (Blueprint $table){
            $table->string('nom_film');
            $table->integer('id_imdb');
            $table->ForeignIdFor(Option::class, 'option_son')->nullable();
            $table->ForeignIdFor(Option::class, 'option_image')->nullable();
            $table->ForeignIdFor(Cinema::class);
        });
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
