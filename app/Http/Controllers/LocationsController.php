<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
use Session;
class LocationsController extends Controller
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
        //
        $Locts = Location::orderBy('id','desc')->paginate(15);
        return view('Admin.Location.index')->with('Locts',$Locts);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Admin.Location.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,array(
                'name'=>'required|max:255|unique:locations,name',
                ));
        //store the data to database
        
        $loct= new Location;
        $loct->name = $request->name;
 
        $loct->save();
        //redirect to another page
        Session::flash('success','The location was saved!');
        return redirect()->route('locations.show',$loct->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $loct = Location::find($id);
        return view('Admin.Location.Show')->with('loct',$loct);
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
        $Loct = Location::find($id);
        return view('Admin.Location.Edit')->with('Loct',$Loct);
   
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
        $Loct = Location::find($id);
        
        if($Loct->name != $request->name)
        {
        $this->validate($request,array(
            'name' => 'required|max:255|unique:locations,name',
            ));
        }
        $Loct->name = $request->name;
        
        $Loct->save();
         Session::flash('success','The Location was edited!');
        return redirect()->route('locations.show',$Loct->id);

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
        $Loct = Location::find($id);
        $Loct->delete();
        Session::flash('success','The Location Was Succesfully Deleted');
        return redirect()->route('locations.index');
    
    }
}
