<?php

namespace App\Http\Controllers\cinema;

use App\Models\page\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\utils\class\InformationPage;

class SceanceController extends Controller
{
    public function list(Request $request, $cinema){
        $infosPage = new InformationPage(Page::find(config('global.PAGES.PAGE_LISTE_SCEANCE')),$request, $cinema);

        return view('page_app.sceance.list', [
            'infosPage' => $infosPage
        ]);
    }
}
