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
	      @if (Session::has('error'))
<div class="alert alert-danger" role="alert">
            <center><strong>UnSuccessfull :--{{Session::get('error')}}</strong></center>
        </div>
    @endif  
    <h2><center>For Restaurant {{$Serv->rest->restaurant_name}} To {{$Serv->location->name}}</center></h2>
{!!Form::model($Serv,array('route'=>['services.update',$Serv->id],'method' =>'put','data-parsley-validate'=>''))!!}
    				
			{{Form::label('del_charge','delivery charge')}}
			{{Form::text('del_charge',null,array('class' => 'form-control','required'=>'','type'=>'number','data-parsley-type'=>"number",'maxlength'=>'3'))}}
			{{Form::label('del_time','delivery charge')}}
			{{Form::text('del_time',null,array('class' => 'form-control','required'=>''))}}
			{{Form::label('lunch_time','lunch deleviery time')}}
			{{Form::time('lunch_time',null,array('class' => 'form-control','required'=>'','pattern'=>'\d{1,2}:\d{2}'))}}
			<small>please enter in 24hour format</small>
			<br>
			{{Form::label('dinner_time','dinner deleviery time')}}
			{{Form::time('dinner_time',null,array('class' => 'form-control','required'=>'','pattern'=>'\d{1,2}:\d{2}'))}}
    				<small>please enter in 24hour format</small>
    				{{Form::submit('Update',array('class' => 'btn btn-success btn-lg btn-block','style'=>'margin-top:5px;'))}}
                    {!!Form::close()!!}
                    <br>
                    {!!Html::linkRoute('services.show','Cancel',array($Serv->id),array('class'=>'btn btn-primary btn-block'))!!}
    <!-- end of form -->
   </div>
   
   </div>
   <br>
@endsection
@section('scripts')
	{!!Html::script('js/parsley.min.js')!!}
@endsection