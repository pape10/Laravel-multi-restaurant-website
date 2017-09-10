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
    <h3 class="panel-title"><center>SERVICE NAME</center></h3>
  </div>
  <div class="panel-body">
    <center><label class="label label-primary">restaurant name:-{{$Serv->rest->restaurant_name}}</label></center>

    <center><label class="label label-primary">delivery location :-{{$Serv->location->name}}</label></center>


    <center><label class="label label-primary">delivery charge:-{{$Serv->del_charge}}</label></center>

    <center><label class="label label-primary">delivery time:-{{$Serv->del_time}}</label></center>

    <center><label class="label label-primary">lunch delivery time:-{{$Serv->lunch_time}}</label></center>
    <center><label class="label label-primary">dinner delivery time:-{{$Serv->dinner_time}}</label></center>
    <hr>
                                    <center>

                                    {!!Html::linkRoute('services.edit','Edit',array($Serv->id),array('class'=>'btn btn-primary btn-block'))!!}
                                <br>
                                {!!Form::open(array('route'=>['services.destroy',$Serv->id],'method'=> 'DELETE'))!!}

                                {!!Form::submit('Delete',array('class'=>'btn btn-danger btn-block'))!!}

                                {!!Form::close()!!}
                                </center>
                                
  </div>
</div>
  </div>
  
</div>
@endsection