<?php

namespace App\Http\Controllers\cinema;

use App\Models\page\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\utils\class\InformationPage;

class GlobecastController extends Controller
{
     // affiche la vue de la page
    public function list(Request $request, $cinema){
        $infosPage = new InformationPage(Page::find(config('global.PAGES.PAGE_LIST_GLOBECAST')),$request, $cinema);

        return view('page_app.stockage.list', [
            'infosPage' => $infosPage
        ]);
    }
}
