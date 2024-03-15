<?php

namespace App\Http\Controllers;

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

        Sortie::create($data);

    }


}
