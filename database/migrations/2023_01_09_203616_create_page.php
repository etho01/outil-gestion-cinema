<?php

use App\Models\page\Page;
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
            'route' => 'listeFilm',
            'pos' => 1,
            'categorie_page_id' => 1,
        ]);
        Page::insert([
            'id' => 2,
            'nom' => 'Film',
            'route' => 'Film',
            'page_parent' => 1,
            'categorie_page_id' => 1
        ]);
        Page::insert([
            'id' => 3,
            'nom' => 'Liste KDM',
            'route' => 'listeKdm',
            'pos' => 1,
            'categorie_page_id' => 2
        ]);
        Page::insert([
            'id' => 4,
            'nom' => 'Liste Film Serveur',
            'route' => 'listeServ',
            'pos' => 1,
            'categorie_page_id' => 3
        ]);
        Page::insert([
            'id' => 5,
            'nom' => 'Liste Film Globecast',
            'route' => 'listeGlobecast',
            'pos' => 1,
            'categorie_page_id' => 4
        ]);
        Page::insert([
            'id' => 6,
            'nom' => 'liste DCP',
            'route' => 'listeDcp',
            'pos' => 1,
            'categorie_page_id' => 5
        ]);
        Page::insert([
            'id' => 7,
            'nom' => 'liste NAS',
            'route' => 'listeNas',
            'pos' => 1,
            'categorie_page_id' => 6
        ]);
        Page::insert([
            'id' => 8,
            'nom' => 'liste User',
            'route' => 'listeUser',
            'pos' => 1,
            'categorie_page_id' => 7
        ]);
        Page::insert([
            'id' => 9,
            'nom' => 'User',
            'route' => 'User',
            'page_parent' => 9,
            'categorie_page_id' => 7
        ]);
        Page::insert([
            'id' => 10,
            'nom' => 'Liste Role',
            'route' => 'listRole',
            'pos' => 1,
            'categorie_page_id' => 8
        ]);
        Page::insert([
            'id' => 11,
            'nom' => 'Role',
            'route' => 'Role',
            'page_parent' => 10,
            'categorie_page_id' => 8
        ]);
        Page::insert([
            'id' => 12,
            'nom' => 'Liste Client',
            'route' => 'listClient',
            'pos' => 2,
            'categorie_page_id' => 8
        ]);
        Page::insert([
            'id' => 13,
            'nom' => 'Client',
            'route' => 'Client',
            'page_parent' => 12,
            'categorie_page_id' => 8
        ]);
        Page::insert([
            'id' => 14,
            'nom' => 'Liste type client',
            'route' => 'ListeTypeClient',
            'pos' => 3,
            'categorie_page_id' => 8
        ]);
        Page::insert([
            'id' => 15,
            'nom' => 'Type Client',
            'route' => 'TypeCLient',
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
        
    }
};
