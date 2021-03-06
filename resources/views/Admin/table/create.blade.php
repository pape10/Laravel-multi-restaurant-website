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
			<center><h1>Enter New Location</h1></center>
			<hr>
			{!!Form::open(array('route'=>'tables.store','data-parsley-validate'=>''))!!}
			{{Form::label('rest_id','restaurant name')}}
			<select class="form-control" name="rest_id">
				@foreach($Rests as $Rest)
					<option value="{{$Rest->id}}">{{$Rest->restaurant_name}}</option>
				@endforeach
			</select>
			{{Form::submit('Create',array('class' => 'btn btn-success btn-lg btn-block','style'=>'margin-top:5px;'))}}
			{!!Form::close()!!}
			<br>
		</div>
	</div>
@endsection
@section('scripts')
	{!!Html::script('js/parsley.min.js')!!}
@endsection