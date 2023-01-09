<?php

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
        Schema::create('combinaison_stockage_elements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignIdFor(CombinaisonOption::class)->constrained();
            $table->foreignIdFor(StockageElement::class)->constrained();
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
        Schema::dropIfExists('combinaison_stockage_elements');
    }
};
