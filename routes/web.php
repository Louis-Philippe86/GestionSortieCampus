<?php

use App\Http\Controllers\AccueilController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfilController;

use App\Http\Controllers\SortieController;
use App\Models\Sortie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::prefix('/')->controller(LoginController::class)->name('auth.login')->group(function (){

    Route::get('', 'loginForm')->name('');
    Route::post('', 'login')->name('.doLogin');
    Route::get('logout','logout')->name('.logout');

});

Route::prefix('/accueil')->controller(AccueilController::class)->name('accueil')->group(function (){

    Route::get('/','accueil')->name('');

});


Route::prefix('/profil')->controller(ProfilController::class)->name('profil')->group(function (){

    Route::get('','show')->name('.show');
    Route::get('/edit','formModify')->name('.formModify');
    Route::post('/edit','modify');
    Route::get('/inscriptionSortie','inscritpion')->name('.inscription');
    Route::get('/annulerInscriptionSortie','annulerInscritpion')->name('.annulerInscritpion');
});

Route::prefix('/sortie')->controller(SortieController::class)->name('sortie')->group(function (){
    Route::get('/create','formCreate')->name('.form-create');
    Route::post('/create','createSortie');

    Route::get('/annuler-{sortie}','formCanceled')->name('.formCanceled');
    Route::post('/annuler-{sortie}','cancelSortie');

    Route::get('/afficher-{sortie}','afficherSortie')->name('.afficher');
    Route::post('/afficher-{sortie}','publierSortie')->name('.afficher');

    Route::get('/modifier-{sortie}','modifierSortie')->name('.modifier');
});






