@extends('layouts_auth.app')
@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="css/show-restaurants.css">
@endsection
@section('content')
	<div class="container">
<div class="row no-padding">
<!-- start of form -->
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
{!!Form::model($Rest,array('route'=>['Restaurants.update',$Rest->id],'method' =>'put','data-parsley-validate'=>''))!!}
    	{{Form::label('restaurant_name','Name Of Restaurant')}}
			{{Form::text('restaurant_name',null,array('class' => 'form-control','required'=>''))}}
			
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
			
			{{Form::submit('Update',array('class' => 'btn btn-success btn-lg btn-block','style'=>'margin-top:5px;'))}}

                    {!!Form::close()!!}
                    <br>
                    {!!Html::linkRoute('Restaurants.show','Cancel',array($Rest->id),array('class'=>'btn btn-primary btn-block'))!!}
    <!-- end of form -->
   </div>
   
   </div>
   <br>
@endsection
@section('scripts')
	{!!Html::script('js/parsley.min.js')!!}
@endsection