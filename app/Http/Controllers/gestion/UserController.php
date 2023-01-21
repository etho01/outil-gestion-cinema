<?php

namespace App\Http\Controllers\gestion;

use App\Models\User;
use App\Models\page\Page;
use App\Models\user\Role;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\utils\class\InformationPage;
use App\utils\class\informationPageFormulaire;

class UserController extends Controller
{
    public function list(Request $request, $cinema){
        $infosPage = new InformationPage(Page::find(config('global.PAGES.PAGE_LIST_USER')),$request, $cinema);

        return view('page_app.user.list', [
            'infosPage' => $infosPage
        ]);
    }

    public function show(Request $request, $cinema, $slug){
        $infosPage = new informationPageFormulaire(Page::find(config('global.PAGES.PAGE_USER')),$request, $cinema ,User::class ,$slug);

        return view('page_app.user.show', [
            'infosPage' => $infosPage,
        ]);
    }

    public function store(Request $request, $cinema){
        $USER = User::find((int) $request->input('id'));
        $infosPage = new InformationPage(Page::find(config('global.PAGES.PAGE_LIST_USER')),$request, $cinema);
        $request->validate([
            'nom' => ['required',
                    Rule::unique('users')->ignore($USER),
                    'max:255',
                    Rule::notIn(['new', 'create', 'update', 'delete']),],
            'email' => ['required',
                'max:255',
                Rule::notIn(['new', 'create', 'update', 'delete']),]
        ]);
        if ($request->input('id') == 0){ // si c'est un nouvel element
            $USER = TypesClient::create([
                'nom' => $request->input('nom'),
                'slug' => Str::of($request->input('nom'))->slug('-'),
                'email' => $request->input('email')
            ]);
        } else {
            $USER->update([
                'nom' => $request->input('nom'),
                'slug' => Str::of($request->input('nom'))->slug('-'),
                'email' => $request->input('email')
            ]);
        }
        $USER->roles()->detach();
        $tab_liste_query = $request->all();
        foreach ($tab_liste_query as $nom => $value){
            if (str_contains($nom,'role_')){
                $USER->roles()->attach(str_replace('role_', '', $nom));
            }
        }
        return redirect()->route('User.list', $infosPage->getinfosRoute())->withInput();
    }
}
