<?php

use App\Models\page\Page;
use App\Models\client\TypesClient;
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
        Schema::create('types_clients_pages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(TypesClient::class)->constrained();;
            $table->foreignIdFor(Page::class)->constrained();;
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
        Schema::dropIfExists('types_clients_pages');
    }
};
