<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
use App\Rest;
use Session;
class CouponsController extends Controller
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
        $Coupons = Coupon::orderBy('id','desc')->paginate(15);
        return view('Admin.Coupon.index')->with('Coupons',$Coupons);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $Rests = Rest::all();
        return view('Admin.Coupon.create')->with('Rests',$Rests);
    
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
                'name'=>'required|unique:coupons,name',
                'perc'=>'required|integer|max:99',
                'minimum_amount'=>'required|integer|max:999'
            ));
        //store the data to database
        
        $Coupon = new Coupon;
        $Coupon->rest_id = $request->rest_id;
        $Coupon->name = $request->name;
        $Coupon->perc = $request->perc;
        $Coupon->minimum_amount = $request->minimum_amount;
        $Coupon->save();
        //redirect to another page
        Session::flash('success','The Coupon was saved!');
        return redirect()->route('coupons.index');
    
    
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
        $Coupon = Coupon::find($id);
        $Coupon->delete();
        Session::flash('success','The post Was Succesfully Deleted');
        return redirect()->route('coupons.index');
    
    }
}
