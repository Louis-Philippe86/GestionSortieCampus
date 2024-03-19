<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function loginForm(){

        if(Auth::user())
            return redirect()->route('accueil');
        else
            return view('login');
    }

    public function login(LoginRequest $request){

        $paramUser = $request->only('email','password');
        $remember = $request->has('remember');


        if(Auth::attempt($paramUser,$remember)){
            return redirect()->route('accueil');
        }else{
            return redirect()->route('auth.login')->with('error','Identifiant incorrect');
        }

    }

    public function logout(Request $request){

        Auth::user()->update(['remember_token'=>null]);
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return to_route('auth.login');
    }

}
