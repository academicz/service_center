<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404</title>


    <!--STYLESHEET-->
    <!--=================================================-->

    <!--Open Sans Font [ OPTIONAL ]-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>


    <!--Bootstrap Stylesheet [ REQUIRED ]-->
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet">


    <!--Nifty Stylesheet [ REQUIRED ]-->
    <link href="{{ asset('admin/css/nifty.min.css') }}" rel="stylesheet">


    <!--Nifty Premium Icon [ DEMONSTRATION ]-->
    <link href="{{ asset('admin/css/demo/nifty-demo-icons.min.css') }}" rel="stylesheet">


    <!--Demo [ DEMONSTRATION ]-->
    <link href="{{ asset('admin/css/demo/nifty-demo.min.css') }}" rel="stylesheet">


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

    <!--Background Image [ DEMONSTRATION ]-->
    <script src="{{ asset('admin/js/demo/bg-images.js') }}"></script>


    <!--=================================================

    REQUIRED
    You must include this in your project.


    RECOMMENDED
    This category must be included but you may modify which plugins or components which should be included in your project.


    OPTIONAL
    Optional plugins. You may choose whether to include it in your project or not.


    DEMONSTRATION
    This is to be removed, used for demonstration purposes only. This category must not be included in your project.


    SAMPLE
    Some script samples which explain how to initialize plugins or components. This category should not be included in your project.


    Detailed information and more samples can be found in the document.

    =================================================-->


</head>

<!--TIPS-->
<!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->

<body>
<div id="container" class="cls-container">

    <!-- HEADER -->
    <!--===================================================-->
    <div class="cls-header">
        <div class="cls-brand">
            <a class="box-inline" href="{{ route('adminHome') }}">
                <span class="brand-title">E2CARE</span>
            </a>
        </div>
    </div>

    <!-- CONTENT -->
    <!--===================================================-->
    <div class="cls-content">
        <h1 class="error-code text-info">404</h1>
        <p class="text-main text-semibold text-lg text-uppercase">Page Not Found!</p>
        <div class="pad-btm text-muted">
            Sorry, but the page you are looking for has not been found on our server.
        </div>
        <hr class="new-section-sm bord-no">
        <div class="pad-top"><a class="btn-link" href="{{ route('home') }}">Back to Homepage</a></div>
    </div>


</div>
<!--===================================================-->
<!-- END OF CONTAINER -->


</body>

</html>

