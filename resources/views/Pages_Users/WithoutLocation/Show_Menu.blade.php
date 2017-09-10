@extends('layout.app')
@section('title','Menu')

@section('stylesheet')
    <link href="{{ asset('css/show-menu.css') }}" rel="stylesheet">
@endsection
@section('body')
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
         <center><a href="{{url('Hotels')}}" class="btn btn-primary">See All Restaurants</a></center>
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
        <li title="all"><a href="{{url('Hotels/'.$Rest->slug)}}" ><strong>All</strong><span class="fa fa-chevron-right right-arrow"></span></a></li>
                        @foreach($Cats as $Cat)                    
                        <li title="{{$Cat->name}}"><a href="{{url('Hotels/'.$Rest->slug.'/filters/'.$Cat->id)}}" ><strong>{{$Cat->name}}</strong><span class="fa fa-chevron-right right-arrow"></span></a></li>
                        @endforeach    
                         
                    </ul>
                    </div>
  </div>

      <div class="col-sm-6 give-order">
         <table class="menu-show" style="">
         @foreach($Cats as $Cat)
    <tr id="$Cat->id" style="background: red;"><td colspan=5>
                <h3 class="" style="text-align:center;color:black;border-radius:5px;text-decoration:underline;padding:5px;margin:5px 0;"><strong>{{$Cat->name}}</strong></h3></td></tr>
                @foreach($Cat->menus as $Menu)
                <tr id="menu-show-tr">
                <td width="60%" style="padding-left: 5px;"><span class="fa fa-circle {{$Menu->type}}"></span><strong>{{$Menu->name}}</strong><br>{{$Menu->more}}</td>
                <td style="width: 19%;text-align: right;padding-right: 10px;">{{$Menu->price}}</td>
                
                 @endforeach
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
       <li title="all"><a href="{{url('Hotels/'.$Rest->slug)}}" id="filteranchor"><strong>All</strong><span class="fa fa-chevron-right right-arrow"></span></a></li>
                        @foreach($Cats as $Cat)                    
                        <li title="{{$Cat->name}}"><a href="{{url('Hotels/'.$Rest->slug.'/filters/'.$Cat->id)}}" id="filteranchor" ><strong>{{$Cat->name}}</strong><span class="fa fa-chevron-right right-arrow"></span></a></li>
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
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">ADD TO TROLLEY</h4>
        </div>
        <div class="modal-body">
        <center><strong><h1 id="bookId1"></h1></strong></center>
         <center><strong><h3 id="bookId2"></h3></strong></center>
          
                   <input type="text" name="bookId" id="bookId3" value=""/>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('scripts')

<script>        
    $("a#filteranchor").click(function(){
    $('#cartModal').modal('hide')
    });
</script>

@endsection