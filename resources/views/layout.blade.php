<!DOCTYPE html>
<html lang="en" >
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8" >
    <meta http-equiv="X-UA-Compatible" content="IE=edge" >
    <meta name="viewport" content="width=device-width, initial-scale=1" >
    <link rel="icon" href="{{asset('favicon.png')}}" type="image/ico" />

    <title>Hunting Federation</title>

    <!-- Bootstrap -->
    <link href="{{asset('vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet" >
    <!-- Font Awesome -->
    <link href="{{asset('vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" >
    <!-- NProgress -->
    <link href="{{asset('vendors/nprogress/nprogress.css')}}" rel="stylesheet" >
    <!-- iCheck -->
    <link href="{{asset('vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet" >

    <!-- bootstrap-progressbar -->
    <link
            href="{{asset('vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}"
            rel="stylesheet"
    >
    <!-- bootstrap-daterangepicker -->
    <link
            href="{{asset('vendors/bootstrap-daterangepicker/daterangepicker.css')}}"
            rel="stylesheet"
    >

    <!-- Custom Theme Style -->
    <link href="{{asset('build/css/custom.min.css')}}" rel="stylesheet" >
</head>
<body class="nav-md">
<div class="container body">
    <div class="main_container">
        @include('includes.navigation')

        @include('includes.topNavigation')
        <div class="right_col" role="main">
            @yield('content')
        </div>
    </div>
</div>
<!-- jQuery -->
<script src="{{asset('vendors/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('vendors/fastclick/lib/fastclick.js')}}"></script>
<!-- NProgress -->
<script src="{{asset('vendors/nprogress/nprogress.js')}}"></script>
<!-- bootstrap-wysiwyg -->
<script src="{{asset('vendors/jquery.hotkeys/jquery.hotkeys.js')}}"></script>
<script src="{{asset('vendors/google-code-prettify/src/prettify.js')}}"></script>

<!-- Custom Theme Scripts -->
<script src="{{asset('build/js/custom.js')}}"></script>
</body>
