<?php

namespace App\Http\Controllers\cinema;

use App\Models\page\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\utils\class\InformationPage;

class FilmController extends Controller
{
    public function list(Request $request){
        $infosPage = new InformationPage(Page::find(12),$request, null);

        return view('page_app.parametre.client.list', [
            'infosPage' => $infosPage
        ]);
    }
}
