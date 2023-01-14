<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\cinema\DcpController;
use App\Http\Controllers\cinema\KdmController;
use App\Http\Controllers\cinema\NasController;
use App\Http\Controllers\cinema\FilmController;
use App\Http\Controllers\gestion\RoleController;
use App\Http\Controllers\gestion\UserController;
use App\Http\Controllers\cinema\ServeurController;
use App\Http\Controllers\gestion\ClientController;
use App\Http\Controllers\cinema\GlobecastController;
use App\Http\Controllers\gestion\TypeClientController;

Route::prefix('parametre')->group(function (){
    Route::prefix('client')->name('Client.')->controller(ClientController::class)->group(function (){
        Route::get('/', 'list')->name('list');
        Route::get('/{client_slug}', 'show')->name('show');
    });
    Route::prefix('type-client')->name('TypeClient.')->controller(TypeClientController::class)->group(function(){
        Route::get('/', 'list')->name('list');
        Route::get('/{type_client_slug}', 'show')->name('show');
        Route::post('/create', 'store')->name('create');
    });
    Route::prefix('role')->name('Role.')->controller(RoleController::class)->group(function(){
        Route::get('/', 'list')->name('list');
        Route::get('/{role_slug}')->name('show');
    });
});

Route::prefix('user')->name('User.')->controller(UserController::class)->group(function(){
    Route::get('/', 'list')->name('list');
    Route::get('/{user_slug}')->name('show');
});
Route::prefix('nas')->name('Nas.')->controller(NasController::class)->group(function(){
    Route::get('/', 'list')->name('list');
});
Route::prefix('dcp')->name('Dcp.')->controller(DcpController::class)->group(function(){
    Route::get('/', 'list')->name('list');
});
Route::prefix('globeast')->name('Globecast.')->controller(GlobecastController::class)->group(function(){
    Route::get('/', 'list')->name('list');
});
Route::prefix('serveur')->name('Serveur.')->controller(ServeurController::class)->group(function(){
    Route::get('/', 'list')->name('list');
});
Route::prefix('kdm')->name('Kdm.')->controller(KdmController::class)->group(function(){
    Route::get('/', 'list')->name('list');
});
Route::prefix('film')->name('Film.')->controller(FilmController::class)->group(function(){
    Route::get('/', 'list')->name('list');
    Route::get('/{film_slug}')->name('show');
});