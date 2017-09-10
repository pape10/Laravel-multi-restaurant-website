@extends('layouts_auth.app')

@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="css/show-restaurants.css">
@endsection
@section('content')
	<div class="container">
	<div class="row">
		<a href="{{route('Restaurants.create')}}" class="btn btn-primary btn-block">Enter New Restaurant Details</a>
	</div>
	<br>
	@if (Session::has('success'))
<div class="alert alert-success" role="alert">
            <strong>Successfull {{Session::get('success')}}</strong>
        </div>
    @endif
    @if($Rests->count()<=0) 
    <div class="alert alert-danger" role="alert">
     <strong>SORRY WE DO HAVE NOTHING TO SHOW HERE</strong>
         </div>
    
    @endif
<div class="row no-padding">
	@foreach($Rests as $Rest)
    <div class="col-sm-4 full-width-480 restaurant-style" >
                    
                        <div class="product-holder">
                            <div class="figure-holder">
                                <img src="{{url('/images/'.$Rest->image_name)}}" style="width: 100%;" alt="" >
                            </div>
                            <div class="inner-detail ">
                                <h3 class="product-name"><a href="#"><center><span title="{{$Rest->restaurant_name}}">{{$Rest->restaurant_name}}</span></a></center></h3>
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
                                    <p>delivers in : <strong>75mins</strong></p>
                                </span>
                                </div>
                                {!!Html::linkRoute('Restaurants.show','View',array($Rest->id),array('class'=>'btn btn-primary btn-block'))!!}
                                {!!Html::linkRoute('show.order.ind','See Orders',array($Rest->id),array('class'=>'btn btn-primary btn-block'))!!}
                                {!!Html::linkRoute('Restaurants.edit','Edit',array($Rest->id),array('class'=>'btn btn-primary btn-block'))!!}
                                <br>
                                {!!Form::open(array('route'=>['Restaurants.destroy',$Rest->id],'method'=> 'DELETE'))!!}

                                {!!Form::submit('Delete',array('class'=>'btn btn-danger btn-block'))!!}

                                {!!Form::close()!!}
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
