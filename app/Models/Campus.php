<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    protected $table = 'campus';
    use HasFactory;
    public function participant(){
        return $this->hasMany(Participant::class);
    }

    public function sortie(){
        return $this->hasMany(Sortie::class);
    }
}
