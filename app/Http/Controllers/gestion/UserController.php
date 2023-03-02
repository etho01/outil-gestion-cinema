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
use App\Http\Requests\UserStoreTypePostRequest;
use App\Http\Requests\UserUpdateTypePostRequest;
use App\Http\Requests\ClientStoreTypePostRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

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
            if ($slug != 'new'){
                if ($infosPage->instanceCinema()->client_id != $infosPage->getInstanceWork()->client_id){
                    abort(404);
                }
            }
            return view('page_app.user.show', [
                'infosPage' => $infosPage,
            ]);
            
        } catch (ModelNotFoundException $e){
            return redirect()->route('User.list', ['cinema' => $cinema]);
        }
    }

    public function viewProfile(Request $request){ // page pour voir le profil
        try {
            $infosPage = new informationPageFormulaire(Page::find(config('global.PAGES.PAGE_USER')),$request, null ,User::class , Auth::user()->slug);

            return view('page_app.user.profile', [
                'infosPage' => $infosPage,
            ]);
        } catch (ModelNotFoundException $e){
            return redirect()->route('dashboard');
        }
    }

    public function add_password(Request $request, $user){ // page pour ajouter le mot de padde a la premeire connecion
        
        $infosPage = new informationPageFormulaire(Page::find(config('global.PAGES.PAGE_USER')),$request, null ,User::class ,$user);
        if ( ! $request->hasValidSignature()) return redirect()->route('login');
        if ($infosPage->getInfosInstance('is_validate') == 2) return redirect()->route('login');

        return view('page_app.user.new-profile', [
            'infosPage' => $infosPage,
        ]);
    }

    public function delete(Request $request, $cinema, $slug){
        $infosPage = new InformationPage(Page::find(config('global.PAGES.PAGE_LIST_USER')),$request, $cinema);
        $USER = User::where('slug', $slug)->first();
        if ($USER != null) $USER->del();
        return redirect()->route('User.list', $infosPage->getinfosRoute())->withInput();
    }

    public function store(UserStoreTypePostRequest $request, $cinema){
        $USER = User::find((int) $request->input('id'));
        $infosPage = new InformationPage(Page::find(config('global.PAGES.PAGE_LIST_USER')),$request, $cinema);
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

    public function update(UserUpdateTypePostRequest $request){
        $USER = User::find((int) $request->input('id'));
        if ($request->input('id') == 0) return redirect()->route('login');

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
