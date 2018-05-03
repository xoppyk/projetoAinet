<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountType extends Model
{
 	protected $fillable = [
        'name',
    ];

    public function accounts()
    {
        return $this->hasMany('App\Account');
    }
}
