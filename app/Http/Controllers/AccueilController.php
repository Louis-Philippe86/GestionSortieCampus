<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchController;
use App\Models\Participant;
use App\Models\Participant_sortie;
use App\Models\Sortie;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;



class AccueilController extends Controller
{
    public function accueil(Request $request){
        if(Auth::user()){


            $sortie = Sortie::all()->where('campus_id', $request['campus_id']);
            if($request['dateMin'] != null){
                $sortie->where('dateHeureDebut','=',$request['dateMin']);

            }
            return view('accueil',['datas' => $sortie]);
        }
        return view('pageError.notFound');

    }



//  "_token" => "9x9BvbQSin708rItvBWLo5nphaGJYEzBNPg7rWdQ"
//  "campus_id" => "1"
//  "search" => null
//  "dateMin" => null
//  "dateMax" => null
//  "ownSortie" => "on"
//  "sortieInscrit" => "on"
//  "sortieNonInscrit" => "on"
//  "sortieTermine" => "on"



    public static function optionAction(Sortie $sortie,Participant $user) {

        $otpion =[];
        switch ($sortie->etat_id){
            case 1:
                if($user->id == $sortie->participant_id){
                    $otpion = [
                        '<a href="' . route('sortie.afficher', ['sortie' => $sortie]) . '">Publier</a>',
                        '<a href="' . route('sortie.modifier', ['sortie' => $sortie]) . '">Modifier</a>'
                    ];
                }
                    break;

            //Sortie Ouverte
            case 2:
                $otpion = [
                    '<a href="' . route('sortie.afficher', ['sortie' => $sortie]) . '">Afficher</a>'
                ];
                if($user->id == $sortie->participant_id){
                    $otpion [] = '<a href="' . route('sortie.formCanceled', ['sortie' => $sortie]) . '">Annuler</a>';

                    break;
                }else{
                    $inscrit = Participant_sortie::query()
                        ->get()
                        ->where('participant_id',Auth::user()->id,)
                        ->where('sortie_id',$sortie->id);

                    if($inscrit->isEmpty()){
                        $otpion [] = '<a href="' . route('profil.inscription', ['sortie' => $sortie,'participant'=>Auth::user()]) . '">S\'inscrire</a>';
                    }else{
                        $otpion [] = '<a href="' . route('profil.annulerInscritpion', ['sortie' => $sortie,'participant'=>Auth::user()]) . '">Se desiter</a>';
                    }
                    break;
                }
            //sortie En cours
            case 4:

            //Sortie Annule
            case 6:
                $otpion [] ='<a href="' . route('sortie.afficher', ['sortie' => $sortie]) . '">Afficher</a>';
                break;

        }
        return $otpion;
    }


}
