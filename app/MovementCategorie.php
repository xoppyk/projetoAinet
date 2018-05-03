<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovementCategorie extends Model
{
    protected $fillable =
    [
        'name', 'type',
    ];

    public function movements()
    {
        return $this->hasMany('App\Movement');
    }
}
