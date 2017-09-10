@extends('layouts_auth.app')
@section('stylesheet')
    
@endsection
@section('content')
<div class="container">
	<div class="row">
		<a href="{{route('locations.create')}}" class="btn btn-primary btn-block">Enter New Location Details</a>
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
		@foreach($Locts as $loct)
		<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><center>LOCATION NAME</center></h3>
  </div>
  <div class="panel-body">
    <center>{{$loct->name}}</center>
    <hr>
                                    <center>

                                    &nbsp &nbsp &nbsp &nbsp
                                    {!!Html::linkRoute('locations.show','View',array($loct->id),array('class'=>'btn btn-primary'))!!}
                                    &nbsp &nbsp &nbsp &nbsp
                                </center>
                                
  </div>
</div>
@endforeach
	</div>
	
</div>
<div class="text-center">
           {!!$Locts->links()!!}
       </div>
@endsection