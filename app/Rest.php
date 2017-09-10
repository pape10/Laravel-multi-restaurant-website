<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rest extends Model
{
    public function service()
   
   {
   	return $this->hasMany('App\Service');
   }
   public function categories()
   
   {
   	return $this->hasMany('App\Category');
   }
   public function menus()
   
   {
   	return $this->hasMany('App\Menu');
   }
   public function table()
   
   {
      return $this->hasOne('App\Table');
   }
}
