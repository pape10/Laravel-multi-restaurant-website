@extends('layout.app')
@section('title','All Restaurant')

@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="css/show-restaurants.css">
@endsection
@section('body')
	<div class="container">
<div class="row no-padding">
	@foreach($Rests as $Rest)
    <div class="col-sm-4 full-width-480 restaurant-style" >
                    
                        <div class="product-holder">
                            <div class="figure-holder">
                                <img src="{{url('/images/'.$Rest->image_name)}}" style="width: 100%;" alt="" >
                               
                            </div>
                            <div class="inner-detail ">
                                <h3 class="product-name"><a href="{{url('Hotels/'.$Rest->slug)}}"><center><span title="{{$Rest->restaurant_name}}">{{ substr($Rest->restaurant_name, 0, 25) }}{{ strlen($Rest->restaurant_name) > 25 ? "..." : "" }}</span></a></center></h3>
                                <h4><center><span class="fa fa-star"></span></center></h4>
                                <div class="tooltip1">
                                <span class="tooltiptext1">
                                    <p>cuisine : <strong>
                                    	@if($Rest->cuisine1 != '')
                                    		{{$Rest->cuisine1}}
                                    	@endif
                                    	
                                    	@if($Rest->cuisine2 != '')
                                    		,{{$Rest->cuisine2}}
                                    	@endif

                                    	@if($Rest->cuisine1 != '')
                                    		,{{$Rest->cuisine3}}
                                    	@endif
                                    </strong></p>
                                   
                                </span>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
       @endforeach
  
   </div>
        <div class="text-center">
           {!!$Rests->links()!!}
       </div>
   </div>

<br>
@endsection
