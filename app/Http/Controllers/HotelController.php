<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Menu;
use App\Rest;
use Session;
class HotelController extends Controller
{
    //it will contain controller functions for showing all restaurants with location individual menu with location and add to cart
    //this below controller is for showing individual menu with location in the session
    public function getSingle($slug)
    {
    	$Rest = Rest::where('slug','=',$slug)->first();
        if($Rest == null)
        {
            Session::flash('error_slug','sorry we dont have the menu for this hotel');
            return redirect()->route('Location.get');
        }
    	$Cats = $Rest->categories;
    	return view('Pages_Users.Show_Menu')->with('Cats',$Cats)->with('Rest',$Rest);
    }
    public function getSingleCategory($slug,$cat_id)
    {
    	$Rest = Rest::where('slug','=',$slug)->first();
        if($Rest == null)
        {
            Session::flash('error_slug','sorry we dont have the menu for this hotel');
            return redirect()->route('Location.get');
        }
    	$Cats = $Rest->categories;
    	return view('Pages_Users.Show_Menu_Ind')->with('Cats',$Cats)->with('Rest',$Rest)->with('cat_id',$cat_id);
    }
}
