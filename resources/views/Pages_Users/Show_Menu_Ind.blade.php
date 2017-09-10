@extends('layout.app')
@section('title','Menu')

@section('stylesheet')
    <link href="{{ asset('css/show-menu.css') }}" rel="stylesheet">
@endsection
@section('body')
	<a id="goToCart" href="{{route('cart.get')}}" style="text-decoration: none">Trolly<span class="fa fa-shopping-cart"></span></a>
	<div class="container-fluid">
    <img class="top-on-menu" src="{{url('/images/1.jpg')}}">
    <div class="over-image">
    <div class="container">
    <div class="row">
    <div class="col-sm-5"></div>
        <div class="col-sm-6"><h3 class=" center-aligning"><center><span class="fa fa-star"  style="color: white"></span></center></h3><h1 style="color:white"><center>{{$Rest->restaurant_name}}</center></h1>
        <p style="color: white"><center  style="color: white">{{$Rest->restaurant_address}}</center></p>
        <h3 style="color: white;"><center>{{$Rest->cuisine1}} , {{$Rest->cuisine2}} , {{$Rest->cuisine3}}</center></h3>
        </div>
        </div>
        </div>
    </div>
</div>
<br>
<div class="container-fluid">

    <div class="row">
        <div class="row">
         <center><a href="{{route('Location.get')}}" class="btn btn-primary">See All Restaurants</a></center>
    </div>
    </div>
</div>
<div class="container-fluid" style="margin-top: 12px;">
  <div class="row">
    
    <div class="col-sm-3">
    <div class=" hidden-sm hidden-md hidden-lg">
        <button class="btn btn-primary small-filter" data-toggle="modal" data-target="#cartModal">Filter</button>
    </div>
    <div class="visible-sm visible-md visible-lg">
    <h1 style="text-align: center">Filters</h1>
       <ul id="categories_filter">
                        <li title="all"><a href="{{url('Hotel/'.$Rest->slug)}}" ><strong>All</strong><span class="fa fa-chevron-right right-arrow"></span></a></li>
                        @foreach($Cats as $Cat)                    
                        <li title="{{$Cat->name}}"><a href="{{url('Hotel/'.$Rest->slug.'/filter/'.$Cat->id)}}" ><strong>{{$Cat->name}}</strong><span class="fa fa-chevron-right right-arrow"></span></a></li>
                        @endforeach    
                         
                    </ul>
                    </div>
  </div>

      <div class="col-sm-6 give-order">
         <table class="menu-show" style="">
         @foreach($Cats as $Cat)
         @if($Cat->id == $cat_id)
    <tr id="$Cat->id" style="background: red;"><td colspan=5>
                <h3 class="" style="text-align:center;color:black;border-radius:5px;text-decoration:underline;padding:5px;margin:5px 0;"><strong>{{$Cat->name}}</strong></h3></td></tr>
                @foreach($Cat->menus as $Menu)
                <tr id="menu-show-tr">
                <td width="60%" style="padding-left: 5px;"><span class="fa fa-circle {{$Menu->type}}"></span><strong>{{$Menu->name}}</strong><br>{{$Menu->more}}</td>
                <td style="width: 19%;text-align: right;">{{$Menu->price}}</td>
                <td class="text-center"><span data-toggle="modal" data-target="#mycartModal" data-id1="{{$Menu->id}}" data-id2="{{$Cat->rest->id}}" data-id3="{{$Menu->name}}" data-id4="{{$Menu->price}}" class="fa fa-plus-circle fa-lg
                 change-color modal_open" id="{{$Menu->name}}" name="{{$Menu->price}}" style="color:green;cursor:pointer;" title="Add to trolley" qty="1"></span></td></tr>
                 @endforeach
                 @endif
             @endforeach
                </table>
                <br>
    </div>
      </div> 
  </div>
   
   <div class="modal fade hidden-sm hidden-md hidden-lg" id="cartModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><center>FILTER</center></h4>
        </div>
        <div class="modal-body">
          <div class="">
    <h1 style="text-align: center">Filters</h1>
       <ul id="categories_filter">
        <li title="all"><a href="{{url('Hotel/'.$Rest->slug)}}" id="filteranchor"><strong>All</strong><span class="fa fa-chevron-right right-arrow"></span></a></li>
                        @foreach($Cats as $Cat)                    
                        <li title="{{$Cat->name}}"><a href="{{url('Hotel/'.$Rest->slug.'/filter/'.$Cat->id)}}" id="filteranchor"><strong>{{$Cat->name}}</strong><span class="fa fa-chevron-right right-arrow"></span></a></li>
                        @endforeach    
                         
                    </ul>
                    </div>
  </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
    <div class="modal fade" id="mycartModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#66ccff;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="color:white"><center>ADD TO TROLLEY</center></h4>
        </div>
        <div class="modal-body">
        
        <center style="color: red">**if your cart has items from some other restaurant finish up that order first or it will be deleted**</center>
        <center><strong><h1 id="cartId1"></h1></strong></center>
        <hr>
         <center><strong><h3 id="cartId2"></h3></strong></center>
                    {!!Form::open(array('route'=>['cart.set',$Rest->slug],'data-parsley-validate'=>''))!!}
                    {{Form::hidden('menu_id',null,['id' => 'cartId3'])}}
                    {{Form::hidden('rest_id',null,['id' => 'cartId4'])}}
                    <br>
                    <center>{{Form::label('qty','quantity')}}:
                    {{Form::number('qty', $value = '1' , ['min' => '1','max'=>'10' ,'class' => '', 'id' => 'number_count','required'])}}
                    </center>
                    <br>
                    <center>
                    {{Form::submit('Add To Cart',array('class' => 'btn btn-success btn-lg ','style'=>'margin-top:5px;'))}}
                    {!!Form::close()!!}
                    </center>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('scripts')
 
<script type="text/javascript">        
    $("a#filteranchor").click(function(){
    $('#cartModal').modal('hide')
    });
     $(function () {
        $(".modal_open").click(function () {
            var my_id_value1 = $(this).data('id1');
            var my_id_value2 = $(this).data('id2');
            var my_id_value3 = 'ITEM NAME: '+$(this).data('id3');
            var my_id_value4 = 'PRICE: Rs'+$(this).data('id4');
            $(".modal-body #cartId3").val(my_id_value1);
            $(".modal-body #cartId4").val(my_id_value2);
            $(".modal-body #cartId1").text(my_id_value3);
            $(".modal-body #cartId2").text(my_id_value4);
        })
    });
</script>

@endsection