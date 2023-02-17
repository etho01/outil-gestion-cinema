<?php

use App\Http\Controllers\api\filmContolleur;
use App\Http\Controllers\api\seanceContolleur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
