<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{--CSRF Token--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

<!--STYLESHEET-->
    <!--=================================================-->

    <!--Open Sans Font [ OPTIONAL ]-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>

    <script defer src="https://use.fontawesome.com/releases/v4.7.0/js/all.js"></script>
    <script src="https://use.fontawesome.com/015f09638c.js"></script>
    <script src="{{asset('vue.js')}}"></script>
    <script src="{{asset('axios.min.js')}}"></script>

    <!--Bootstrap Stylesheet [ REQUIRED ]-->
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">

    <!--Nifty Stylesheet [ REQUIRED ]-->
    <link href="{{ asset('admin/css/nifty.min.css') }}" rel="stylesheet">


    <!--Nifty Premium Icon [ DEMONSTRATION ]-->
    <link href="{{ asset('admin/css/demo/nifty-demo-icons.min.css') }}" rel="stylesheet">


    <!--Demo [ DEMONSTRATION ]-->
    <link href="{{ asset('admin/css/demo/nifty-demo.min.css') }}" rel="stylesheet">

    <link href="{{ asset('admin/css/custom.css') }}" rel="stylesheet">

    <!--Morris.js [ OPTIONAL ]-->
    <link href="{{ asset('plugins/morris-js/morris.min.css') }}" rel="stylesheet">


    <!--Magic Checkbox [ OPTIONAL ]-->
    <link href="{{ asset('plugins/magic-check/css/magic-check.min.css') }}" rel="stylesheet">


    <!--JAVASCRIPT-->
    <!--=================================================-->

    <!--Pace - Page Load Progress Par [OPTIONAL]-->
    <link href="{{ asset('plugins/pace/pace.min.css') }}" rel="stylesheet">
    <script src="{{ asset('plugins/pace/pace.min.js') }}"></script>


    <!--jQuery [ REQUIRED ]-->
    <script src="{{ asset('admin/js/jquery.min.js') }}"></script>


    <!--BootstrapJS [ RECOMMENDED ]-->
    <script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>


    <!--NiftyJS [ RECOMMENDED ]-->
    <script src="{{ asset('admin/js/nifty.min.js') }}"></script>


    <!--=================================================-->

    <!--Demo script [ DEMONSTRATION ]-->
    <script src="{{ asset('admin/js/demo/nifty-demo.min.js') }}"></script>

    <!--Morris.js [ OPTIONAL ]-->
    <script src="{{ asset('plugins/morris-js/morris.min.js') }}"></script>
    <script src="{{ asset('plugins/morris-js/raphael-js/raphael.min.js') }}"></script>


    <!--Sparkline [ OPTIONAL ]-->
    <script src="{{ asset('plugins/sparkline/jquery.sparkline.min.js') }}"></script>


    <!--Specify page [ SAMPLE ]-->
    <script src="{{ asset('admin/js/demo/dashboard.js') }}"></script>

    {{--Axios--}}
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    {{--Vue js--}}
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://use.fontawesome.com/015f09638c.js"></script>
    <script src="{{asset('admin/js/sweetalert.min.js')}}"></script>
    <script src="{{ asset('admin/js/custom.js') }}"></script>
    @yield('head')

</head>

<!--TIPS-->
<!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->
<body>
<div id="container" class="effect aside-float aside-bright mainnav-lg footer-fixed print-content">

    <!--NAVBAR-->
@include('Shop.Includes.header')
<!--END NAVBAR-->

    <div class="boxed">

        <!--CONTENT CONTAINER-->
        <div id="content-container">

            @yield('contents')

        </div>
        <!--END CONTENT CONTAINER-->


        <!--ASIDE-->
    @include('Shop.Includes.aside')
    <!--END ASIDE-->


        <!--MAIN NAVIGATION-->
    @include('Shop.Includes.nav')
    <!--END MAIN NAVIGATION-->

    </div>


    <!-- FOOTER -->
@include('Shop.Includes.footer')
<!-- END FOOTER -->


    <!-- SCROLL PAGE BUTTON -->
    <button class="scroll-top btn">
        <i class="pci-chevron chevron-up"></i>
    </button>

</div>
<!--===================================================-->
<!-- END OF CONTAINER -->


<!-- SETTINGS -->
@include('Shop.Includes.settings')
<!-- END SETTINGS -->

@yield('scripts')

<script>
    $("#notificationDropDown").on('click', function (e) {
        e.stopPropagation();
    });
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>


</body>


</html>
