<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function loginForm(){

        if(Auth::user())
            return view('home');
        return view('login');
    }

    public function login(LoginRequest $request){

        $paramUser = $request->only('email','password');
        $remember_me =  $request->filled('remember_me');

        if(Auth::attempt($paramUser,$remember_me)){
            if(!$remember_me){
                $participant = Participant::query()->where('email', Auth::user()->email)->first();
                $participant->update(['remember_token' => null]);

            }


            return redirect()->route('home');
        }else{
            return redirect()->route('login')->with('error','Identifiant incorrect');
        }

    }

    public function logout(){

        Auth::logout();
        return to_route('login');
    }

}
