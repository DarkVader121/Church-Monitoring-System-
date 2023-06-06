<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $guarded = [];
    protected $dates = ['date'];

    public function expense()
    {
    	return $this->belongsTo(Expense::class);
    }

}
