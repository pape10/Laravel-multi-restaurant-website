<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rest;
use App\Table;
use Session;
class TablesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         $Tables = Table::orderBy('id','desc')->paginate(15);
        return view('Admin.table.index')->with('Tables',$Tables);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $Rests = Rest::all();
         return view('Admin.table.create')->with('Rests',$Rests);
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
                'rest_id'=>'required|integer|unique:tables,rest_id'
            ));
        $Table = new Table();
        $Table->rest_id = $request->rest_id;
        $Table->save();
        //redirect to another page
        Session::flash('success','The Restaurant was saved!');
        return redirect()->route('tables.index');
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
        $Table = Table::find($id);
        $Table->delete();
        Session::flash('success','The post Was Succesfully Deleted');
        return redirect()->route('tables.index');
    }
}
