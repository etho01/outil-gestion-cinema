<?php

use App\Models\film\Film;
use App\Models\film\CombinaisonOption;
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
        Schema::create('dcp_cinemas', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(CombinaisonOption::class)->constrained();
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
        Schema::dropIfExists('dcp_cinemas');
    }
};
