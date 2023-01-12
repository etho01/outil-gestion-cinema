<?php

namespace App\Http\Controllers\gestion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\utils\class\InformationPage;

class ClientController extends Controller
{

    public function list(Request $request, $cinema, $salle = null){
        $infosPage = new InformationPage($request, $cinema, $salle);

        return view('parametre.client.list', [
            'infosPage' => $infosPage
        ]);
    }

    public function show(Request $request){
        return '';
    }
}
