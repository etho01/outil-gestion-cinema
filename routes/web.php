<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
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
use App\Http\Controllers\cinema\FilmSceanceController;
use App\Http\Controllers\gestion\TypeClientController;
use App\Http\Controllers\cinema\DistributeurController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\cinema\demandeFilmController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('api')->group(
    base_path('routes/api.php')
);


Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

Route::get('', [AuthenticatedSessionController::class, 'create'])
->name('login');


Route::post('', [AuthenticatedSessionController::class, 'store']);

Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
->name('logout');

Route::get('/register/{slug}/{key}', [UserController::class, 'add_password'])->name('add_password');
Route::post('/profile/update', [UserController::class, 'update'])->name('profile.change');

Route::get('profile/{slug}', [UserController::class, 'viewProfile'])->name('profile');

Route::prefix('parametre')->middleware('route', 'auth')->group(function (){
    Route::prefix('client')->name('Client.')->controller(ClientController::class)->group(function (){
        Route::get('/', 'list')->name('list');
        Route::get('/{slug}', 'show')->name('show');
        Route::post('/create', 'store')->name('create');
        Route::get('/delete/{slug}', 'delete')->name('delete');
    });
    Route::prefix('type-client')->name('TypeClient.')->controller(TypeClientController::class)->group(function(){
        Route::get('/', 'list')->name('list');
        Route::get('/{slug}', 'show')->name('show');
        Route::post('/create', 'store')->name('create');
        Route::get('/delete/{slug}', 'delete')->name('delete');
    });
});

Route::middleware('auth', 'cineExist', 'route')->prefix('{cinema}')->group(function (){
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
    Route::prefix('seance')->name('Sceance.')->controller(SceanceController::class)->group(function(){
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
    Route::prefix('film_version')->name('Film.')->controller(FilmController::class)->group(function(){
        Route::get('/', 'list')->name('list');
        Route::get('/{slug}')->name('show');
    });
    
    Route::prefix('film_sceance')->name('FilmVersion.')->controller(FilmSceanceController::class)->group(function(){
        Route::get('/', 'list')->name('list');
    });

    Route::prefix('demande_film')->name('demandeFilm.')->controller(demandeFilmController::class)->group(function(){
        Route::get('/', 'list')->name('list');
    });
});
/*
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});*/

//require __DIR__.'/auth.php';

//Auth::routes();
