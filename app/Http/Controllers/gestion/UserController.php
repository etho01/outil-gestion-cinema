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
use Illuminate\Support\Facades\Hash;
use App\Notifications\createUserNotification;
use App\utils\class\informationPageFormulaire;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    public function list(Request $request, $cinema){
        $infosPage = new InformationPage(Page::find(config('global.PAGES.PAGE_LIST_USER')),$request, $cinema);

        return view('page_app.user.list', [
            'infosPage' => $infosPage
        ]);
    }

    public function show(Request $request, $cinema, $slug){
        try {
            $infosPage = new informationPageFormulaire(Page::find(config('global.PAGES.PAGE_USER')),$request, $cinema ,User::class ,$slug);

            return view('page_app.user.show', [
                'infosPage' => $infosPage,
            ]);
        } catch (ModelNotFoundException $e){
            return redirect()->route('User.list', ['cinema' => $cinema]);
        }
    }

    public function viewProfile(Request $request, $slug){
        try {
            $infosPage = new informationPageFormulaire(Page::find(config('global.PAGES.PAGE_USER')),$request, null ,User::class ,$slug);

            return view('page_app.user.profile', [
                'infosPage' => $infosPage,
            ]);
        } catch (ModelNotFoundException $e){
            return redirect()->route('dashboard');
        }
    }

    public function add_password(Request $request, $slug, $key){
        $infosPage = new informationPageFormulaire(Page::find(config('global.PAGES.PAGE_USER')),$request, null ,User::class ,$slug);
        if ( !Hash::check($infosPage->getInfosInstance('email').$infosPage->getInfosInstance('nom'), $key) ) return redirect()->route('acceuil');
        if ($infosPage->getInfosInstance('is_validate') == 2) return redirect()->route('login');

        return view('page_app.user.new-profile', [
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
            $USER = User::create([
                'nom' => $request->input('nom'),
                'slug' => Str::of($request->input('nom'))->slug('-'),
                'email' => $request->input('email'),
                'is_validate' => '1',
                'client_id' => $infosPage->instanceCinema->client_id
            ]);

            $USER->notify(new createUserNotification());
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

    public function delete(Request $request, $cinema, $slug){
        $infosPage = new InformationPage(Page::find(config('global.PAGES.PAGE_LIST_USER')),$request, $cinema);
        $USER = User::where('slug', $slug)->first();
        if ($USER != null) $USER->del();
        return redirect()->route('User.list', $infosPage->getinfosRoute())->withInput();
    }

    public function update(Request $request){
        $USER = User::find((int) $request->input('id'));
        if ($request->input('id') == 0) return redirect()->route('login');
        $request->validate([
            'nom' => ['required',
                    Rule::unique('users')->ignore($USER),
                    'max:255',
                    Rule::notIn(['new', 'create', 'update', 'delete']),],
            'email' => ['required',
                'max:255',
                Rule::notIn(['new', 'create', 'update', 'delete']),],
            'password' => ['required'],
            'Checkpassword' => ['required', Rule::in([$request->input('password')])]
        ]);
        $USER->update([
            'nom' => $request->input('nom'),
            'slug' => Str::of($request->input('nom'))->slug('-'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'is_validate' => 2
        ]);
        return redirect()->route('dashboard');
    }
}
