<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    protected $fillable = [
        'account_id', 'movement_category_id', 'date', 'value', 'start_balance', 'end_balance', 'description', 'type', 'document_id',
    ];//end_balance e start_balance podem ser calculados através do value introduzido???
}
