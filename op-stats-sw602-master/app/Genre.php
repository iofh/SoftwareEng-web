<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $table = 'genres'; // table for this model

    protected $fillable = [
        'genre'
    ];

    public function games()
    {
        return $this->hasMany('App\Game');
    }

}
