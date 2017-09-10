<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Rest;
use App\Service;
use Session;
use App\Location;
use Cart;
use App\Message;
use App\Table;
use App\TableBooking;
use DateTime;

class PagesController extends Controller
{
	public function getIndex()
	{
		$locations = Location::all();
		$Rests = Rest::orderBy('id','desc')->limit(3)->get();
		return view('Pages_Users.index')->with('Rests',$Rests)->with('locations',$locations);
	}
	public function SetLocation(Request $request)
	{
		$lid = $request->location_id;
		$request->session()->put('location_id', $lid);
		Cart::destroy();
		$request->session()->forget('rest_id');
		$request->session()->forget('coupon');
		$Servs = Service::where('location_id','=',$lid)->paginate(15);
		return view('Pages_Users.ShowAlongLocation')->with('Servs',$Servs);

	}
	public function GetLocationData()
	{
		
		$lid = Session('location_id');
		$Servs = Service::where('location_id','=',$lid)->paginate(15);
		return view('Pages_Users.ShowAlongLocation')->with('Servs',$Servs);
	}
	public function tableShow()
	{
		$Tables = Table::orderBy('id','desc')->paginate('15');
		return view('Pages_Users.SeeTableRestaurants')->with('Tables',$Tables);
	}
	public function tableBookForm(Request $request,$id)
	{
		$Table = Table::find($id);
		if($Table == null)
		{
			Session::flash('table_error','Wll its embarassing we couldnot find this restaurant');
			return redirect()->route('table.show');
		}
		date_default_timezone_set('Asia/Kolkata');
        $today_date = date('Y-m-d');
        $present = date('h-i a');
        $present_time = new DateTime("now");
        //or do DateTime::createFromFormat('H:i a', $lunch);
        $lunch = "11:55 am";
        $dinner = "07:45 pm";
       
        $lunch_time = DateTime::createFromFormat('H:i a', $lunch);
        $dinner_time = DateTime::createFromFormat('H:i a', $dinner);
        //in this time comparisons lunchtime greater and less than sign will be opp do not know why
        if($lunch_time < $present_time && $dinner_time > $present_time)
        {
            $sending_data = ['2'=>'todays dinner','3'=>'tomorrows lunch','4'=>'tomorrows dinner'];
            Session::flash('msg','you are late for booking table for todays lunch');
            return view('Pages_Users.tablebookform')->with('sending_data',$sending_data);
        }
        if($lunch_time < $present_time && $dinner_time < $present_time)
        {
            $sending_data = ['3'=>'tomorrows lunch','4'=>'tomorrows dinner'];
            Session::flash('msg','you are late for booking table for todays dinner');   
            return view('Pages_Users.tablebookform')->with('sending_data',$sending_data);
        }
        $sending_data = ['1'=>'todays lunch','2'=>'todays dinner','3'=>'tomorrows lunch','4'=>'tomorrows dinner'];
        return view('Pages_Users.tablebookform')->with('Table',$Table)->with('sending_data',$sending_data);
	}




	public function completeTable(Request $request,$id)
	{
		$Table = Table::find($id);
		if($Table == null)
		{
			Session::flash('table_error','Wll its embarassing we couldnot find this restaurant');
			return redirect()->route('table.show');
		}
		 $this->validate($request,array(
                'name'=>'required|max:255',
                'email'=>'required|email|',
                'phone'=>'required|digits_between:9,12'
            ));
		 if(!($request->delivery_time==1||$request->delivery_time==2||$request->delivery_time==3||$request->delivery_time==4))
        {
            Session::flash('error_table_confirm','well its embarassing...something went wrong and we couldnot process your request . Please try again');
            return redirect()->route('table.show');
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
        $TableBooking= new TableBooking;
        if($request->delivery_time==1)
        {
            if($lunch_time < $present_time && $dinner_time > $present_time)
            {
                Session::flash('error_table_confirm','well its embarassing...something went wrong and we couldnot process your request . Please try again');
                return redirect()->route('table.show');        
            }
            $TableBooking->booking_time = "lunch";
            $TableBooking->booking_date = $today_date;
        }
        if($request->delivery_time==2)
        {
            if($lunch_time < $present_time && $dinner_time < $present_time)
            {
                Session::flash('error_table_confirm','well its embarassing...something went wrong and we couldnot process your request . Please try again');
                return redirect()->route('table.show');        
            }
            $TableBooking->booking_time = "dinner";
            $TableBooking->booking_date = $today_date;
        }
        if($request->delivery_time==3)
        {

            $TableBooking->booking_time = "lunch";
            $TableBooking->booking_date = $tomorrow_date;
        }
        if($request->delivery_time==4)
        {
            $TableBooking->booking_time = "dinner";
            $TableBooking->booking_date = $tomorrow_date;
        }
        $TableBooking->rest_name = $Table->rest->restaurant_name;
        $TableBooking->name = $request->name;
        $TableBooking->email = $request->email;
        $TableBooking->phone = $request->phone;
        $stamp = strtotime("now");
        $orderid = 'FTB-'.$stamp; 
        $orderid = str_replace(".", "", $orderid); 
        $TableBooking->bcn = $orderid;
        $TableBooking->rest_id = $Table->rest_id;
        $TableBooking->save();	
        return view('Pages_Users.cnr')->with('orderid',$orderid);
	} 





	public function getAboutUs()
	{
		return view('Pages_Users.FooterPages.about');		
	}
	public function getTerms()
	{
		return view('Pages_Users.FooterPages.terms');	
	}
	public function privacyPolices()
	{
		return view('Pages_Users.FooterPages.privacy');
	}
	public function getFaqs()
	{
		return view('Pages_Users.FooterPages.faqs');
	}
	public function saveMessage(Request $request)
	{
		$this->validate($request,array(
                'name'=>'required|max:255',
                'email'=>'required|min:5|max:255',
                'message'=>'required|min:5|max:1000'
            ));
		$Message= new Message;
        $Message->name = $request->name;
        $Message->email = $request->email;
        $Message->message = $request->message;
        $Message->save();
        //redirect to another page
        Session::flash('success','The Message Was Sent!');
		return redirect()->route('aboutus');
	}
}
?>