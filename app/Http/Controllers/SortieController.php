<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnnulerSortie;
use App\Http\Requests\CreateSortieRequest;
use App\Models\Lieu;
use App\Models\Sortie;
use Illuminate\Support\Facades\Auth;

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


        $sortie = Sortie::create($data);
        $sortie->participant()->associate(Auth::user());
        $sortie->save();

    }

    public function formCanceled(){
        //Récupération d'une sortie pour le test d'affichage
        //TODO : récupéré l'instance de la sortie en cours de consultation
        $sortieDataTest = Sortie::query()->find(24);
        session()->flash('sortie',$sortieDataTest);

        return view('sortie.cancelSortie',['sortie'=>$sortieDataTest]);
    }

    public function cancelSortie(AnnulerSortie $request){
        if ($request->validated()){
            session('sortie')->etat_id = 6; //Id : Annulée
            return redirect()->route('sortie.formCanceled')->with('success','La sortie est maintenant annulée');

        }
        return redirect()->route('sortie.formCanceled');
    }




}
