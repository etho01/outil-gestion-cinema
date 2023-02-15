<?php

namespace App\Http\Controllers\cinema;

use App\Models\page\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\utils\class\InformationPage;

class KdmController extends Controller
{
    public function list(Request $request, $cinema){
        $infosPage = new InformationPage(Page::find(config('global.PAGES.PAGE_LIST_KDM')),$request, $cinema);

        return view('page_app.kdm.list', [
            'infosPage' => $infosPage
        ]);
    }
}
