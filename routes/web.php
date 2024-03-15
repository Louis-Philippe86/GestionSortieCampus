<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfilController;

use App\Http\Controllers\SortieController;
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
Route::prefix('/')->controller(LoginController::class)->name('login')->group(function (){

    Route::get('/', 'loginForm')->name('');
    Route::post('/', 'login')->name('.doLogin');
    Route::get('/logout','logout')->name('.logout');

});

Route::prefix('home')->controller(HomeController::class)->name('home')->group(function (){

    Route::get('/','home')->name('');

});

Route::prefix('/profil')->controller(ProfilController::class)->name('profil')->group(function (){

    Route::get('','show')->name('.show');
    Route::get('/edit','formModify')->name('.formModify');
    Route::post('/edit','modify');
});

Route::prefix('/sortie')->controller(SortieController::class)->name('sortie')->group(function (){

    Route::get('/create','formCreate')->name('.form-create');
    Route::post('/create','create');
});





