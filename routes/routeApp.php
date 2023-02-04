<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\cinema\DcpController;
use App\Http\Controllers\cinema\KdmController;
use App\Http\Controllers\cinema\NasController;
use App\Http\Controllers\cinema\FilmController;
use App\Http\Controllers\gestion\RoleController;
use App\Http\Controllers\gestion\UserController;
use App\Http\Controllers\cinema\OptionController;
use App\Http\Controllers\cinema\SceanceController;
use App\Http\Controllers\cinema\ServeurController;
use App\Http\Controllers\gestion\ClientController;
use App\Http\Controllers\cinema\GlobecastController;
use App\Http\Controllers\gestion\TypeClientController;
use App\Http\Controllers\cinema\DistributeurController;

Route::prefix('parametre')->group(function (){
    Route::prefix('role')->name('Role.')->controller(RoleController::class)->group(function(){
        Route::get('/', 'list')->name('list');
        Route::get('/create', 'store')->name('create');
        Route::get('/{slug}', 'show')->name('show');
    });

    Route::prefix('distributeur')->name('Distributeur.')->controller(DistributeurController::class)->group(function(){
        Route::get('/', 'list')->name('list');
    });

    Route::prefix('option')->name('Options.')->controller(OptionController::class)->group(function(){
        Route::get('/', 'list')->name('list');
    });
});

Route::prefix('user')->name('User.')->controller(UserController::class)->group(function(){
    Route::get('/', 'list')->name('list');
    Route::post('/create', 'store')->name('create');
    Route::get('/delete/{slug}', 'delete')->name('delete');
    Route::get('/{slug}', 'show')->name('show');
});
Route::prefix('sceance')->name('Sceance.')->controller(SceanceController::class)->group(function(){
    Route::get('/', 'list')->name('list');
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
    Route::get('/{slug}')->name('show');
});