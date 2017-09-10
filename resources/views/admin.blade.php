@extends('layouts_auth_admin.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Admin Dashboard</div>
                <div class="panel-body">
                    You are logged in as restaurant owner!
                </div>
            </div>
        </div>
    </div>
    <div class="row">
    <a href="{{route('admin.orders')}}" class="btn btn-primary btn-block">See All orders</a>
        </div>
</div>
@endsection
