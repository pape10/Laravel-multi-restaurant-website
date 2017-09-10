@extends('layout.app')
@section('title','All Restaurant')

@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="css/show-restaurants.css">
@endsection
@section('body')
  <div class="container">
  @if (Session::has('table_error'))
<div class="alert alert-danger" role="alert">
            <strong>{{Session::get('table_error')}}</strong>
        </div>
    @endif
    @if (Session::has('error_table_confirm'))
<div class="alert alert-danger" role="alert">
            <strong>{{Session::get('error_table_confirm')}}</strong>
        </div>
    @endif
  @foreach($Tables as $Table)
    <div class="col-sm-4 full-width-480 restaurant-style" >
                    
                        <div class="product-holder">
                            <div class="figure-holder">
                                <img src="{{url('/images/'.$Table->rest->image_name)}}" style="width: 100%;" alt="" >
                               
                            </div>
                            <div class="inner-detail ">
                                <h3 class="product-name"><a href="{{url('Hotels/'.$Table->rest->slug)}}"><center><span title="{{$Table->rest->restaurant_name}}">{{$Table->rest->restaurant_name}}</span></center></a></h3>
                                <h4><center><span class="fa fa-star"></span></center></h4>
                                <div class="tooltip1">
                                <span class="tooltiptext1">
                                    <p>cuisine : <strong>
                                      @if($Table->rest->cuisine1 != '')
                                        {{$Table->rest->cuisine1}} ,
                                      @endif
                                      
                                      @if($Table->rest->cuisine2 != '')
                                        {{$Table->rest->cuisine2}} ,
                                      @endif

                                      @if($Table->rest->cuisine1 != '')
                                        {{$Table->rest->cuisine3}}
                                      @endif
                                    </strong></p>
                                    <p><strong><span></span></strong></p>
                                </span>
                                </div>
                                <br>
                                {!!Html::linkRoute('table.book','Book Table',array($Table->id),array('class'=>'btn btn-success btn-block'))!!}
                                <br>
                            </div>
                        </div>
                    </div>
       @endforeach
  
   </div>
        <div class="text-center">
           {!!$Tables->links()!!}
       </div>
   </div>

<br>
@endsection
