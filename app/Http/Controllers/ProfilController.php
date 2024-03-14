<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfilRequest;
use App\Models\Participant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ProfilController extends Controller
{
    public function show(){
        if (Auth::user()){
            return view('profil.showProfil');
        }
    return view('pageError.notFound');
    }

    public function formModify(){
        if (Auth::user()){
            return view('profil.modifyProfil');
        }
        return view('pageError.notFound');
    }

    public function modify(ProfilRequest $request){

        if($request->validated()&&Auth::user()) {
            $validatedData = $request->validated();
            unset($validatedData['password_confirmation']);
            Participant::query()->where('email', Auth::user()->email)->update($validatedData);
            return redirect()->route('profil.show')->with('success','Profil modifié avec succé');
        }



    }
    

}
