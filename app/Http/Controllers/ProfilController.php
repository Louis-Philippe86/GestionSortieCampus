<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{

    public function loginForm(){

        return view('home');
    }

    public function login(LoginRequest $request){
        $paramUser = $request->validated();
        dump($paramUser);
        dump(Auth::attempt($paramUser));
    }

}
