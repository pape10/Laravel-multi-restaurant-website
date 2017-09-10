<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function showAll()
    {

    	$Orders = Order::orderBy('id','desc')->paginate(15);
    	return view('Admin.Order.seeall')->with('Orders',$Orders);
    }
    public function showInd($rest_id)
    {
    	$Orders = Order::orderBy('id','desc')->where('rest_id','=',$rest_id)->paginate(15);
    	return view('Admin.Order.seeall')->with('Orders',$Orders);	
    }
}
