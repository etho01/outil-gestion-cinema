<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\gestion\UserController;
use App\Http\Controllers\gestion\ClientController;
use App\Http\Controllers\gestion\TypeClientController;

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

Route::get('/', function () {
    return view('welcome');
})->name('acceuil');

Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

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

Route::middleware('auth', 'cineExist', 'route')->prefix('{cinema}')->group(base_path('routes/routeApp.php'));
/*
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});*/

require __DIR__.'/auth.php';

Auth::routes();
