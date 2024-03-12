<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sortie extends Model
{
    use HasFactory;

    //Une sortie à un seul organisateur
    public function organisateur(){
        return $this->belongsTo(Participant::class);
    }

    //Une sortie est associé à un lieu
    public function lieux(){
        return $this->belongsTo(Lieu::class);
    }


    //Une sortie est associé à un campus
    public function campus(){
        return $this->belongsTo(Campus::class);
    }

    //Une sortie à un seul à etat à la fois
    public function etat(){
        return $this->belongsTo(Etat::class);
    }

    //Une sortie peut avoir plusieurs participants
    public function participants()
    {
        return $this->belongsToMany(Participant::class);
    }

}
