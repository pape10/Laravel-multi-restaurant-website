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
			<center><h1>Enter New Menu Category Of {{$Rest->restaurant_name}}</h1></center>
			<hr>
			{!!Form::open(array('route'=>['categories.store',$rest_id],'data-parsley-validate'=>''))!!}

			{{Form::label('name','category name')}}
			{{Form::text('name',null,array('class' => 'form-control','required'=>'','maxlength'=>'255'))}}
			{{Form::submit('Create',array('class' => 'btn btn-success btn-lg btn-block','style'=>'margin-top:5px;'))}}
			{!!Form::close()!!}
			<br>
		</div>
	</div>
@endsection
@section('scripts')
	{!!Html::script('js/parsley.min.js')!!}
@endsection