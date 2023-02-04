<?php

namespace App\Http\Controllers\cinema;

use App\Models\page\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\utils\class\InformationPage;

class DistributeurController extends Controller
{
    public function list(Request $request, $cinema){
        $infosPage = new InformationPage(Page::find(config('global.PAGES.PAGE_LISTE_DISTRIBUTEUR')),$request, $cinema);

        return view('page_app.parametre.distributeur.list', [
            'infosPage' => $infosPage
        ]);
    }
}
