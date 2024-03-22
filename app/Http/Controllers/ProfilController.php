<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfilRequest;
use App\Models\Participant;
use App\Models\Participant_sortie;
use App\Models\Sortie;
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

    public function inscritpion(Sortie $sortie){

        $nombreInscrit = Participant_sortie::query()
            ->where('sortie_id',$sortie->id)
            ->count();
        if($nombreInscrit === $sortie->nbInscriptionMax -1){
            $etat = Sortie::query()->find($sortie->id);
            $etat->update(['etat_id'=> 3]);

        }

        if($sortie->etat_id === 3 || $sortie->etat_id === 5 || $nombreInscrit >= $sortie->nbInscriptionMax){
            return redirect()->route('accueil')->with('error', 'Inscritpion à la sortie'.$sortie->nom .'impossible. Sortie cloturé');
        }else{
            $participantSortie = new Participant_sortie();
            $participantSortie->participant_id = Auth::user()->id;
            $participantSortie->sortie_id = $sortie->id;
            $participantSortie->save();
        }

        return redirect()->route('accueil')->with('success', 'Inscritpion à la sortie'.$sortie->nom .'confirmé');

    }
    public function annulerInscritpion(Sortie $sortie){

        $nombreInscrit = Participant_sortie::query()
            ->where('sortie_id',$sortie->id)
            ->count();

        if($nombreInscrit === $sortie->nbInscriptionMax && $sortie->etat_id === 3 ){
            $test = Sortie::query()->find($sortie->id);
            $result = $test->update(['etat_id'=> 2]);


        }


       Participant_sortie::query()
           ->where('participant_id',Auth::user()->id)
           ->where('sortie_id',$sortie->id)
           ->delete();

        return redirect()->route('accueil')->with('success','L\'inscription à la sortie'.$sortie->nom.'est annulée');


    }



}

