<?php

use App\Http\Controllers\ProfilController;

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

Route::get('/', [ProfilController::class,'loginForm'])->name('auth.login');
Route::post('/', [ProfilController::class,'login'])->name('auth.doLogin');


