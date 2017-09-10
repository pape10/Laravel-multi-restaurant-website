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
	      @if (Session::has('error'))
<div class="alert alert-danger" role="alert">
            <center><strong>UnSuccessfull :--{{Session::get('error')}}</strong></center>
        </div>
    @endif  
		<div class="col-md-8 col-md-offset-2">
			<center><h1>Enter New Location</h1></center>
			<hr>
			{!!Form::open(array('route'=>'services.store','data-parsley-validate'=>''))!!}
			{{Form::label('location_id','location name')}}
			<select class="form-control" name="location_id">
				@foreach($locations as $location)
					<option value="{{$location->id}}">{{$location->name}}</option>
				@endforeach
			</select>
			{{Form::label('rest_id','restaurant name')}}
			<select class="form-control" name="rest_id">
				@foreach($Rests as $Rest)
					<option value="{{$Rest->id}}">{{$Rest->restaurant_name}}</option>
				@endforeach
			</select>
			{{Form::label('del_charge','delivery charge')}}
			{{Form::text('del_charge',null,array('class' => 'form-control','required'=>'','type'=>'number','data-parsley-type'=>"number",'maxlength'=>'3'))}}
			{{Form::label('del_time','delivery time')}}
			{{Form::text('del_time',null,array('class' => 'form-control','required'=>''))}}
			{{Form::label('lunch_time','lunch deleviery time')}}
			{{Form::time('lunch_time',null,array('class' => 'form-control','required'=>'','pattern'=>'\d{1,2}:\d{2}'))}}
			<small>please enter in 24hour format</small>
			<br>
			{{Form::label('dinner_time','dinner deleviery time')}}
			{{Form::time('dinner_time',null,array('class' => 'form-control','required'=>'','pattern'=>'\d{1,2}:\d{2}'))}}
			<small>please enter in 24hour format</small>
			{{Form::submit('Create',array('class' => 'btn btn-success btn-lg btn-block','style'=>'margin-top:5px;'))}}
			{!!Form::close()!!}
			<br>
		</div>
	</div>
@endsection
@section('scripts')
	{!!Html::script('js/parsley.min.js')!!}
@endsection