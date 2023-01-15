<?php

namespace App\Http\Controllers\gestion;

use App\Models\page\Page;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\client\TypesClient;
use App\Http\Controllers\Controller;
use App\utils\class\InformationPage;
use App\Models\page\TypesClients_page;
use App\utils\class\informationPageFormulaire;

class TypeClientController extends Controller
{
    public function list(Request $request, $cinema){
        $infosPage = new InformationPage(Page::find(14), $request, $cinema);

        return view('page_app.parametre.typeClient.list', [
            'infosPage' => $infosPage
        ]);
    }

    public function show(Request $request, $cinema, $slug){
        $infosPage = new informationPageFormulaire(Page::find(15), $request, $cinema, TypesClient::class, $slug);
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

    public function store(Request $request, $cinema){
        $TYPE_CLIENT = TypesClient::find((int) $request->input('id'));
        $request->validate([
            'nom' => ['required',
                    Rule::unique('types_clients')->ignore($TYPE_CLIENT),
                    'max:255',
                    Rule::notIn(['new', 'create', 'update', 'delete']),]
        ]);
        $infosPage = new InformationPage(Page::find(15), $request, $cinema);
        if ($request->input('id') == 0){ // si c'est un nouvel element
            $TYPE_CLIENT = TypesClient::create([
                'nom' => $request->input('nom'),
                'slug' => Str::of($request->input('nom'))->slug('-')
            ]);
        }
        $TYPE_CLIENT->pages()->detach();
        $tab_liste_query = $request->all();
        $tab_liste_page = array();
        foreach($tab_liste_query as $key => $query){
            if (str_contains($key, 'page_')){
                $TYPE_CLIENT->pages()->attach(str_replace('page_', '', $key));
            }
        }
        return redirect()->route('TypeClient.list', $infosPage->getinfosRoute())->withInput();

    }

    public function delete(Request $request, $cinema, $slug){
        $infosPage = new InformationPage(Page::find(15), $request, $cinema);
        $TYPE_CLIENT = TypesClient::getBySlug($slug);
        if ($TYPE_CLIENT != null) $TYPE_CLIENT->del();
        return redirect()->route('TypeClient.list', $infosPage->getinfosRoute())->withInput();
    }
}
