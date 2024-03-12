<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;
        public function campus(){
            return $this->belongsTo(Campus::class);
        }
        public function organisateur(){
            return $this->hasMany(Sortie::class);
        }

}
