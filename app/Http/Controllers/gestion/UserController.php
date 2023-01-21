<?php

namespace App\Http\Controllers\gestion;

use App\Models\page\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\utils\class\InformationPage;

class UserController extends Controller
{
    public function list(Request $request, $cinema){
        $infosPage = new InformationPage(Page::find(config('global.PAGES.PAGE_LIST_USER')),$request, $cinema);

        return view('page_app.user.list', [
            'infosPage' => $infosPage
        ]);
    }
}
