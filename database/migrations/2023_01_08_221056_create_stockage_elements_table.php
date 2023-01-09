<?php

use App\Models\Salle;
use App\Models\StockageElement;
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
        Schema::create('stockage_elements', function (Blueprint $table) {
            $table->id();
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
        Schema::dropIfExists('stockage_elements');
    }
};
