<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Sortie;
use Illuminate\Support\Facades\Auth;

class AccueilController extends Controller
{
    public function accueil(){
        if(Auth::user()){
            $sortie = Sortie::all();
            return view('accueil',['datas'=>$sortie]);
        }
        return view('pageError.notFound');
    }

    public static function option(Sortie $sortie,Participant $user) {

        $otpion = [];
//        if($user->id == $sortie->participant_id) {
//
//            switch ($sortie->etat_id) {
//                //Sortie Cree
//                case 1:
//                    $otpion = [
//                        '<a href="' . route('sortie.afficher', ['sortie' => $sortie]) . '">Publier</a>',
//                        '<a href="' . route('sortie.modifier', ['sortie' => $sortie]) . '">Modifier</a>'
//                    ];
//                    break;
//
//                //Sortie Ouverte
//                case 2:
//                    $otpion = [
//                        '<a href="' . route('sortie.afficher', ['sortie' => $sortie]) . '">Afficher</a>',
//                        '<a href="' . route('sortie.formCanceled', ['sortie' => $sortie]) . '">Annuler</a>'
//                    ];
//                    break;
//
//                //Sortie Annule
//                case 6:
//                    $otpion = [
//                        '<a href="' . route('sortie.afficher', ['sortie' => $sortie]) . '">Afficher</a>'
//                    ];
//                    break;
//
//                default:
//                    return $otpion;
//            }
//        }else{
//            switch ($sortie->etat_id){
//                //sortie Ouverte
//                case 2:
//                    $otpion = [
//                        '<a href="' . route('sortie.afficher', ['sortie' => $sortie]) . '">Afficher</a>',
//                        '<a href="' . route('sortie.formCanceled', ['sortie' => $sortie]) . '">S\'inscrir</a>'
//                    ];
//                    break;
//
//                //Sortie Annule
//                case 6:
//                    $otpion = [
//                        '<a href="' . route('sortie.afficher', ['sortie' => $sortie]) . '">Afficher</a>'
//                    ];
//                    break;
//
//            }
//        }


        switch ($sortie->etat_id){
            case 1:
                if($user->id == $sortie->participant_id){
                    $otpion = [
                        '<a href="' . route('sortie.afficher', ['sortie' => $sortie]) . '">Publier</a>',
                        '<a href="' . route('sortie.modifier', ['sortie' => $sortie]) . '">Modifier</a>'
                    ];
                    break;
                }

            //Sortie Ouverte
            case 2:
                $otpion = [
                    '<a href="' . route('sortie.afficher', ['sortie' => $sortie]) . '">Afficher</a>'
                ];
                if($user->id == $sortie->participant_id){
                    $otpion [] = '<a href="' . route('sortie.formCanceled', ['sortie' => $sortie]) . '">Annuler</a>';

                    break;
                }else{
                    $otpion [] = '<a href="' . route('profil.inscription', ['sortie' => $sortie]) . '">S\'inscrir</a>';
                    $otpion [] = '<a href="' . route('profil.annulerInscritpion', ['sortie' => $sortie]) . '">Se desiter</a>';
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
