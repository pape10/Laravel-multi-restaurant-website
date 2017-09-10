@extends('layouts_auth.app')
@section('stylesheet')
    
@endsection
@section('content')
<div class="container">
	<div class="row">
		<a href="{{route('coupons.create')}}" class="btn btn-primary btn-block">Enter New Coupon Details</a>
	</div>
	<br>
	@if (Session::has('success'))
<div class="alert alert-success" role="alert">
            <strong>Successfull {{Session::get('success')}}</strong>
        </div>
    @endif  
    </div>
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		@foreach($Coupons as $Coupon)
		<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><center>Coupon NAME</center></h3>
  </div>
  <div class="panel-body">
    <center><label class="label label-primary">restaurant name:-</label></center>

    <center><label class="label label-primary">coupon code :-{{$Coupon->name}}</label></center>

    <center><label class="label label-primary">disc perc:-{{$Coupon->perc}}</label></center>

    <center><label class="label label-primary">minimum amount:-{{$Coupon->minimum_amount}}</label></center>
    <hr>
                                    <center>

                                    &nbsp &nbsp &nbsp &nbsp
                                    {!!Form::open(array('route'=>['coupons.destroy',$Coupon->id],'method'=> 'DELETE'))!!}

                                {!!Form::submit('Delete',array('class'=>'btn btn-danger btn-block'))!!}

                                {!!Form::close()!!}
                                
                                    &nbsp &nbsp &nbsp &nbsp
                                </center>
                                
  </div>
</div>
@endforeach
	</div>
	
</div>
<div class="text-center">
           {!!$Coupons->links()!!}
       </div>
@endsection