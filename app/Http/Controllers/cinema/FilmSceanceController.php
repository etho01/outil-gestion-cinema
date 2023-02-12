<?php

namespace App\Http\Controllers\cinema;

use App\Models\page\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\utils\class\InformationPage;

class FilmSceanceController extends Controller
{
    public function list(Request $request, $cinema){
        $infosPage = new InformationPage(Page::find(config('global.PAGES.PAGE_LISTE_FILM')),$request, $cinema);

        return view('page_app.films.films_sceance.list', [
            'infosPage' => $infosPage
        ]);
    }
}
