@extends('layout.app')
@section('title','Done')

@section('stylesheet')
    
@endsection
@section('body')
<div class="row">
	<div class="col-md-6 col-md-offset-3">
	<div class="panel panel-success">
    <div class="panel-heading">Order Has Been Confirmed And Recorder</div>
    <div class="panel-body">
    	<div class="alert alert-success">
    		<center>Order Has Been Confirmed
    		<br>
    		Your Confirmation Number Is {{$orderid}}
    		</center>
    		<light>keep your confirmation number handy</light>
    	</div>
    </div>
  </div>
  </div>
  </div>
  <br>
  <br>
  <br>
  <br>
@endsection