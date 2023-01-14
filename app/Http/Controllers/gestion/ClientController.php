<?php

namespace App\Http\Controllers\gestion;

use App\Models\page\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\utils\class\InformationPage;

class ClientController extends Controller
{

    public function list(Request $request, $cinema, $salle){
        $infosPage = new InformationPage(Page::find(12),$request, $cinema, $salle);

        return view('page_app.parametre.client.list', [
            'infosPage' => $infosPage
        ]);
    }

    public function show(Request $request, $cinema, $salle, $slug){
        return '';
    }
}
