<!doctype html>
<html class="no-js" lang="en-US">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="description" content="Default Description">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('user/img/icon/favicon.png') }}">
    <!-- google font rubik -->
    <link href="{{asset('user/fonts/css52cf.css?family=Rubik:400,500,600')}}" rel="stylesheet">
    <!-- mobile menu css -->
    <link rel="stylesheet" href="{{asset('user/css/meanmenu.min.css')}}">
    <!-- animate css -->
    <link rel="stylesheet" href="{{asset('user/css/animate.css')}}">
    <!-- nivo slider css -->
    <link rel="stylesheet" href="{{asset('user/css/nivo-slider.css')}}">
    <!-- owl carousel css -->
    <link rel="stylesheet" href="{{asset('user/css/owl.carousel.min.css')}}">
    <!-- slick css -->
    <link rel="stylesheet" href="{{asset('user/css/slick.css')}}">
    <!-- price slider css -->
    <link rel="stylesheet" href="{{asset('user/css/jquery-ui.min.css')}}">
    <!-- fontawesome css -->
    <link rel="stylesheet" href="{{asset('user/css/font-awesome.min.css')}}">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{asset('user/css/bootstrap.min.css')}}">
    <!-- default css  -->
    <link rel="stylesheet" href="{{asset('user/css/default.css')}}">
    <!-- style css -->
    <link rel="stylesheet" href="{{asset('user/style.css')}}">
    <!-- home-2 css -->
    <link rel="stylesheet" href="{{asset('user/css/home-2.css')}}">
    <!-- responsive css -->
    <link rel="stylesheet" href="{{asset('user/css/responsive.css')}}">

    <!-- modernizr js -->
    <script src="{{ asset('user/js/vendor/modernizr-2.8.3.min.js')}}"></script>
</head>

<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->
<!-- Wrapper Start -->
<div class="wrapper">
    <!-- Header Area Start -->
    <header>
        <!-- Header Top Start -->
    @include('User.Includes.top_header')
    <!-- Header Top End -->
        <!-- Header Middle Start -->
    @include('User.Includes.header_middle')
    <!-- Header Middle End -->
        <!-- Header Bottom Start -->
    @include('User.Includes.bottom_header')
    <!-- Header Bottom End -->
    </header>
    <!-- Header Area End -->
    <!-- Slider Area Start -->
@yield('contents')
    <!-- Random Product End -->
@include('User.Includes.footer')
<!-- Footer End -->
</div>
<!-- Wrapper End -->
<!-- jquery 3.12.4 -->
<script src="{{ asset('user/js/vendor/jquery-1.12.4.min.js')}}"></script>
<!-- mobile menu js  -->
<script src="{{ asset('user/js/jquery.meanmenu.min.js')}}"></script>
<!-- scroll-up js -->
<script src="{{ asset('user/js/jquery.scrollUp.js')}}"></script>
<!-- owl-carousel js -->
<script src="{{ asset('user/js/owl.carousel.min.js')}}"></script>
<!-- slick js -->
<script src="{{ asset('user/js/slick.min.js')}}"></script>
<!-- countdown js -->
<script src="{{ asset('user/js/jquery.countdown.min.js')}}"></script>
<!-- wow js -->
<script src="{{ asset('user/js/wow.min.js')}}"></script>
<!-- price slider js -->
<script src="{{ asset('user/js/jquery-ui.min.js')}}"></script>
<!-- nivo slider js -->
<script src="{{ asset('user/js/jquery.nivo.slider.js')}}"></script>
<!-- bootstrap -->
<script src="{{ asset('user/js/bootstrap.min.js')}}"></script>
<!-- plugins -->
<script src="{{ asset('user/js/plugins.js')}}"></script>
<!-- main js -->
<script src="{{ asset('user/js/main.js')}}"></script>
</body>
</html>