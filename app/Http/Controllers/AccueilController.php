<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Sortie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

    public static function option(Sortie $data,Participant $user){
        $response = [$data->id,$user->id];
        return $response;
    }


}
