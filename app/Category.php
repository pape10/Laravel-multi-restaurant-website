<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'categories';
    public function rest()
    
    {
    	return $this->belongsTo('App\Rest');
    }
    public function menus()
    
    {
    	return $this->hasMany('App\Menu');
    }
}
