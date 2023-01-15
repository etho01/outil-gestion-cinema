<?php

use App\Models\User;
use App\Models\film\Film;
use App\Models\page\Page;
use App\Models\user\Role;
use App\Models\film\Option;
use App\Models\cinema\Salle;
use App\Models\cinema\Cinema;
use App\Models\client\Client;
use App\Models\film\Distributeur;
use App\Models\client\TypesClient;
use App\Models\page\CategoriePage;
use App\Models\cinema\StockageElement;
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
        Schema::create('types_clients', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('slug')->unique();
            $table->timestamps();
        });
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(TypesClient::class)->constrained();
            $table->string('nom');
            $table->string('logo');
            $table->string('email');
            $table->string('slug')->unique();
            $table->timestamps();
        });
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignIdFor(Client::class)->constrained();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('slug');
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->boolean('is_admin');
            $table->string('slug');
            $table->foreignId('client_id')->constrained();
            $table->timestamps();
        });
        Schema::create('categorie_pages', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->unique();
            $table->string('icone');
            $table->timestamps();
        });
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('route')->unique();
            $table->integer('pos')->nullable();
            $table->integer('page_parent')->nullable();
            $table->foreignIdFor(CategoriePage::class)->constrained();;
            $table->timestamps();
        });
        Schema::create('types_clients_pages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(TypesClient::class)->constrained();;
            $table->foreignIdFor(Page::class)->constrained();;
            $table->timestamps();
        });
        Schema::create('cinemas', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('slug')->unique();
            $table->ForeignIdFor(Client::class)->constrained();;
            $table->timestamps();
        });
        Schema::create('salles', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->ForeignIdFor(Cinema::class)->constrained();
            $table->timestamps();
        });
        Schema::create('roles_pages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Role::class)->constrained();
            $table->foreignIdFor(Page::class)->constrained();
            $table->ForeignIdFor(Cinema::class)->constrained();
            $table->timestamps();
        });
        Schema::create('distributeurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('mail');
            $table->timestamps();
        });
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->dateTime('durree');
            $table->string('nom');
            $table->ForeignIdFor(Distributeur::class)->constrained();
            $table->timestamps();
        });
        Schema::create('options', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->timestamps();
        });
        Schema::create('combinaison_options', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Option::class)->constrained();
            $table->foreignIdFor(Film::class)->constrained();
            $table->timestamps();
        });
        Schema::create('dcp_cinemas', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(CombinaisonOption::class)->constrained();
            $table->foreignIdFor(Film::class)->constrained();
            $table->timestamps();
        });
        Schema::create('stockage_elements', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Salle::class)->constrained();
            $table->integer('type');
            $table->timestamps();
        });
        Schema::create('combinaison_stockage_elements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignIdFor(CombinaisonOption::class)->constrained();
            $table->foreignIdFor(StockageElement::class)->constrained();
            $table->timestamps();
        });
        Schema::create('sceances', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(CombinaisonOption::class)->constrained();
            $table->foreignIdFor(Salle::class)->constrained();
            $table->timestamps();
        });
        Schema::create('kdms', function (Blueprint $table) {
            $table->id();
            $table->date('date_debut');
            $table->date('date_fin');
            $table->foreignIdFor(CombinaisonOption::class)->constrained();
            $table->timestamps();
        });
        Schema::create('users_roles', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained();
            $table->foreignIdFor(Role::class)->constrained();
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

        Schema::dropIfExists('kdm');
        Schema::dropIfExists('sceances');
        Schema::dropIfExists('combinaison_stockage_elements');
        Schema::dropIfExists('stockage_elements');
        Schema::dropIfExists('dcp_cinemas');
        Schema::dropIfExists('combinaison_options');
        Schema::dropIfExists('options');
        Schema::dropIfExists('films');
        Schema::dropIfExists('distributeurs');
        Schema::dropIfExists('roles_pages');
        Schema::dropIfExists('salles');
        Schema::dropIfExists('cinemas');
        Schema::dropIfExists('types_clients_pages');
        Schema::dropIfExists('pages');
        Schema::dropIfExists('categorie_pages');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('clients');
        Schema::dropIfExists('types_clients');
    }
};
