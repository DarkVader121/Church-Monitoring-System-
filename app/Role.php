<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [

    	'label',
    	'name',
    ];	


    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
