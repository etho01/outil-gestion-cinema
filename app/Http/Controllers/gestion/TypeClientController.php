<?php

namespace App\Http\Controllers\gestion;

use App\Models\page\Page;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\client\TypesClient;
use App\Models\page\TypesClients_page;
use App\Http\Controllers\Controller;
use App\utils\class\InformationPage;
use App\utils\class\informationPageFormulaire;

class TypeClientController extends Controller
{
    public function list(Request $request, $cinema, $salle){
        $infosPage = new InformationPage(Page::find(14), $request, $cinema, $salle);

        return view('page_app.parametre.typeClient.list', [
            'infosPage' => $infosPage
        ]);
    }

    public function show(Request $request, $cinema, $salle, $slug){
        $infosPage = new informationPageFormulaire(Page::find(15), $request, $cinema, $salle, TypesClient::class, $slug);
        if ($slug == 'new'){
            $listPagesEnable = collect();
        } else {
            $listPagesEnable = $infosPage->getInstanceWork()->pages()->get()->pluck('id');
        }
        $listPageAutorized = Page::all()->pluck('id');

        return view('page_app.parametre.typeClient.show', [
            'infosPage' => $infosPage,
            'listPageAutorized' => $listPageAutorized,
            'listPagesEnable' => $listPagesEnable
        ]);
    }

    public function store(Request $request, $cinema, $salle){
        $infosPage = new InformationPage(Page::find(15), $request, $cinema, $salle);
        if ($request->input('id') == 0){ // si 
            $TYPE_CLIENT = TypesClient::create([
                'nom' => $request->input('nom'),
                'slug' => Str::of($request->input('nom'))->slug('-')
            ]);
        } else {
            $TYPE_CLIENT = TypesClient::find((int) $request->input('id'));
        }
        $tab_liste_query = $request->all();
        $tab_liste_page = array();
        foreach($tab_liste_query as $key => $query){
            if (str_contains($key, 'page_')){
                TypesClients_page::insert([
                    'types_client_id' => $TYPE_CLIENT->id,
                    'page_id' => str_replace('page_', '', $key)
                ]);
            }
        }
        return redirect()->route('Salle.TypeClient.list', $infosPage->getinfosRoute())->withInput();

    }
}
