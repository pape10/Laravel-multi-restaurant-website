@extends('layouts_auth.app')

@section('stylesheet')
    
@endsection
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 well">
				 <h2><center>ALL ORDERS</center></h2>
				 @foreach($Orders as $Order)
				 <div class="panel panel-primary">
    				<div class="panel-heading">Restaurant name:	{{$Order->rest_name}}</div>
    				<div class="panel-body">
    					<p>delivery date:{{$Order->delivery_date}}</p>
    					<p>delivery time:{{$Order->delivery_time}}</p>
    					<p>Order:{{$Order->order_det}}</p>
    				</div>
    				<div class="panel-footer">
    					<p>total: {{$Order->total}}</p>
    					<p>discount: {{$Order->discount}}</p>
    					<p>price to be collected: {{$Order->after_discount}}</p>
    				</div>
  				</div>
  				@endforeach
			</div>
		</div>
		<div class="text-center">
           {!!$Orders->links()!!}
       </div>
	</div>
@endsection