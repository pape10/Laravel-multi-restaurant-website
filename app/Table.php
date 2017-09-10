<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    public function rest()
    
    {
    	return $this->belongsTo('App\Rest');
    }
}
