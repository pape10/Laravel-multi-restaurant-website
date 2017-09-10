@extends('layout.app')
@section('title','Cart')

@section('stylesheet')
    <link href="{{ asset('css/show-menu.css') }}" rel="stylesheet">
@endsection
@section('body')
		@if (Session::has('error_getcart'))
<div class="alert alert-danger" role="alert">
            <center><strong>{{Session::get('error_getcart')}}</strong></center>
        </div>
    @endif
    	@if(Session::get('true')==1)
		<div class="container">
    <h1><strong><center>{{$Service->rest->restaurant_name}}</center></strong></h1>
		<center><p style="color:red">**A DELIVERY CHARGE OF Rs {{$Service->del_charge}} WOULD BE ADDED TO THE TOTAL**</p></center>
  <table id="cart" class="table table-hover table-condensed">
            <thead>
            <tr>
              <th style="width:50%">Product</th>
              <th style="width:10%">Price</th>
              <th style="width:8%">Quantity</th>
              <th style="width:22%" class="text-center">Subtotal</th>
              <th style="width:10%"></th>
            </tr>
          </thead>
          <tbody>
          @foreach($cart as $c)
          
            <tr>
              <td data-th="Product">
                <div class="row">
                 
                  <div class="col-sm-10">
                    <h4 class="nomargin">{{$c->name}}</h4>
                                      </div>
                </div>
              </td>
              <td data-th="Price">{{$c->price}}</td>
              <td data-th="Quantity">
                <div class="row">
                 
                  <div class="col-sm-10">
                    <center><h4 class="nomargin">{{$c->qty}}</h4></center>
                                      </div>
              </td>
              <td data-th="Subtotal" class="text-center">{{$c->qty*$c->price}}</td>
              <td class="actions" data-th="">
                <a href="{{url('remove/'.$c->rowId)}}"><button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button></a>                
              </td>
            </tr>
            @endforeach
          <hr>
          </tbody>
          <tr>
              <td></td>
              <td colspan="2" class="hidden-xs"></td>
              <td class="text-center"><strong>SubTotal Rs{{ Cart::instance('default')->subtotal() }}<strong></td>
              <td></td>
            
              </tr>
              <tr>
              <td></td>
              <td colspan="2" class="hidden-xs"></td>
              <td class="text-center"><strong>Delivery charge Rs{{$del_charge}}<strong></td>
              <td></td>
            
              </tr>

              <tr>
              <td></td>
              <td colspan="2" class="hidden-xs"></td>
              <td class="text-center"><strong>Total Rs{{$total_after_del}}<strong></td>
              <td></td>
            
              </tr>

              <tr>
              <td></td>
              <td colspan="2" class="hidden-xs"></td>
              <td class="text-center"><strong>Disc Rs{{$Disc}}<strong></td>
              <td></td>
            
              </tr>

          
          <tfoot>
            <tr class="visible-xs">
              <td class="text-center"><strong></strong></td>
            </tr>
            <tr>
              <td><a href="{{route('continue.shopping')}}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
              <td colspan="2" class="hidden-xs"></td>
              <td class="text-center"><strong>To Be paid Rs{{$total}}</strong></td>
              <td><a href="{{route('removeall')}}" class="btn btn-danger btn-block">Clear Cart <i class="fa fa-trash-o"></i></a></td>
            
              </tr>
          </tfoot>

        </table>

      @if (Session::has('error_coupon'))
<p style="color: red">
            <center><strong>**{{Session::get('error_coupon')}}**</strong></center>
        </p>
    @endif
        <div class="col-md-7 col-md-offset-3">
        <div class="col-md-5 col-md-offset-3">
        {!!Form::open(array('route'=>'coupon.set','data-parsley-validate'=>'','class'=>'input-group'))!!}
        {{Form::text('name',null,array('class' => 'form-control','required'=>'','minlength'=>'2','maxlength'=>'255'))}}
      <span class="input-group-btn">
    
     {{Form::submit('APPLY',array('class' => 'btn btn-success','style'=>''))}}
    
      </span>
      {!!Form::close()!!}
        <br>

        <center><td><a href="{{route('checkout')}}" class="btn btn-warning">Checkout <i class="fa fa-angle-right"></i></a></td></center>
        </div>
        
    </div>
            
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
@endif
@endsection

@section('scripts')
    {!!Html::script('js/parsley.min.js')!!}
@endsection