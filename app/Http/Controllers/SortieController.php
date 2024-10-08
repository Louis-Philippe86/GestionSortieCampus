<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnnulerSortie;
use App\Http\Requests\CreateSortieRequest;
use App\Models\Lieu;
use App\Models\Sortie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class SortieController extends Controller
{
    public function formCreate(){
        return (Auth::user()) ? view('sortie.createSortie') : view('pageError.notFound');
    }

    public function createSortie(CreateSortieRequest $request){

        $data = $request->all();
        $data['etat_id'] = 1;

        if(!isset($data['lieu_id'])) {
            $lieu = Lieu::create($request->lieu);
            $data['lieu_id'] = $lieu->id;
        }
        Sortie::create($data);
        return redirect()->route('accueil')->with('success','Sortie créee avec succé');

    }

    public function formCanceled(Sortie $sortie){

        return view('sortie.cancelSortie')->with(['sortie'=>$sortie]);
    }

    public function cancelSortie(AnnulerSortie $request , Sortie $sortie){

        if ($request->validated() && $sortie->participant_id == Auth::user()->id){
            Sortie::query()->find($sortie->id)->update(['etat_id'=>6]); //Id : Annulée
            return redirect()->route('accueil')->with('success','La sortie "'.$sortie->nom.'" a été annulée avec succée');

        }
        return redirect()->route('accueil')->with('error','vous n\'ête pas autorisé à modifier cette sortie');
    }

    public function afficherSortie(Sortie $sortie){

        return view('sortie.afficherSortie')->with(['sortie'=>$sortie]);
    }

    public function FormModifierSortie(Sortie $sortie){
        return view('sortie.modiferSortie')->with(['sortie'=>$sortie]);
    }

    public function modifierSortie(CreateSortieRequest $request, Sortie $sortie){
        $data = $request->all();
        $data['etat_id'] = $sortie->etat_id;



        if(!isset($data['lieu_id'])) {
            $lieu = Lieu::create($request->lieu);
            $data['lieu_id'] = $lieu->id;
        }
        unset($data['ajouterLieu']);
        unset($data['_token']);
        unset($data['ville_id']);

        $sortieModifie = Sortie::query()->find($sortie->id);
        $sortieModifie->update($data);
        return redirect()->route('accueil')->with('success','Sortie modifiée avec succé');
    }

    public function publierSortie(Sortie $sortie){
        Sortie::query()->find($sortie->id)->update(['etat_id'=>2]);
        return redirect()->route('accueil')->with('success','La sortie a été publié avec succée');
    }






}
