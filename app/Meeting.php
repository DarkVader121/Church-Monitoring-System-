<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $guarded = [];
    protected $dates = ['date'];
    
    public function project()
    {
    	return $this->belongsTo(Project::class);
    }
}
