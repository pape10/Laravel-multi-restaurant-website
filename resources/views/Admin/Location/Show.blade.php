@extends('layouts_auth.app')
@section('stylesheet')
    
@endsection
@section('content')
<div class="container">
  @if (Session::has('success'))
<div class="alert alert-success" role="alert">
      <strong>Successfull {{Session::get('success')}}</strong>
    </div>
  @endif
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
</div>
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><center>LOCATION NAME</center></h3>
  </div>
  <div class="panel-body">
    <center>{{$loct->name}}</center>
    <hr>
                                    <center>
                                {!!Html::linkRoute('locations.edit','Edit',array($loct->id),array('class'=>'btn btn-primary'))!!}
                                </center>
                                <br>
                                {!!Form::open(array('route'=>['locations.destroy',$loct->id],'method'=> 'DELETE'))!!}
                                <center>
                                {!!Form::submit('Delete',array('class'=>'btn btn-danger'))!!}
                                </center>
                                {!!Form::close()!!}
  
  </div>
</div>
	</div>
</div>

@endsection