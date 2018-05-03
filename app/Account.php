<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'owner_id', 'account_type_id', 'date', 'code', 'description', 'start_balance', 'current_balance', 'last_movement_date', 'deleted_at',
    ];

    public function movements()
    {
        return $this->hasMany('App\Movement');
    }

    public function accountType()
    {
        return $this->belongsTo('App\AccountType');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }



}
