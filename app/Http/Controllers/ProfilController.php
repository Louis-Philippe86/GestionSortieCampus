<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfilRequest;
use App\Models\Participant;
use Illuminate\Support\Facades\Auth;



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

    public function modify(ProfilRequest $request)
    {

        if ($request->validated() && Auth::user()) {
            $validatedData = $request->validated();
            unset($validatedData['password_confirmation']);
            $validatedData['password'] = bcrypt($validatedData['password']);
            $user = Auth::user();

            if($request->hasFile('photo')){
                $file = $request->file('photo');
                $imageName = $user->nom . '.' . $file->getClientOriginalExtension();
                $request->photo->move(public_path('img'), $imageName);
                $validatedData['photo'] = $imageName;
            }

            Participant::query()->where('email', $user->email)->update($validatedData);
            return redirect()->route('profil.show')->with('success', 'Profil modifié avec succé');
        }


    }



}

