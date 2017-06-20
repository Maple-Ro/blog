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
    <style>
        #sub-nav .social a:hover {
            opacity: 1
        }

        #sub-nav .social a.facebook {
            background: url({{homeAssets('/images/social/facebook.png')}}) center no-repeat #3b5998;
            border: 1px solid #3B5998
        }

        #sub-nav .social a.facebook:hover {
            border: 1px solid #2d4373
        }

        #sub-nav .social a.google {
            background: url({{homeAssets('/images/weibo.png')}}) center no-repeat #c83d20;
            border: 1px solid #C83D20
        }

        #sub-nav .social a.google:hover {
            border: 1px solid #9c3019
        }

        #sub-nav .social a.twitter {
            background: url({{homeAssets('/images/twitter.png')}}) center no-repeat #55cff8;
            border: 1px solid #55CFF8
        }

        #sub-nav .social a.twitter:hover {
            border: 1px solid #24c1f6
        }

        #sub-nav .social a.github {
            background: url({{homeAssets('/images/github.png')}}) center no-repeat #afb6ca;
            border: 1px solid #afb6ca
        }

        #sub-nav .social a.github:hover {
            border: 1px solid #909ab6
        }

        #sub-nav .social a.coderwall {
            background: url({{homeAssets('/images/coderwall.png')}}) center no-repeat #3a729f;
            border: 1px solid #3a729f
        }

        #sub-nav .social a.coderwall:hover {
            border: 1px solid #2c577a
        }

        #sub-nav .social a.pinboard {
            background: url({{homeAssets('/images/pinboard.png')}}) center no-repeat #0066c8;
            border: 1px solid #3a729f
        }

        #sub-nav .social a.pinboard:hover {
            border: 1px solid #0052cc
        }

        #sub-nav .social a.linkedin {
            background: url({{homeAssets('/images/linkedin.png')}}) center no-repeat #005a87;
            border: 1px solid #005A87
        }

        #sub-nav .social a.linkedin:hover {
            border: 1px solid #003854
        }

        #sub-nav .social a.pinterest {
            background: url({{homeAssets('/images/pinterest.png')}}) center no-repeat #be4037;
            border: 1px solid #be4037
        }

        #sub-nav .social a.pinterest:hover {
            border: 1px solid #96332c
        }

        #sub-nav .social a.delicious {
            background: url({{homeAssets('/images/delicious.png')}}) center no-repeat #3271cb;
            border: 1px solid #3271cb
        }

        #sub-nav .social a.delicious:hover {
            border: 1px solid #285aa2
        }

        #sub-nav .social a.rss {
            background: url({{homeAssets('/images/rss.png')}}) center no-repeat #ef7522;
            border: 1px solid #EF7522
        }

        #sub-nav .social a.rss:hover {
            border: 1px solid #cf5d0f
        }

        @font-face {
            font-family: 'FontAwesome';
            src: url({{homeAssets('/font/fontawesome-webfont.eot')}});
            src: url({{homeAssets('/font/fontawesome-webfont.eot?#iefix')}}) format("embedded-opentype"), url({{homeAssets('/font/fontawesome-webfont.woff')}}) format("woff"), url({{homeAssets('/font/fontawesome-webfont.ttf')}}) format("truetype"), url({{homeAssets('/font/fontawesome-webfont.svgz#FontAwesomeRegular')}}) format("svg"), url({{homeAssets('/font/fontawesome-webfont.svg#FontAwesomeRegular')}}) format("svg");
            font-weight: normal;
            font-style: normal
        }
    </style>
    <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <script src="{{homeAssets('/js/favico.js')}}" type="text/javascript"></script>
    <script>
        window.onload = function () {
            var favicon = new Favico({
                animation: 'slide'
            });
            favicon.badge(3);
        }
    </script>
    @yield('js')
</head>
<body>
<!--common title:-->
@include('themes.feiyang.nav')
<!--内容区域-->
@yield('content')
<footer id="footer" class="inner">Copyright &copy; 2016 - {{\Carbon\Carbon::now()->format('Y')}}&nbsp;&nbsp;&nbsp;&nbsp;MapleImage&nbsp;&nbsp;枫叶映像</footer>
</body>
</html>