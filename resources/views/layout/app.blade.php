<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="utf-8">
<title>Food Trolley | @yield('title')</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
<meta name="description" content="Foodtrolley is an home delivery based website." />
<meta name="keywords" content="FoodTrolley Food HomeDeliveryBhubaneswar TastyFood HomeDeliver eat">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@yield('stylesheet')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
        
        <!-- Styles -->
        <style>
             .navbar {
        width: 100%;
        padding: 0px;
    
    }
    .mynavbar
    {
        background: #ff0000;
    }
    .mynavbar .navbar-brand
    {
        color: white;
    }
    .mynavbar .navbar-nav>li>a
    {
        color: white;
    }
    .mynavbar .navbar-nav>li:hover
    {
        background-color: #cc0000;
    }
    #logo
    {
        height: 200%;
        width:170px;
        margin-top: -10px;
        margin-bottom: -10px;
        margin-right: 5px;
    }
    .site_footer
    {
        background-color: #222;
        color:#fff;
        margin-top: 10px; 
        padding-left: 20px;
        padding-top: 5px;
        padding-bottom: 2px;  
        height: 100px;
    }
.bottom_footer li
{
    display: inline;
    margin-right: 15px;
    list-style-type: square;
}
.bottom_footer ul
{
    
    list-style-type: square;
}
.footer_color
{
    background: black;
    padding-top: 15px;
    color: #fff;
}
        </style>
    </head>
    <body>
    <div class="container-field">
    <nav role="navigation" class="mynavbar navbar navbar-default">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header ">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="/" class="navbar-brand"><img id="logo" src="{{url('/images/logo.png')}}"></a>
        </div>
        <!-- Collection of nav links, forms, and other content for toggling -->
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav ">
                <li><a href="{{route('Location.get')}}">Order <span style="margin-left:5px;" class="fa fa-cutlery"></span></a></li>
                <li><a href="{{url('Hotels')}}">See All Restaurants<span style="margin-left:5px;" class=""></span></a></li>
                @if(Session::has('location_id'))
                <li><a href="{{url('/')}}">change location<span style="margin-left:5px;" class=""></span></a></li>
                @endif
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">Services<span style="margin-left:5px;" class="fa fa-level-down"></span> <b class="caret"></b></a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="{{url('table')}}">table booking</a></li>
                        <li><a href="#">Hall booking</a></li>
                        <li><a href="#">Party order</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Monthly Order</a></li>
                    </ul>
                </li>
                

            </ul>
            
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{route('cart.get')}}">Your Trolley <span style="margin-left:5px;" class="fa fa-shopping-cart"></span></a></li>
            </ul>
        </div>
    </nav>
</div>
            
            <div class="content">
                <div class="title m-b-md">
                   @section('body')
                   @show
                </div>

                
            </div>
            <footer>
    <div class="footer-bottom footer_color">
        <div class="container">
            <p class="pull-left"> Copyright ©pape 2017. All right reserved. </p>
            <div class="pull-right">
                <ul class="nav-pills">
                    <li style="margin-right: 35px;"><a style="color:white" href="{{route('aboutus')}}">about us</a></li>
                    <li style="margin-right: 35px;"><a style="color:white" href="{{route('terms')}}">terms and conditions</a></li>
                    <li style="margin-right: 35px;"><a style="color:white" href="{{route('privacypolicies')}}">privacy policies</a></li>
                    <li style="margin-right: 35px;"><a style="color:white" href="{{route('faqs')}}">FAQ's</a></li>
                    <li style="margin-right: 35px;"><a style="color:white" href="{{url('about#contact')}}">contact us</a></li>
                </ul> 
            </div>
        </div>
    </div>
    <!--/.footer-bottom--> 
</footer>
    </body>
    @yield('scripts')
</html>

    