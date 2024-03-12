<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    //Un participant appartient à un campus
    public function campus(){
        return $this->belongsTo(Campus::class);
    }

    //Un participant peut organiser plusieurs sorties
    public function organiseSorties(){
        return $this->hasMany(Sortie::class);
    }

    //Un participant peut être inscrit à plusieurs sortie
    public function inscritSorties()
    {
        return $this->belongsToMany(Sortie::class);
    }

}
