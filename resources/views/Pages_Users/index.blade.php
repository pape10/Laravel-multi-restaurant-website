@extends('layout.app')
@section('title','Home')

@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="css/index.css">
@endsection
@section('body')
<!--	displaying the select location for larger screen devices and display of image slider-->
@if (Session::has('error_finding_location'))
<div class="alert alert-danger" role="alert">
            <strong><center>{{Session::get('error_finding_location')}}</center></strong>
        </div>
    @endif

    <div class="container-fluid">
  
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        <img src="images/1.jpg" alt="Los Angeles" style="width:100%;">
      </div>

      <div class="item">
        <img src="images/2.jpg" alt="Chicago" style="width:100%;">
      </div>
    
      <div class="item">
        <img src="images/3.jpg" alt="New york" style="width:100%;">
      </div>
    </div>
    <div class="over-image">
        
<div class="container   visible-sm visible-md visible-lg" id="sel1">

        <script type="text/javascript">
    $(function () {
  count = 0;
  wordsArray = ["order from restaurants near you","no minimum order","free home delivery"];
  setInterval(function () {
    count++;
    $("#changeText1").fadeOut(700, function () {
      $(this).text(wordsArray[count % wordsArray.length]).fadeIn(400);
    });
  }, 2000);
});
    </script>
    <div class="col-sm-6 col-md-offset-5" id="food_home_del">
      @if(!Session::has('location_id'))
<h1 id="changeText" style="text-align:center;margin-top: 15px;font-style: oblique;">order from restaurants near you</h1>
  @endif
  @if(Session::has('location_id'))

<h1 style="text-align:center;margin-top: 15px;font-style: oblique;">Change Location</h1>
  @endif
    {!!Form::open(array('route'=>'Location.set','data-parsley-validate'=>'','class'=>'input-group'))!!}
    <select class="form-control" name="location_id">
       @foreach($locations as $location)
          <option value="{{$location->id}}">{{$location->name}}</option>
        @endforeach
  </select>
  <span class="input-group-btn">
     {{Form::submit('ORDER',array('class' => 'btn btn-success','style'=>''))}}
    
      </span>
      {!!Form::close()!!}

    </div>
    <div class="col-sm-3"></div>

</div>
    </div>
    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
<br>
<!--end displaying the select location for slarger screen devices and end display of image slider-->
<!--	displaying the select location for smaller screen devices -->
<div class="hidden-sm hidden-md hidden-lg">
@if(!Session::has('location_id'))

<h1 id="changeText" style="text-align:center;margin-top: 15px;font-style: oblique;">order from restaurants near you</h1>
  @endif
  @if(Session::has('location_id'))

<h1 style="text-align:center;margin-top: 15px;font-style: oblique;">Change Location</h1>
  @endif
    <script type="text/javascript">
    $(function () {
  count = 0;
  wordsArray = ["order from restaurants near you","no minimum order","free home delivery"];
  setInterval(function () {
    count++;
    $("#changeText").fadeOut(700, function () {
      $(this).text(wordsArray[count % wordsArray.length]).fadeIn(400);
    });
  }, 2000);
});
    </script>
<div class="container" id="sel1">
    <div class="col-sm-3"></div>

    <div class="col-sm-6" id="food_home_del">
    {!!Form::open(array('route'=>'Location.set','data-parsley-validate'=>'','class'=>'input-group'))!!}
    <select class="form-control" name="location_id">
       @foreach($locations as $location)
          <option value="{{$location->id}}">{{$location->name}}</option>
        @endforeach
  </select>
  <span class="input-group-btn">
     {{Form::submit('ORDER',array('class' => 'btn btn-success','style'=>''))}}
    
      </span>
      {!!Form::close()!!}
    </div>
    <div class="col-sm-3"></div>

</div>
</div>
<!-- end location for smaller screen device -->
<!-- Displaying few Restaurants -->
<!-- Displaying few restaurants end -->
<!-- displaying all service 
 <div class="container">
    <h1 style="margin-bottom: 30px;margin-left: 30px;"><center><font face="verdana">How To Order!</font></center></h1>
        <div class="row">
         <div class="col-sm-1"></div>
            <div class="col-sm-3" >
            <figure><center><img src="images/delivery.jpg" class="img-responsive"></center></figure>
                <figcaption><center>home delivery</center></figcaption>
            </div>
            <div class="col-sm-1"></div>
            <div class="col-sm-3" >
            <figure><center><img src="images/book-a-table.png" class="img-responsive"></center></figure>
                <figcaption><center>book a table</center></figcaption>
            </div>
            <div class="col-sm-1"></div>
            <div class="col-sm-3" >
            <figure><center><img src="images/bulk-orders.jpg" class="img-responsive"></center></figure>
                <figcaption><center>BULK ORDER</center></figcaption>
            </div>
            
        </div>
    </div>-->
<!-- end displaying all service -->
<!--displaying some new restaurants-->
<div class="container">
<h1 style="margin-bottom: 30px;margin-left: 30px;"><center><font face="verdana">How To Order!</font></center></h1>  
<div class="row">
    <div class="col-md-3">
                <div class="box_home  order-process-box" id="four">
                    <center>
                    <span style="font-size: 100px" class="fa fa-map-marker "></span>
                    <h3>Select Location </h3>
                    <p>
                        Select the location where you want your food to be delivered
                    </p>
                    </center>
                </div>
            </div>
            <div class="col-md-3">

                <div class="box_home  order-process-box" id="four">
                    <center>
                    <span style="font-size: 100px;color:#ffff99" class="fa fa-cutlery "></span>
                    <h3>Choose Restaurant</h3>
                    <p>
                        Choose A Restaurant From Where You Want To Order
                    </p>
                    </center>
                </div>
            </div>  
    <div class="col-md-3">
                <div class="box_home order-process-box" id="four">
                    <center>
                    <span style="font-size: 100px" class="fa fa-shopping-cart "></span>
                    <h3>Add To Cart</h3>
                    <p>
                       Add The Food You Want To Be Delivered To The Cart
                    </p>
                    </center>
                </div>
            </div>
      
            <div class="col-md-3">
                <div class="box_home  order-process-box" id="four">
                    <center>
                    <span style="font-size: 100px" class="fa fa-check "></span>
                    <h3>Check Out </h3>
                    <p>
                        Enter Your Details And We Will Deliver Your Food
                    </p>
                    </center>
                </div>
            </div>    

  </div>
</div>
@endsection


@section('scripts')

@endsection