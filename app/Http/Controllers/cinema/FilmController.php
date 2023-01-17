<?php

namespace App\Http\Controllers\cinema;

use App\Models\page\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\utils\class\InformationPage;

class FilmController extends Controller
{
    public function list(Request $request, $cinema){
        $infosPage = new InformationPage(Page::find(12),$request, $cinema);

        return view('page_app.films.list', [
            'infosPage' => $infosPage
        ]);
    }
}
