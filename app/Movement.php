<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'account_id', 'movement_category_id', 'date', 'value', 'start_balance', 'end_balance', 'description', 'type', 'document_id', 'created_at',
    ];//end_balance e start_balance podem ser calculados através do value introduzido???

    public function document()
    {
        return $this->belongsTo('App\Document');
    }

    public function account()
    {
        return $this->belongsTo('App\Account');
    }

    public function movementCategorie()
    {
        return $this->belongsTo('App\MovementCategorie', 'movement_category_id');
    }

    public function scopeFilter($query, $filters)
    {
        if (isset($filters['start_date']) && isset($filters['end_date'])) {
            $query->whereBetween('date', [$filters['start_date'], $filters['end_date']]);
        }
    }
}
