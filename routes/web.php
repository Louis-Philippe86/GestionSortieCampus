<?php

use App\Models\Campus;
use App\Models\Lieu;
use App\Models\Ville;
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

Route::get('/', function () {
    $result = Campus::query()->find(2);
    dd($result->participant);
    return view('welcome');
});
