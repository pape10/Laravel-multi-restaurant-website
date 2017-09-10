<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rest;
use Session;
class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $Rests = Rest::orderBy('id','desc')->paginate(15);
        return view('Admin.index')->with('Rests',$Rests);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Admin.Create_Restaurants');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate the data
        $this->validate($request,array(
                'restaurant_name'=>'required|max:50|unique:rests,restaurant_name',
                'slug'=>'required|alpha_dash|min:5|max:255|unique:rests,slug',
                'email'=>'required|min:5|max:255|unique:rests,email',
                'phone'=>'required|min:5|max:255|unique:rests,phone',
                'image_name'=>'required|min:3|max:255|unique:rests,image_name'
            ));
        //store the data to database
        
        $Rest= new Rest;
        $Rest->restaurant_name = $request->restaurant_name;
        $Rest->slug = $request->slug;
        $Rest->restaurant_address = $request->restaurant_address;
        $Rest->cuisine1 = $request->cuisine1;
        $Rest->cuisine2 = $request->cuisine2;
        $Rest->cuisine3 = $request->cuisine3;
        $Rest->email = $request->email;
        $Rest->phone = $request->phone;
        $Rest->image_name = $request->image_name;
        $Rest->save();
        //redirect to another page
        Session::flash('success','The Restaurant was saved!');
        return redirect()->route('Restaurants.show',$Rest->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Rest = Rest::find($id);
        return view('Admin.Show_Restaurant')->with('Rest',$Rest);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $Rest = Rest::find($id);
        return view('Admin.Edit_Restaurant')->with('Rest',$Rest);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $Rest = Rest::find($id);
        if($request->input('slug') == $Rest->slug && $request->input('restaurant_name') == $Rest->restaurant_name)
        {
        }
        else if($request->input('slug') != $Rest->slug && $request->input('restaurant_name') == $Rest->restaurant_name)
        {

        $this->validate($request,array(
            'slug'=>'required|alpha_dash|min:5|max:255|unique:rests,slug'
            ));   
        }
        else if($request->input('slug') == $Rest->slug && $request->input('restaurant_name') != $Rest->restaurant_name)
        {

        $this->validate($request,array(
            'restaurant_name' => 'required|max:50|unique:rests,restaurant_name'
            
            ));   
        }
        else
        {
        $this->validate($request,array(
            'restaurant_name' => 'required|max:50|unique:rests,restaurant_name',
            'slug'=>'required|alpha_dash|min:5|max:255|unique:rests,slug'
            ));
        }
        $Rest->restaurant_name = $request->restaurant_name;
        $Rest->restaurant_address = $request->restaurant_address;
        $Rest->slug = $request->slug;
        $Rest->cuisine1 = $request->cuisine1;
        $Rest->cuisine2 = $request->cuisine2;
        $Rest->cuisine3 = $request->cuisine3;
        
        $Rest->save();
         Session::flash('success','The Restaurant was edited!');
        return redirect()->route('Restaurants.show',$Rest->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $Rest = Rest::find($id);
        $Rest->delete();
        Session::flash('success','The post Was Succesfully Deleted');
        return redirect()->route('Restaurants.index');
    }
}
