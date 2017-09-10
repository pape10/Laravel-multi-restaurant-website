@extends('layouts_auth.app')
@section('stylesheet')
    
@endsection
@section('content')
<div class="container">
	<div class="row">
		{!!Html::linkRoute('menus.create','Enter New menu in this category',array($cat_id),array('class'=>'btn btn-primary btn-block'))!!}
	</div>
	<br>
	@if (Session::has('success'))
<div class="alert alert-success" role="alert">
            <strong>Successfull {{Session::get('success')}}</strong>
        </div>
    @endif  
    </div>
<div class="row">
<center>
{!!Html::linkRoute('categories.index','go back to categories page',array($rest_id),array('class'=>'btn btn-primary'))!!}</center>
	<div class="col-md-8 col-md-offset-2">
  <h1></h1>
		@foreach($Menus as $Menu)
		<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><center>Menu Name </center></h3>
  </div>
  <div class="panel-body">
    <center><label class="label label-primary">category name:- {{$Menu->category->name}}</label></center>
    
    <center><label class="label label-primary">menu name:- {{$Menu->name}}</label></center>
    <center><label class="label label-primary">restaurant name:- {{$Menu->category->Rest->restaurant_name}}</label></center>
    <center><label class="label label-primary">price:- {{$Menu->price}}</label></center>
    <center><label class="label label-primary">more:- {{$Menu->more}}</label></center>
    <center><label class="label label-primary">type:- {{$Menu->type}}</label></center>
    <hr>
                                    <center>
                                      
                                    {!!Form::open(array('route'=>['menus.destroy',$Menu->id],'method'=> 'DELETE'))!!}

                                {!!Form::submit('Delete',array('class'=>'btn btn-danger btn-block'))!!}

                                {!!Form::close()!!}
                                </center>
                                
  </div>
</div>
@endforeach
	</div>
	
</div>
<div class="text-center">
           {!!$Menus->links()!!}
       </div>
@endsection