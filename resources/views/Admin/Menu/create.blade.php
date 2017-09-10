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
			<center><h1>Enter New Menu Of {{$Cat->rest->restaurant_name}} of Category {{$Cat->name}}</h1></center>
			<hr>
			{!!Form::open(array('route'=>['menus.store',$Cat->id],'data-parsley-validate'=>''))!!}

			{{Form::label('name','menu name')}}
			{{Form::text('name',null,array('class' => 'form-control','required'=>'','maxlength'=>'255'))}}

			{{Form::label('more','more details')}}
			{{Form::text('more',null,array('class' => 'form-control','required'=>''))}}

			{{Form::label('price','price')}}
			{{Form::text('price',null,array('class' => 'form-control','required'=>'','maxlength'=>'255'))}}
			<br>
			<center>
			{{Form::label('type','veg: ')}}
			{{ Form::radio('type', 'veg',['class' => 'form-control']) }}
			&nbsp&nbsp&nbsp&nbsp&nbsp
			{{Form::label('type','non veg: ')}}

			{{ Form::radio('type', 'nonveg',['class' => 'form-control']) }}<br>
			</center>
			{{Form::submit('Create',array('class' => 'btn btn-success btn-lg btn-block','style'=>'margin-top:5px;'))}}
			{!!Form::close()!!}
			<br>
		</div>
	</div>
@endsection
@section('scripts')
	{!!Html::script('js/parsley.min.js')!!}
@endsection