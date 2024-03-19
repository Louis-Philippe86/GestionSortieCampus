<?php

namespace App\Http\Controllers;

use App\Models\Sortie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home(){
        if(Auth::user()){
            $sortie = Sortie::all();
            return view('home',['datas'=>$sortie]);
        }
        return view('pageError.notFound');
    }


}
