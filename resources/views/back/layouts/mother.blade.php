<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <!-- Bootstrap -->
    <link href="{{backAssets('/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{backAssets('/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{backAssets('/css/nprogress.css')}}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{backAssets('/css/animate.min.css')}}" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="{{backAssets('/css/custom.min.css')}}" rel="stylesheet">
    <!-- jQuery -->
    <script src="{{backAssets('/js/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{backAssets('/js/bootstrap.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{backAssets('/js/fastclick.js')}}"></script>
    <!-- NProgress -->
    <script src="{{backAssets('/js/nprogress.js')}}"></script>
    <!-- Custom Theme Scripts -->
    <script src="{{backAssets('/js/custom.min.js')}}"></script>
    @yield('style')
</head>

@yield('content')
@yield('js')
</html>
