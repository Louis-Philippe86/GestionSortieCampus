<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    //Dire à Laravel le nom de la table concerné
    protected $table = 'campus';
    use HasFactory;

    //Un campus à plusieurs participants
    public function participant(){
        return $this->hasMany(Participant::class);
    }

    //Un campus à plusieurs sortie
    public function sortie(){
        return $this->hasMany(Sortie::class);
    }
}
