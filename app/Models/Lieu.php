<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lieu extends Model
{
    protected $table = 'lieux';
    use HasFactory;

    //Un lieu est attaché à une ville
    public function ville()
    {
        return $this->belongsTo(Ville::class);
    }

    //Il peut y avoir plusieurs sortie dans un même lieu
    public function sortie()
    {
        return $this->hasMany(Sortie::class);
    }
}
