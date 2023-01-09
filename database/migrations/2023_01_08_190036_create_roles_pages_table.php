<?php

use App\Models\Page;
use App\Models\Role;
use App\Models\Salle;
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
        Schema::create('roles_pages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Role::class)->constrained();
            $table->foreignIdFor(Page::class)->constrained();
            $table->ForeignIdFor(Salle::class)->constrained();
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
        Schema::dropIfExists('roles_pages');
    }
};
