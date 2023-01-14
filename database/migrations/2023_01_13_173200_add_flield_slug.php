<?php

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
        Schema::table('types_clients', function (Blueprint $table) {
            $table->string('slug')->unique();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->string('slug');
        });
        Schema::table('clients', function (Blueprint $table) {
            $table->string('slug')->unique();
        });
        Schema::table('cinemas', function (Blueprint $table) {
            $table->string('slug')->unique();
        });
        Schema::table('salles', function (Blueprint $table) {
            $table->string('slug');
        });
        Schema::table('films', function (Blueprint $table) {
            $table->string('slug')->unique();
        });
        Schema::table('roles', function (Blueprint $table) {
            $table->string('slug');
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
