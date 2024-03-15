<?php

namespace App\Http\Controllers;

use App\Models\Lieu;
use App\Models\Sortie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SortieController extends Controller
{
    public function formCreate(){
        return (Auth::user()) ? view('sortie.createSortie') : view('pageError.notFound');
    }

    public function create(Request $request){
        $data = $request->all();
        $data['etat_id'] = 1;
        $data['campus_id'] = Auth::user()->campus->id;
        $lieu = new Lieu();
        $sortie = new Sortie();

        if(!isset($data['lieu_id'])) {
            $lieu->fill([
                'nom' => $data['nom_lieu'],
                'rue' => $data['rue'],
                'latitude' => $data['latitude'],
                'longitude' => $data['longitude'],
                'ville_id' => $data['ville_id'],
            ]);
            $lieu->save();
            $data['lieu_id'] = $lieu->id;
        }
        
        $sortie->fill([
            'nom'=>$data['nom'],
            'dateHeureDebut'=>$data['dateHeureDebut'],
            'duree'=>$data['duree'],
            'dateLimiteInscription'=>$data['dateLimiteInscription'],
            'nbInscriptionMax'=>$data['nbInscriptionMax'],
            'infosSortie'=>$data['infosSortie'],
            'etat_id'=>$data['etat_id'],
            'lieu_id'=>$data['lieu_id'],
            'campus_id'=>$data['campus_id'],
        ]);
        $sortie->save();






    }


}
