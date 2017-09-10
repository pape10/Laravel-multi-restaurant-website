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
{!!Form::model($Loct,array('route'=>['locations.update',$Loct->id],'method' =>'put','data-parsley-validate'=>''))!!}
    	{{Form::label('name','Name Of Location')}}
			{{Form::text('name',null,array('class' => 'form-control','required'=>''))}}
			
			{{Form::submit('Update',array('class' => 'btn btn-success btn-lg btn-block','style'=>'margin-top:5px;'))}}

                    {!!Form::close()!!}
                    <br>
                    {!!Html::linkRoute('locations.show','Cancel',array($Loct->id),array('class'=>'btn btn-primary btn-block'))!!}
    <!-- end of form -->
   </div>
   
   </div>
   <br>
@endsection
@section('scripts')
	{!!Html::script('js/parsley.min.js')!!}
@endsection