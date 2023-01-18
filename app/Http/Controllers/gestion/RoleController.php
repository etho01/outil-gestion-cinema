<?php

namespace App\Http\Controllers\gestion;

use App\Models\page\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\utils\class\InformationPage;

class RoleController extends Controller
{
    public function list(Request $request, $cinema){
        $infosPage = new InformationPage(Page::find(config('global.PAGES.PAGE_LIST_ROLE')),$request, $cinema);

        return view('page_app.parametre.role.list', [
            'infosPage' => $infosPage
        ]);
    }
}
