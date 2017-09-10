@extends('layouts_auth.app')
@section('stylesheet')
    
@endsection
@section('content')
<div class="container">
	<div class="row">
		{!!Html::linkRoute('categories.create','Enter New Category',array($rest_id),array('class'=>'btn btn-primary btn-block'))!!}
	</div>
	<br>
	@if (Session::has('success'))
<div class="alert alert-success" role="alert">
            <strong>Successfull {{Session::get('success')}}</strong>
        </div>
    @endif 
    
    @if($Cats->count()<=0) 
    <div class="alert alert-danger" role="alert">
     <strong>SORRY WE DO HAVE NOTHING TO SHOW HERE</strong>
         </div>
    
    @endif 
    </div>
<div class="row">
	<div class="col-md-8 col-md-offset-2">
  <h1></h1>
		@foreach($Cats as $Cat)
		<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><center>Category Name </center></h3>
  </div>
  <div class="panel-body">
    <center><label class="label label-primary">category name:- {{$Cat->name}}</label></center>
    
    <center><label class="label label-primary">restaurant name:- {{$Cat->rest->restaurant_name}}</label></center>
    <hr>
                                    <center>
                                      
    {!!Html::linkRoute('menus.index','view Menu For this Category',array($Cat->id),array('class'=>'btn btn-primary'))!!}
                                    
                                </center>
                                
  </div>
</div>
@endforeach
	</div>
	
</div>
<div class="text-center">
           {!!$Cats->links()!!}
       </div>
@endsection