<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'owner_id', 'account_type_id', 'date', 'code', 'description', 'start_balance', 'current_balance', 'last_movement_date', 'deleted_at',
    ];
}
