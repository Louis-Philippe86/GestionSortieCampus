<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Participant_sortie extends Model
{
    protected $table = 'participant_sortie';
    public $timestamps = false;

    protected $fillable = [
        'participant_id','sortie_id'
    ];

}
