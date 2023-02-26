<?php

namespace App\Http\Controllers\gestion;

use App\Models\page\Page;
use App\Models\user\Role;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\utils\form\OptionForm;
use App\Models\user\Roles_page;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\utils\class\InformationPage;
use App\Http\Requests\RolePostRequest;
use App\utils\class\informationPageFormulaire;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RoleController extends Controller
{
    public function list(Request $request, $cinema){
        $infosPage = new InformationPage(Page::find(config('global.PAGES.PAGE_LIST_ROLE')),$request, $cinema);

        return view('page_app.parametre.role.list', [
            'infosPage' => $infosPage
        ]);
    }

    public function show(Request $request,$cinema ,$slug){
        try {
            $infosPage = new informationPageFormulaire(Page::find(config('global.PAGES.PAGE_ROLE')),$request, $cinema ,Role::class ,$slug);

            if ($infosPage->instanceCinema()->client_id != $infosPage->getInstanceWork()->client_id){
                abort(404);
            }

            $cinemas = $infosPage->instanceCinema()->getCinemaClient()->get();
            $tabEnable = array();
            foreach ($cinemas as $cinema){
                if ($infosPage->isNewElement()){
                    $tabEnable[$cinema->id] = array();
                } else {
                    $tabEnable[$cinema->id] = $infosPage->getInstanceWork()->getPagePerCinema($cinema->id);
                }
            }
            return view('page_app.parametre.role.show', [
                'infosPage' => $infosPage,
                'ListElementAdmin' => OptionForm::getOptionOuiNon(),
                'listePageAutorized' => $infosPage->instanceCinema()->getClient()->getPageAutorized()->get()->pluck('id'), // les pages accesible pour le client
                'tabEnable' => $tabEnable
            ]);
        } catch (ModelNotFoundException $e){
            return redirect()->route('Role.list', ['cinema' => $cinema]);
        }
    }

    public function store(RolePostRequest $request, $cinema){
        $infosPage = new InformationPage(Page::find(config('global.PAGES.PAGE_LIST_ROLE')),$request, $cinema);
        $ROLE = Role::find($request->input('id'));

        if ($request->input('id') == 0){
            $ROLE = Role::create([
                'nom' => $request->input('nom'),
                'is_admin' => $request->input('is_admin'),
                'slug' => Str::slug($request->input('nom')),
                'client_id' => $infosPage->instanceCinema()->client_id,
            ]);
        } else {
            $ROLE->update([
                'nom' => $request->input('nom'),
                'is_admin' => $request->input('is_admin'),
                'slug' => Str::slug($request->input('nom')),
            ]);
        }

        $tab_liste_query = $request->all();
        Roles_page::where('role_id', $ROLE->id)->delete();
        foreach($tab_liste_query as $nom => $value){
            if (str_contains($nom, "page_")){
                $infosPageCine = explode('_', str_replace("page_", '', $nom));
                Roles_page::create([
                    'role_id' => $ROLE->id,
                    'cinema_id' => $infosPageCine[0],
                    'page_id' => $infosPageCine[1]
                ]);
            }
        }
        return redirect()->route('Role.list', $infosPage->getinfosRoute())->withInput();
    }

    public function delete(Request $request, $cinema, $slug){
        $ROLE = Role::where('slug', $slug);
        $ROLE->del();
    }
}
