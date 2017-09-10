<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    
   public function location()
   
   {
   	return $this->belongsTo('App\Location');
   }

   public function rest()
   
   {
   	return $this->belongsTo('App\Rest');
   }
}
