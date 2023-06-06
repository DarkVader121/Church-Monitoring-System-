<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpenseItem extends Model
{
    protected $guarded = [];
    protected $table = 'expense_item';

    public function item()
    {
    	return $this->belongsTo(Expense::class);
    }
}
