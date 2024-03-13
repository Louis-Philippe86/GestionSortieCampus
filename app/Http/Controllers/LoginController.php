<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function loginForm(){

        return view('login');
    }

    public function login(LoginRequest $request){
        $paramUser = $request->validated();
        if(Auth::attempt($paramUser)){
            return redirect()->route('home');
        }
        return to_route('login');
    }

    public function logout(){

        Auth::logout();
        return to_route('login');
    }

}
