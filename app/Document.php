<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'type', 'original_name', 'description', 'created_at',
    ];

    public function movements()
    {
        return $this->hasOne('App\Movement');
    }
}
