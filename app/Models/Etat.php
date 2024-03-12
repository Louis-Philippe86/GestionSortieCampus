<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etat extends Model
{
    use HasFactory;
    //Un etat concerne plusieurs sorties
    public function sortie(){
        return $this->hasMany(Sortie::class);
    }
}
