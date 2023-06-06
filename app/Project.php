<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];

    protected $dates = ['date'];

    public function events()
    {
    	return $this->hasMany(Event::class);
    }
}
