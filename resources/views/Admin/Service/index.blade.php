@extends('layouts_auth.app')
@section('stylesheet')
    
@endsection
@section('content')
<div class="container">
	<div class="row">
		<a href="{{route('services.create')}}" class="btn btn-primary btn-block">Enter New Service Details</a>
	</div>
	<br>
	@if (Session::has('success'))
<div class="alert alert-success" role="alert">
            <strong>Successfull {{Session::get('success')}}</strong>
        </div>
    @endif  
    </div>
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		@foreach($Servs as $Serv)
		<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><center>SERVICE NAME</center></h3>
  </div>
  <div class="panel-body">
    <center><label class="label label-primary">restaurant name:-{{$Serv->rest->restaurant_name}}</label></center>

    <center><label class="label label-primary">delivery location :-{{$Serv->location->name}}</label></center>

    <center><label class="label label-primary">delivery charge :-{{$Serv->del_charge}}</label></center>

    <center><label class="label label-primary">delivery time:-{{$Serv->del_time}}</label></center>
    <center><label class="label label-primary">lunch delivery time:-{{$Serv->lunch_time}}</label></center>
    <center><label class="label label-primary">dinner delivery time:-{{$Serv->dinner_time}}</label></center>
    <hr>
                                    <center>

                                    &nbsp &nbsp &nbsp &nbsp
                                    {!!Html::linkRoute('services.show','View',array($Serv->id),array('class'=>'btn btn-primary'))!!}
                                    &nbsp &nbsp &nbsp &nbsp
                                </center>
                                
  </div>
</div>
@endforeach
	</div>
	
</div>
<div class="text-center">
           {!!$Servs->links()!!}
       </div>
@endsection