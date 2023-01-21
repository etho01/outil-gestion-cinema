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
            'nom' => 'films'
        ]);
        CategoriePage::insert([
            'id' => 2,
            'icone' => 'fa-solid fa-key',
            'nom' => 'KDM'
        ]);
        CategoriePage::insert([
            'id' => 3,
            'icone' => "fa-solid fa-server",
            'nom' => 'Serveur'
        ]);
        CategoriePage::insert([
            'id' => 4,
            'icone' => "fa-solid fa-cloud",
            'nom' => 'Globecast'
        ]);
        CategoriePage::insert([
            'id' => 5,
            'icone' => 'fa-solid fa-compact-disc',
            'nom' => 'DCP'
        ]);
        CategoriePage::insert([
            'id' => 6,
            'icone' => "fa-solid fa-hard-drive",
            'nom' => 'NAS'
        ]);
        CategoriePage::insert([
            'id' => 7,
            'icone' => "fa-solid fa-user",
            'nom' => 'User'
        ]);
        CategoriePage::insert([
            'id' => 8,
            'icone' => 'fa-solid fa-gear',
            'nom' => 'Paramentre'
        ]);
        Page::insert([
            'id' => 1,
            'nom' => 'Liste film',
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
            'page_parent' => 9,
            'categorie_page_id' => 7
        ]);
        Page::insert([
            'id' => 10,
            'nom' => 'Liste Role',
            'route' => 'Role.list',
            'pos' => 1,
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
            'pos' => 2,
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
            'pos' => 3,
            'categorie_page_id' => 8
        ]);
        Page::insert([
            'id' => 15,
            'nom' => 'Type Client',
            'route' => 'TypeClient.show',
            'page_parent' => 14,
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
