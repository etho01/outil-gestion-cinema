<?php

use Illuminate\Http\Request;
use App\Models\api\demandeFilm;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\filmContolleur;
use App\Http\Controllers\api\userController;
use App\Http\Controllers\api\seanceContolleur;
use App\Http\Controllers\api\demandeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::prefix('{idCinema}')->group(function(){
    Route::prefix('seances')->controller(seanceContolleur::class)->group(function(){
        Route::get('getByFilm', 'getSeancesOrderByFilms');
    });

    Route::prefix('films')->controller(filmContolleur::class)->group(function(){
        Route::get('getAffiche', 'getAffiche');
    });

    Route::prefix('user')->controller(userController::class)->group(function(){
        Route::get('login', 'login');

        Route::get('register', 'register');

        Route::prefix('{tokenUser}')->group(function(){

            Route::get('update', 'update');

            Route::get('delete', 'delete');
        });
    });

    Route::get('searchMovie', [demandeController::class, 'getListFilm']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
