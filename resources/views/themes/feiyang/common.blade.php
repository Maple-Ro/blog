<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="author" content="hfcorriez">
    @yield('description')
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="{{homeAssets('/images/favicon.ico')}}" rel="shortcut icon">
    <link href="{{homeAssets('/css/screen.css')}}" media="screen, projection" rel="stylesheet" type="text/css">
    <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
</head>
<body>
<!--common title:-->
@include('themes.feiyang.nav')
<!--内容区域-->
@yield('content')
<footer id="footer" class="inner">Copyright &copy; 2014 MapleImage - 枫叶映像</footer>
</body>
</html>