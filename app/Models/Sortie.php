<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sortie extends Model
{
    use HasFactory;
    public function organisateur(){
        return $this->belongsTo(Participant::class);
    }
    public function lieux(){
        return $this->belongsTo(Lieu::class);
    }

    public function campus(){
        return $this->belongsTo(Campus::class);
    }

    public function etat(){
        return $this->belongsTo(Etat::class);
    }

}
