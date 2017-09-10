@extends('layouts_auth.app')
@section('stylesheet')
    
@endsection
@section('content')
<div class="row">
	@if (!$errors->isEmpty()) 
	<div class="alert alert-danger" role="alert">
	 <strong>Errors:</strong>
	  <ul>
	   @foreach($errors->all() as $error)
	    <li>{{ $error }}</li>
	     @endforeach 
	     </ul> 
	     </div>
	      @endif
		<div class="col-md-8 col-md-offset-2">
			<center><h1>Enter New Coupon</h1></center>
			<hr>
			{!!Form::open(array('route'=>'coupons.store','data-parsley-validate'=>''))!!}
			{{Form::label('rest_id','restaurant name')}}
			<select class="form-control" name="rest_id">
				@foreach($Rests as $Rest)
					<option value="{{$Rest->id}}">{{$Rest->restaurant_name}}</option>
				@endforeach
			</select>
			{{Form::label('name','coupon code')}}
			{{Form::text('name',null,array('class' => 'form-control','required'=>'','maxlength'=>'10'))}}
			{{Form::label('perc','discount percentage')}}
			{{Form::text('perc',null,array('class' => 'form-control','required'=>'','maxlength'=>'2'))}}

			{{Form::label('minimum_amount','minimum amount')}}
			{{Form::text('minimum_amount',null,array('class' => 'form-control','required'=>'','maxlength'=>'3'))}}
			{{Form::submit('Create',array('class' => 'btn btn-success btn-lg btn-block','style'=>'margin-top:5px;'))}}
			{!!Form::close()!!}
			<br>
		</div>
	</div>
@endsection
@section('scripts')
	{!!Html::script('js/parsley.min.js')!!}
@endsection