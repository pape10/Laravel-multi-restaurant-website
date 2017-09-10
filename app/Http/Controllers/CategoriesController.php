<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Rest;
use Session;
class CategoriesController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function createPage($rest_id)
    {
    	$Rest = Rest::find($rest_id);
    	return view('Admin.Category.create')->with('Rest',$Rest)->with('rest_id',$rest_id);
    }
    public function store(Request $request,$rest_id)
    {
        //
        $this->validate($request,array(
                'name'=>'max:255|required'
			));
    	$Cat = new Category;
        $Cat->rest_id = $request->rest_id;
		$Cat->name = $request->name;
		$Cat->save();
		Session::flash('success','The category was saved!');
        return redirect()->route('categories.index',$rest_id);
    	
    }
    public function index($rest_id)
    {
    	$Cats =Category::where('rest_id','=',$rest_id)->paginate(15);
    	return view('Admin.Category.index')->with('Cats',$Cats)->with('rest_id',$rest_id);
    }
}
