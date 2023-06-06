<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $guarded = [];
    protected $dates = ['date'];

    public function event()
    {
    	return $this->belongsTo(Event::class);
    }

    public function items()
    {
        return $this->hasMany(ExpenseItem::class);
    }
}
