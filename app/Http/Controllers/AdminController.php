<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Order;
class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin');
    }
    public function orders()
    {
        $rest_id = Auth::user()->rest_id;
        $Orders = Order::orderBy('id','desc')->where('rest_id','=',$rest_id)->paginate(15);
        return view('Restaurant_Owner.orders')->with('Orders',$Orders);
    }
}
