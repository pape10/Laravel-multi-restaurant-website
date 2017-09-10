<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rest;
use App\Category;
use App\Menu;
class HotelWithoutLocationController extends Controller
{
    //it will contain controller functions for showing all restaurants without location individual menu without location
    //this controller function is fo showing all restaurants without location in the sessiom
    public function getAllWithoutLocation()
    {
    	$Rests = Rest::paginate(15);
    	return view('Pages_Users.WithoutLocation.Show_All_Restaurant')->with('Rests',$Rests);
    }
    public function getSingle($slug)
    {
    	$Rest = Rest::where('slug','=',$slug)->first();
    	$Cats = $Rest->categories;
    	return view('Pages_Users.WithoutLocation.Show_Menu')->with('Cats',$Cats)->with('Rest',$Rest);
    }
    public function getSingleCategory($slug,$cat_id)
    {
    	$Rest = Rest::where('slug','=',$slug)->first();
    	$Cats = $Rest->categories;
    	return view('Pages_Users.WithoutLocation.Show_Menu_Ind')->with('Cats',$Cats)->with('Rest',$Rest)->with('cat_id',$cat_id);
    }
}
