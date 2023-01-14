<?php

namespace App\Http\Controllers\gestion;

use App\Models\page\Page;
use Illuminate\Http\Request;
use App\Models\client\Client;
use Illuminate\Validation\Rule;
use App\Models\client\TypesClient;
use App\Http\Controllers\Controller;
use App\utils\class\InformationPage;
use App\utils\class\informationPageFormulaire;

class ClientController extends Controller
{

    public function list(Request $request, $cinema){
        $infosPage = new InformationPage(Page::find(12),$request, $cinema);

        return view('page_app.parametre.client.list', [
            'infosPage' => $infosPage
        ]);
    }

    public function show(Request $request, $cinema, $slug){
        $infosPage = new informationPageFormulaire(Page::find(13),$request, $cinema,Client::class ,$slug);

        
        return view('page_app.parametre.client.show', [
            'infosPage' => $infosPage,
            'typeClient' => TypesClient::all()
        ]);
    }

    public function store(Request $request, $cinema){
        $CLIENT = Client::find($request->input('id'));
        $request->validate([
            'nom' => ['required',
                    Rule::unique('clients')->ignore($CLIENT),
                    'max:255',
                    Rule::notIn(['new', 'create', 'update'])],
            'type_client' => ['required', 'exists:types_clients,id'],
            'email' => ['required', 'email']
        ]); 

        if ($request->input('id') == 0){ // si c'est un nouvel element
            $CLIENT = Client::create([
                'nom' => $request->input('nom'),
                'slug' => Str::of($request->input('nom'))->slug('-'),
                'logo' => '1',
                'email' => $request->input('email')
            ]);
        }

        return redirect()->route('Client.list', $infosPage->getinfosRoute())->withInput();
    }
}
