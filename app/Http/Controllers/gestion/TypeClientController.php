<?php

namespace App\Http\Controllers\gestion;

use App\Models\page\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\utils\class\InformationPage;

class TypeClientController extends Controller
{
    public function list(Request $request, $cinema, $salle = null){
        $infosPage = new InformationPage(Page::find(14), $request, $cinema, $salle);

        return view('page_app.parametre.typeClient.list', [
            'infosPage' => $infosPage
        ]);
    }

    public function show(Request $request, $cinema, $slug, $salle = null){
        $infosPage = new InformationPage(Page::find(15), $request, $cinema, $salle);

        return view('page_app.parametre.typeClient.list', [
            'infosPage' => $infosPage
        ]);
    }
}
