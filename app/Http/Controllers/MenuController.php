<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Rest;
use App\Category;
use App\Menu;
class MenuController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create($cat_id)
    {
    	$Cat = Category::find($cat_id);
    	return view('Admin.Menu.create')->with('Cat',$Cat);
    }
    public function store(Request $request,$cat_id)
    {
    	$this->validate($request,array(
                'name'=>'required|max:255',
                'more'=>'required',
                'price'=>'required|max:1000|integer',
                'type'=>'required'
            ));
        //store the data to database
        
        $Menu = new Menu;
        $Menu->name = $request->name;
        $Menu->category_id = $cat_id;
        $Menu->rest_id =Category::find($cat_id)->rest->id; ;
        $Menu->more = $request->more;
        $Menu->price = $request->price;
        $Menu->type = $request->type;
        $Menu->save();
        //redirect to another page
        Session::flash('success','The Restaurant was saved!');
        return redirect()->route('menus.index',$cat_id);
    }
    public function index($cat_id)
    {
    	$rest_id = Category::find($cat_id)->rest->id;
    	$Menus = Menu::where('category_id','=',$cat_id)->paginate(15);
    	return view('Admin.Menu.index')->with('Menus',$Menus)->with('cat_id',$cat_id)->with('rest_id',$rest_id);
    }
    public function destroy($menu_id)
    {
    	$Menu = Menu::find($menu_id);
    	$cat_id = $Menu->category->id;
        $Menu->delete();
        Session::flash('success','The post Was Succesfully Deleted');
        return redirect()->route('menus.index',$cat_id);
    }
}
