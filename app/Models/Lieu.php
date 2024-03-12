<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lieu extends Model
{
    protected $table = 'lieux';
    use HasFactory;

    public function ville()
    {
        return $this->belongsTo(Ville::class);
    }
}
