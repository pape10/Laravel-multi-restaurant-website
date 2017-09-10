<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Cart;
use App\Rest;
use App\Menu;
use App\Location;
use App\Service;
use App\Order;
use App\Coupon;
use DateTime;
class CartsController extends Controller
{
    //
    public function setCart(Request $request,$slug)
    { 
        $rest = Rest::find($request->rest_id);
        $menu = Menu::find($request->menu_id);
        if(!($rest->slug == $slug && $menu->rest_id == $rest->id))
        {
            Session::flash('error_setcart','well this is embarrassing..the cart could not be updated!');
           return redirect()->route('Hotel.single',$slug);       
        }

        if ($request->session()->has('rest_id')&&$request->session()->get('rest_id')!=$rest->id) {
                   Cart::destroy();
                   $request->session()->forget('coupon');
                   Session::flash('msg_setcart','and Previous restaurant cart items have been deleted');
                   $request->session()->put('rest_id', $rest->id);
            }
        if (!$request->session()->has('rest_id')) {
                   $request->session()->put('rest_id', $rest->id);
            }
        Cart::add(['id' => $request->menu_id, 'name' => $menu->name, 'qty' => $request->qty, 'price' => $menu->price]);
        Session::flash('success_setcart','Cart Has Been Updated');
        return redirect()->route('Hotel.single',$slug); 
    }
    public function getCart(Request $request)
    {   
        if(Cart::count()&&$request->session()->has('rest_id'))
        {
        $rest_id = session('rest_id');
        $lid = session('location_id');
        $Service = Service::where('rest_id','=',$rest_id)->where('location_id','=',$lid)->first();
        $cart = Cart::content();
        Session::flash('true','1');
        $Disc=0;
        $subTotal = 0;
        foreach(Cart::content() as $Cart)
        {
            $subTotal = $subTotal + $Cart->price*$Cart->qty;
        }
        $total = 0;
        $del_charge = 0;
        if($subTotal<$Service->minimum_amount)
        {
            $del_charge = $Service->del_charge;
        }
        $total_after_del = $subTotal + $del_charge;

        if($request->session()->has('coupon'))
        {
            $coupon = $request->session()->get('coupon');
             $Coupon = Coupon::where('name','=',$coupon)->first();
             if($Coupon->minimum_amount<=$subTotal)
             {
                    $Disc = $total_after_del*($Coupon->perc)/100;
             }
             else
             {
                Session::flash('error_coupon','the minimum Cart amount for coupon '.$coupon.' to be valid is'.$Coupon->minimum_amount .' add more items into the cart and try again');
             }
        }

        $total = $total_after_del - $Disc;
        return view('Pages_Users.Cart')->with('cart',$cart)->with('Service',$Service)->with('Disc',$Disc)->with('subTotal',$subTotal)->with('total_after_del',$total_after_del)->with('total',$total)->with('del_charge',$del_charge);
        }
        else
        {
            Session::flash('true','0');
            Session::flash('error_getcart','No item is present in the cart');
        return view('Pages_Users.Cart');    
        }
    }
    public function checkOut(Request $request)
    {

        if(Cart::count()&&$request->session()->has('rest_id'))
        {
        date_default_timezone_set('Asia/Kolkata');
        $today_date = date('Y-m-d');
        $present = date('h-i a');
        $present_time = new DateTime("now");
        //or do DateTime::createFromFormat('H:i a', $lunch);
        $lunch = "10:18 am";
        $dinner = "07:45 pm";
       
        $lunch_time = DateTime::createFromFormat('H:i a', $lunch);
        $dinner_time = DateTime::createFromFormat('H:i a', $dinner);
        //in this time comparisons lunchtime greater and less than sign will be opp do not know why
        if($lunch_time < $present_time && $dinner_time > $present_time)
        {
            $sending_data = ['2'=>'todays dinner','3'=>'tomorrows lunch','4'=>'tomorrows dinner'];
            Session::flash('msg','you are late for ordering for todays lunch');
            return view('Pages_Users.CheckOut')->with('sending_data',$sending_data);
        }
        if($lunch_time < $present_time && $dinner_time < $present_time)
        {
            $sending_data = ['3'=>'tomorrows lunch','4'=>'tomorrows dinner'];
            Session::flash('msg','you are late for ordering for todays dinner');   
            return view('Pages_Users.CheckOut')->with('sending_data',$sending_data);
        }
        $sending_data = ['1'=>'todays lunch','2'=>'todays dinner','3'=>'tomorrows lunch','4'=>'tomorrows dinner'];
        return view('Pages_Users.CheckOut')->with('sending_data',$sending_data);
    }
    else
    {
        return redirect()->route('cart.get');
    }
    }
    public function complete(Request $request)
    {
        if(!$request->session()->has('rest_id')||!Cart::count()>0)
        {
            return redirect()->route('cart.get'); 
        }
        $this->validate($request,array(
                'name'=>'required|max:255',
                'email'=>'required|email|',
                'phone'=>'required|digits_between:9,12'
            ));
        $details="";
        foreach(Cart::content() as $c)
        {
            $details .= "(name:-".$c->name. " quantity: ".$c->qty. " price: " . $c->price . ")\n"; 
        }
        if(!($request->delivery_time==1||$request->delivery_time==2||$request->delivery_time==3||$request->delivery_time==4))
        {
            Session::flash('error_getcart','well its embarassing...something went wrong and we couldnot process your request . Please try again');
            
            return redirect()->route('cart.get');
        }
         date_default_timezone_set('Asia/Kolkata');
        $today_date = date('Y-m-d');
        $present = date('h-i a');
        $present_time = new DateTime("now");
        //or do DateTime::createFromFormat('H:i a', $lunch);
        $lunch = "10:18 am";
        $dinner = "07:45 pm";
        $tomorrow_date = date("Y-m-d", strtotime('tomorrow'));
        $lunch_time = DateTime::createFromFormat('H:i a', $lunch);
        $dinner_time = DateTime::createFromFormat('H:i a', $dinner);
        $del_time;
        $Order= new Order;
        
        if($request->delivery_time==1)
        {
            if($lunch_time < $present_time && $dinner_time > $present_time)
            {
                Session::flash('error_getcart','well its embarassing...something went wrong and we couldnot process your request . Please try again');
                return redirect()->route('cart.get');        
            }
            $Order->delivery_time = "lunch";
            $Order->delivery_date = $today_date;
        }
        if($request->delivery_time==2)
        {
            if($lunch_time < $present_time && $dinner_time < $present_time)
            {
                Session::flash('error_getcart','well its embarassing...something went wrong and we couldnot process your request . Please try again');
                return redirect()->route('cart.get');        
            }
            $Order->delivery_time = "dinner";
            $Order->delivery_date = $today_date;
        }
        if($request->delivery_time==3)
        {

            $Order->delivery_time = "lunch";
            $Order->delivery_date = $tomorrow_date;
        }
        if($request->delivery_time==4)
        {
            $Order->delivery_time = "dinner";
            $Order->delivery_date = $tomorrow_date;
        }
        //store the data to database
        $rest_id = session('rest_id');
        $lid = session('location_id');
        $Serv = Service::where('rest_id','=',$rest_id)->where('location_id','=',$lid)->first();
        $Rest = Rest::find($request->session()->get('rest_id'));
        $subTotal = 0;
        foreach(Cart::content() as $Cart)
        {
            $subTotal = $subTotal + $Cart->price*$Cart->qty;
        }
        $total = $subTotal;
        if($subTotal<$Serv->minimum_amount)
        {
            $total= $total + $Serv->del_charge;
        }
        $Order->total = $total;
        $Disc=0;
        if($request->session()->has('coupon'))
        {
            $coupon = $request->session()->get('coupon');
             $Coupon = Coupon::where('name','=',$coupon)->first();
             if($Coupon->minimum_amount<=$subTotal)
             {
                    $Disc = $subTotal*($Coupon->perc)/100;
             }
        }
        $total = $total - $Disc;
        $Order->discount = $Disc;
        $Order->after_discount = $total;
        $Order->rest_name = $Rest->restaurant_name;
        $Order->name = $request->name;
        $Order->email = $request->email;
        $Order->phone = $request->phone;
        $Order->address = $request->address;
        $Order->rest_id = $Rest->id;
        $Order->order_det = $details; 
        
        $request->session()->forget('rest_id');
        $request->session()->forget('coupon');
        $stamp = strtotime("now");
        $orderid = 'FT-'.$stamp; 
        $orderid = str_replace(".", "", $orderid); 
        $Order->ocn = $orderid;
        $Order->save();
        Cart::destroy();
        $request->session()->forget('coupon');
        return view('Pages_Users.cnr')->with('orderid',$orderid);
        }
    public function remove($menu_id)
    {
        Cart::remove($menu_id);
        return redirect()->route('cart.get'); 
    }
    public function Destroy(Request $request)
    {
        Cart::destroy();
        $request->session()->forget('rest_id');
        $request->session()->forget('coupon');
        return redirect()->route('Location.get');
    }
    public function setCoupon(Request $request)
    {
        $coupon = $request->name;
        
        $Coupon = Coupon::where('name','=',$coupon)->first();
        if($Coupon == null)
        {
            Session::flash('error_coupon','Coupon is invalid');
            return redirect()->route('cart.get'); 
        }
        if($Coupon->rest_id == $request->session()->get('rest_id'))
        {
                Session::flash('error_coupon','Coupon is invalid for this restaurant');
            return redirect()->route('cart.get');     
        }
        $subTotal = 0;
        foreach(Cart::content() as $Cart)
        {
            $subTotal = $subTotal + $Cart->price*$Cart->qty;
        }
        if($subTotal<$Coupon->minimum_amount)
        {
            
            Session::flash('error_coupon','the minimum Cart amount for this coupon to be valid is'.$Coupon->minimum_amount .' add more items into the cart and try again');
            return redirect()->route('cart.get');     
        }
        $request->session()->put('coupon',$Coupon->name);
        return redirect()->route('cart.get');     
        
    }
    public function bringSlug(Request $request)
    {
        if(!$request->session()->has('rest_id'))
        {
            return redirect()->route('Location.get');
        }
        $id = $request->session()->get('rest_id');
        $Rest = Rest::find($id);
        return redirect()->route('Hotel.single',$Rest->slug);    
    }

}

