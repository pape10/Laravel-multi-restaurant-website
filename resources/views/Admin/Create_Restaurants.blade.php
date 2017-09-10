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
			<center><h1>Enter New Hotel Details</h1></center>
			<hr>
			{!!Form::open(array('route'=>'Restaurants.store','data-parsley-validate'=>''))!!}
			{{Form::label('restaurant_name','Name Of Restaurant')}}
			{{Form::text('restaurant_name',null,array('class' => 'form-control','required'=>'','minlength'=>'5','maxlength'=>'255'))}}
			{{Form::label('slug','Slug')}}
			{{Form::text('slug',null,array('class' => 'form-control','required'=>'','minlength'=>'5','maxlength'=>'255'))}}
			{{Form::label('restaurant_address','Restaurant Address')}}
			{{Form::text('restaurant_address',null,array('class' => 'form-control'))}}
			{{Form::label('cuisine1','Name Of Cuisine1')}}
			{{Form::text('cuisine1',null,array('class' => 'form-control'))}}
			{{Form::label('cuisine2','Name Of Cuisine2')}}
			{{Form::text('cuisine2',null,array('class' => 'form-control'))}}
			{{Form::label('cuisine3','Name Of Cuisine3')}}
			{{Form::text('cuisine3',null,array('class' => 'form-control'))}}
			{{Form::label('phone','phone')}}
			{{Form::text('phone',null,array('class' => 'form-control'))}}
			{{Form::label('email','email')}}
			{{Form::email('email',null,array('class' => 'form-control'))}}
			{{Form::label('image_name','image name')}}
			{{Form::text('image_name',null,array('class' => 'form-control'))}}
			{{Form::submit('Create',array('class' => 'btn btn-success btn-lg btn-block','style'=>'margin-top:5px;'))}}
			{!!Form::close()!!}
			<br>
		</div>
	</div>
@endsection
@section('scripts')
	{!!Html::script('js/parsley.min.js')!!}
@endsection