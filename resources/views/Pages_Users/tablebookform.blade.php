@extends('layout.app')
@section('title','Table Book')

@section('stylesheet')
    <link href="{{ asset('css/show-menu.css') }}" rel="stylesheet">
@endsection
@section('body')
    <div class="container">
  <h2><center>{{$Table->rest->restaurant_name}}</center></h2>
  {!!Form::open(array('route'=>['table.confirm',$Table->id],'data-parsley-validate'=>''))!!}
            {{Form::label('name','Name:')}}
            {{Form::text('name',null,array('class' => 'form-control','required'=>'','minlength'=>'2','maxlength'=>'255'))}}
            <br>
            {{Form::label('email','email address:')}}
            {!! Form::email('email', null, [
            'class'                         => 'form-control',
            'placeholder'                   => 'Email address',
            'required',
            'id'                            => 'inputEmail',
            'data-parsley-required-message' => 'Email is required',
            'data-parsley-trigger'          => 'change focusout',
            'data-parsley-type'             => 'email'
            ]) !!}
            <br>
            @if (Session::has('msg'))
            <center><p>{{Session::get('msg')}}</p></center>
            @endif  
            {{Form::label('delivery_time','delivery time')}}
            <select class="form-control" name="delivery_time">
                @foreach($sending_data as $x => $x_value)
                    <option value="{{$x}}">{{$x_value}}</option>
                @endforeach
            </select>
            <br>
             {{Form::label('phone','Phone:')}}
            {{Form::text('phone',null,array('class' => 'form-control','required'=>''))}}
            
            {{Form::submit('BOOK',array('class' => 'btn btn-success btn-lg btn-block','style'=>'margin-top:5px;'))}}
            {!!Form::close()!!}
            <br>
</div>

@endsection
@section('scripts')
    {!!Html::script('js/parsley.min.js')!!}
@endsection