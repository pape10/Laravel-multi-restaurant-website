@extends('layout.app')
@section('title','All Restaurant')

@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="css/show-restaurants.css">
@endsection
@section('body')
	<div class="container">
<div class="row no-padding">
    @if($Servs->count()<=0) 
    <div class="alert alert-danger" role="alert">
     <strong>SORRY WE DO NOT SERVE IN YOUR LOCATION</strong>
         </div>
    
    @endif
    @if (Session::has('error_slug'))
<div class="alert alert-danger" role="alert">
            <strong>{{Session::get('error_slug')}}</strong>
        </div>
    @endif
	@foreach($Servs as $Serv)
    <div class="col-sm-4 full-width-480 restaurant-style" >
                    
                        <div class="product-holder">
                            <div class="figure-holder">
                                <img src="{{url('/images/'.$Serv->rest->image_name)}}" style="width: 100%;" alt="" >
                               
                            </div>
                            <div class="inner-detail ">
                                <h3 class="product-name"><a href="{{url('Hotel/'.$Serv->rest->slug)}}"><center><span title="{{$Serv->Rest->restaurant_name}}">{{ substr($Serv->rest->restaurant_name, 0, 25) }}{{ strlen($Serv->rest->restaurant_name) > 25 ? "..." : "" }}</span></a></center></h3>
                                <h4><center><span class="fa fa-star"></span></center></h4>
                                <div class="tooltip1">
                                <span class="tooltiptext1">
                                    <p>cuisine : <strong>
                                    	@if($Serv->Rest->cuisine1 != '')
                                    		{{$Serv->Rest->cuisine1}} ,
                                    	@endif
                                    	
                                    	@if($Serv->Rest->cuisine2 != '')
                                    		{{$Serv->Rest->cuisine2}} ,
                                    	@endif

                                    	@if($Serv->Rest->cuisine1 != '')
                                    		{{$Serv->Rest->cuisine3}}
                                    	@endif
                                    </strong></p>
                                    <p><strong><span></span></strong></p>
                                </span>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
       @endforeach
  
   </div>
        <div class="text-center">
           {!!$Servs->links()!!}
       </div>
   </div>

<br>
@endsection
