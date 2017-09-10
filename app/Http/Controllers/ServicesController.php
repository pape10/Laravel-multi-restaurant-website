<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\Location;
use App\Rest;
use Session;
class ServicesController extends Controller
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
        $Servs = Service::orderBy('id','desc')->paginate(15);
        return view('Admin.Service.index')->with('Servs',$Servs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $locations = Location::all();
        $Rests = Rest::all();
        return view('Admin.Service.create')->with('Rests',$Rests)->with('locations',$locations);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
         $this->validate($request,array(
                'rest_id'=>'required|integer',
                'location_id'=>'required|integer',
                'del_time'=>'required|integer',
                'del_charge'=>'required|integer'
            ));
        //store the data to database
        if (Service::where('rest_id', '=',$request->rest_id)->where('location_id','=',$request->location_id)->count() > 0) {
            Session::flash('error','service already exists');
            $locations = Location::all();
        $Rests = Rest::all();
        return view('Admin.Service.create')->with('Rests',$Rests)->with('locations',$locations);
            
            
}
        $Serv = new Service;
        $Serv->rest_id = $request->rest_id;
        $Serv->location_id = $request->location_id;
        $Serv->del_charge = $request->del_charge;
        $Serv->del_time = $request->del_time;
        $Serv->lunch_time = $request->lunch_time;
        $Serv->dinner_time = $request->dinner_time;
        $Serv->save();
        //redirect to another page
        Session::flash('success','The Restaurant was saved!');
        return redirect()->route('services.show',$Serv->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
         $Serv = Service::find($id);
         return view('Admin.Service.Show')->with('Serv',$Serv);
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
        
        $Serv = Service::find($id);
        return view('Admin.Service.Edit')->with('Serv',$Serv);
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
        $this->validate($request,array(
                'lunch_time'=>'required',
                'dinner_time'=>'required',
                'del_time'=>'required|integer',
                'del_charge'=>'required|integer'
            ));

        $Serv = Service::find($id);
        
        $Serv->del_charge = $request->del_charge;
        $Serv->del_time = $request->del_time;
        $Serv->lunch_time = $request->lunch_time;
        $Serv->dinner_time = $request->dinner_time;
        $Serv->save();

         Session::flash('success','The Service was edited!');
        return redirect()->route('services.show',$Serv->id);

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
        $Serv = Service::find($id);
        $Serv->delete();
        Session::flash('success','The post Was Succesfully Deleted');
        return redirect()->route('services.index');
    }
}
