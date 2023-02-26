<?php

namespace App\Http\Controllers\gestion;

use App\Models\page\Page;
use Illuminate\Support\Str;
use App\Models\cinema\Salle;
use Illuminate\Http\Request;
use App\Models\cinema\Cinema;
use App\Models\client\Client;
use Illuminate\Validation\Rule;
use App\Models\client\TypesClient;
use App\Http\Controllers\Controller;
use App\utils\class\InformationPage;
use App\Http\Requests\ClientPostRequest;
use App\utils\class\informationPageFormulaire;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ClientController extends Controller
{
     // affiche la vue de la page
    public function list(Request $request){
        $infosPage = new InformationPage(Page::find(12),$request, null);

        return view('page_app.parametre.client.list', [
            'infosPage' => $infosPage
        ]);
    }

    //affiche la page specifique a l'element
    public function show(Request $request, $slug){
        try {
            $infosPage = new informationPageFormulaire(Page::find(13),$request, null ,Client::class ,$slug);

            return view('page_app.parametre.client.show', [
                'infosPage' => $infosPage,
                'typeClient' => TypesClient::all()
            ]);
        } catch (ModelNotFoundException $e){
            return redirect()->route('Client.list');
        }
    }

    //suvegarde l'element
    public function store(ClientPostRequest $request){
        $infosPage = new InformationPage(Page::find(12),$request, null);
        $CLIENT = Client::find($request->input('id'));

        if ($request->input('id') == 0){ // si c'est un nouvel element
            $CLIENT = Client::create([
                'nom' => $request->input('nom'),
                'slug' => Str::of($request->input('nom'))->slug('-')->value(),
                'logo' => '1',
                'email' => $request->input('email'),
                'types_client_id' => $request->input('type_client')
            ]);
        } else { // si c'est un elemet deja existant
            $CLIENT->update([
                'nom' => $request->input('nom'),
                'slug' => Str::of($request->input('nom'))->slug('-')->value(),
                'logo' => '1',
                'email' => $request->input('email'),
                'types_client_id' => $request->input('type_client')
            ]);
        }
        $tab_liste_query = $request->all();
        $tab_liste_cinema = array();
        $nbCine = 0;
        foreach ($tab_liste_query as $keyinput => $value){ // creation des cinemas
            if (str_contains($keyinput, 'cine')){
                $id_cinema_app = str_replace('cine', '', $keyinput);
                $tab_liste_cinema[$nbCine]['id'] = $id_cinema_app;
                $tab_liste_cinema[$nbCine]['nom'] = $value;
                $tab_liste_cinema[$nbCine]['listeSalle'] = array();
                $nbSalle = 0;
                foreach ($tab_liste_query as $keyinputSalle => $valueSalle){ // creation des salle en fonction du cinema
                    if (str_contains($keyinputSalle, 'salle'.$id_cinema_app.'-')){
                        $id_salle_app = str_replace('salle'.$id_cinema_app.'-', '', $keyinputSalle);
                        $tab_liste_cinema[$nbCine]['listeSalle'][$nbSalle]['id'] = $id_salle_app;
                        $tab_liste_cinema[$nbCine]['listeSalle'][$nbSalle]['nom'] = $valueSalle;
                    }
                    $nbSalle ++;
                }
            }
            $nbCine++;
        }
        $CLIENT->updateCinemaClient($tab_liste_cinema); // mise a jour des salles et der cinemas

        return redirect()->route('Client.list', $infosPage->getinfosRoute())->withInput();
    }

    public function delete(Request $request, $slug){
        $infosPage = new InformationPage(Page::find(15), $request, null);
        $CLIENT = Client::getBySlug($slug);
        if ($CLIENT != null) $CLIENT->del();
        return redirect()->route('Client.list', $infosPage->getinfosRoute())->withInput();
    }
}
