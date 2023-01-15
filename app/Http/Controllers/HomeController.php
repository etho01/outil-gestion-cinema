<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\utils\class\InformationPage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request){
        $infosPage = new InformationPage(null,$request, null);

        return view('dashboard', [
            'infosPage' => $infosPage
        ]);
    }
}
