<?php

use App\Models\Salle;
use App\Models\CombinaisonOption;
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
        Schema::create('sceances', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(CombinaisonOption::class)->constrained();
            $table->foreignIdFor(Salle::class)->constrained();
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
        Schema::dropIfExists('sceances');
    }
};
