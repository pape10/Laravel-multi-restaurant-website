@extends('layouts_auth.app')

@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="css/show-restaurants.css">
@endsection
@section('content')
	<div class="container">
	<div class="row">
		<a href="{{route('tables.create')}}" class="btn btn-primary btn-block">Enter New Table Restaurant</a>
	</div>
	<br>
	@if (Session::has('success'))
<div class="alert alert-success" role="alert">
            <strong>Successfull {{Session::get('success')}}</strong>
        </div>
    @endif
    @if($Tables->count()<=0) 
    <div class="alert alert-danger" role="alert">
     <strong>SORRY WE DO HAVE NOTHING TO SHOW HERE</strong>
         </div>
    
    @endif
<div class="row no-padding">
	@foreach($Tables as $Table)
    <div class="col-sm-4 full-width-480 restaurant-style" >
                    
                        <div class="product-holder">
                            <div class="figure-holder">
                                <img src="{{url('/images/'.$Table->rest->image_name)}}" style="width: 100%;" alt="" >
                            </div>
                            <div class="inner-detail ">
                                <h3 class="product-name"><a href="#"><center><span title="{{$Table->rest->restaurant_name}}">{{$Table->rest->restaurant_name}}</span></a></center></h3>
                                <h4><center><span class="fa fa-star"></span></center></h4>
                                <div class="tooltip1">
                                </div>
                                <br>
                                {!!Form::open(array('route'=>['tables.destroy',$Table->id],'method'=> 'DELETE'))!!}

                                {!!Form::submit('Delete',array('class'=>'btn btn-danger btn-block'))!!}

                                {!!Form::close()!!}
                            </div>
                        </div>
                    </div>
       @endforeach
  
   </div>
        <div class="text-center">
           {!!$Tables->links()!!}
       </div>
   </div>

<br>
@endsection
