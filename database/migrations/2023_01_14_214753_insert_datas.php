<?php

use App\Models\User;
use App\Models\page\Page;
use App\Models\user\Role;
use App\Models\user\Users_role;
use App\Models\client\Client;
use App\Models\client\TypesClient;
use App\Models\page\CategoriePage;
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
        TypesClient::insert([
            'id' => 1,
            'nom' => 'admin',
            'slug' => 'admin'
        ]);
        Client::insert([
            'id' => 1,
            'nom' => 'gestionnaire',
            'logo' => 'logo',
            'email'=> 'barbeynicolas.basly@gmail.com',
            'slug' => 'gestionnaire',
            'types_client_id' => 1
        ]);
        Role::insert([
            'id' => 1,
            'nom' => 'administrateur',
            'is_admin' => '2',
            'client_id' => 1
        ]);
        User::insert([
            'id' => 1,
            'nom' => 'test',
            'email' => 'test@test.fr',
            'client_id' => 1,
            'password' => Hash::make('testtest'),
            'slug' => 'test',
        ]);
        Users_role::insert([
            'user_id' => 1,
            'role_id' => 1
        ]);
        CategoriePage::insert([
            'id' => 1,
            'icone' => 'fa-solid fa-film',
            'nom' => 'films',
            'pos_categorie' => 1
        ]);
        CategoriePage::insert([
            'id' => 2,
            'icone' => 'fa-solid fa-key',
            'nom' => 'KDM',
            'pos_categorie' => 3
        ]);
        CategoriePage::insert([
            'id' => 3,
            'icone' => "fa-solid fa-server",
            'nom' => 'Serveur',
            'pos_categorie' => 4
        ]);
        CategoriePage::insert([
            'id' => 4,
            'icone' => "fa-solid fa-cloud",
            'nom' => 'Globecast',
            'pos_categorie' => 5
        ]);
        CategoriePage::insert([
            'id' => 5,
            'icone' => 'fa-solid fa-compact-disc',
            'nom' => 'DCP',
            'pos_categorie' => 6
        ]);
        CategoriePage::insert([
            'id' => 6,
            'icone' => "fa-solid fa-hard-drive",
            'nom' => 'NAS',
            'pos_categorie' => 7
        ]);
        CategoriePage::insert([
            'id' => 7,
            'icone' => "fa-solid fa-user",
            'nom' => 'User',
            'pos_categorie' => 8
        ]);
        CategoriePage::insert([
            'id' => 8,
            'icone' => 'fa-solid fa-gear',
            'nom' => 'Parametre',
            'pos_categorie' => 9
        ]);
        CategoriePage::insert([
            'id' => 9,
            'icone' => 'fa-solid fa-circle-play',
            'nom' => 'Seance',
            'pos_categorie' => 2
        ]);
        Page::insert([
            'id' => 16,
            'nom' => 'Liste sceance',
            'route' => 'Sceance.list',
            'pos' => 1,
            'categorie_page_id' => 9,
        ]);
        Page::insert([
            'id' => 1,
            'nom' => 'Liste film version',
            'route' => 'Film.list',
            'pos' => 1,
            'categorie_page_id' => 1,
        ]);
        Page::insert([
            'id' => 2,
            'nom' => 'Film',
            'route' => 'Film.show',
            'page_parent' => 1,
            'categorie_page_id' => 1
        ]);
        Page::insert([
            'id' => 3,
            'nom' => 'Liste KDM',
            'route' => 'Kdm.list',
            'pos' => 1,
            'categorie_page_id' => 2
        ]);
        Page::insert([
            'id' => 4,
            'nom' => 'Liste Film Serveur',
            'route' => 'Serveur.list',
            'pos' => 1,
            'categorie_page_id' => 3
        ]);
        Page::insert([
            'id' => 5,
            'nom' => 'Liste Film Globecast',
            'route' => 'Globecast.list',
            'pos' => 1,
            'categorie_page_id' => 4
        ]);
        Page::insert([
            'id' => 6,
            'nom' => 'liste DCP',
            'route' => 'Dcp.list',
            'pos' => 1,
            'categorie_page_id' => 5
        ]);
        Page::insert([
            'id' => 7,
            'nom' => 'liste NAS',
            'route' => 'Nas.list',
            'pos' => 1,
            'categorie_page_id' => 6
        ]);
        Page::insert([
            'id' => 8,
            'nom' => 'liste User',
            'route' => 'User.list',
            'pos' => 1,
            'categorie_page_id' => 7
        ]);
        Page::insert([
            'id' => 9,
            'nom' => 'User',
            'route' => 'User.show',
            'page_parent' => 8,
            'categorie_page_id' => 7
        ]);
        Page::insert([
            'id' => 10,
            'nom' => 'Liste Role',
            'route' => 'Role.list',
            'pos' => 3,
            'categorie_page_id' => 8
        ]);
        Page::insert([
            'id' => 11,
            'nom' => 'Role',
            'route' => 'Role.show',
            'page_parent' => 10,
            'categorie_page_id' => 8
        ]);
        Page::insert([
            'id' => 12,
            'nom' => 'Liste Client',
            'route' => 'Client.list',
            'pos' => 4,
            'categorie_page_id' => 8
        ]);
        Page::insert([
            'id' => 13,
            'nom' => 'Client',
            'route' => 'Client.show',
            'page_parent' => 12,
            'categorie_page_id' => 8
        ]);
        Page::insert([
            'id' => 14,
            'nom' => 'Liste type client',
            'route' => 'TypeClient.list',
            'pos' => 5,
            'categorie_page_id' => 8
        ]);
        Page::insert([
            'id' => 15,
            'nom' => 'Type Client',
            'route' => 'TypeClient.show',
            'page_parent' => 14,
            'categorie_page_id' => 8
        ]);
        Page::insert([
            'id' => 17,
            'nom' => 'Liste distributeur',
            'route' => 'Distributeur.list',
            'pos' => 2,
            'categorie_page_id' => 8
        ]);
        Page::insert([
            'id' => 18,
            'nom' => 'Liste Options',
            'route' => 'Options.list',
            'pos' => 1,
            'categorie_page_id' => 8
        ]);
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
