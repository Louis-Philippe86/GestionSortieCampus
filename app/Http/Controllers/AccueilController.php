<?php

namespace App\Http\Controllers;


use App\Http\Requests\SearchController;
use App\Models\Participant;
use App\Models\Participant_sortie;
use App\Models\Sortie;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;


class AccueilController extends Controller
{
    public function accueil(Request $request){
        if(Auth::user()){

            $sortie = Sortie::query();

            if($request->has('campus_id')) {
                $sortie->where('campus_id', $request->campus_id);
            }

            if ($request->has('dateMin') && $request->dateMin != null) {
                $sortie->where('dateHeureDebut', '>', $request->dateMin);
            }

            if ($request->has('dateMax') && $request->dateMax != null) {
                $sortie->where('dateLimiteInscription', '<', $request->dateMax);
            }

            if ($request->has('search') && $request->search != null) {
                $sortie->where('nom', 'LIKE', '%' . $request->search . '%');
            }

            if ($request->has('ownSortie') && $request->ownSortie != null) {
                $sortie->where('participant_id', Auth::user()->id);
            }

            if($request->has('sortieNonInscrit') && $request->sortieNonInscrit != null){

                if ($request->has('sortieNonInscrit') && !isset($request['sortieInscrit']) && !isset($request['ownSortie'])) {
                    $sortie->whereDoesntHave('participants', function ($query) {
                        $query->where('participant_id', Auth::user()->id);
                    })->whereNot('participant_id', Auth::user()->id);
                }else{
                    $sortie->orWhereDoesntHave('participants', function ($query) {
                        $query->where('participant_id', Auth::user()->id);
                    });
                }

            }

            if($request->has('sortieInscrit') && $request->sortieInscrit != null){

                if ($request->has('sortieInscrit') && !isset($request['sortieNonInscrit']) && !isset($request['ownSortie'])) {
                    $sortie->whereHas('participants', function ($query) {
                        $query->where('participant_id', Auth::user()->id);
                    })->whereNot('participant_id', Auth::user()->id);
                }else{
                    $sortie->orWhereHas('participants', function ($query) {
                        $query->where('participant_id', Auth::user()->id);
                    });
                }

            }

            $result = $sortie->get();
            return view('accueil', ['datas' => $result]);
        }
        return view('pageError.notFound');
    }

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
