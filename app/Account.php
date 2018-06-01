<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Account extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    
    public $timestamps = false;

    protected $fillable = [
        'owner_id', 'account_type_id', 'date', 'code', 'description', 'start_balance', 'current_balance', 'last_movement_date',
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
        return $this->belongsTo('App\User', 'owner_id');
    }
}
