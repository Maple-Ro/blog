<!doctype html>
<html class="theme-next mist use-motion" lang="zh-Hans">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <meta http-equiv="Cache-Control" content="no-transform"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    @yield('header')
    <link rel="shortcut icon" href="{{homeAssets('/images/ico/favicon.ico')}}" sizes="32x32" type="image/png"/>
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{homeAssets('/images/ico/favicon.ico')}}"
          type="image/png"/>
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="{{homeAssets('/images/ico/favicon.ico')}}"
          type="image/png"/>
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{homeAssets('/images/ico/favicon.ico')}}"
          type="image/png"/>
    <link href="//cdn.jsdelivr.net/fancybox/2.1.5/jquery.fancybox.min.css" rel="stylesheet" type="text/css"/>
    <link href="//fonts.googleapis.com/css?family=Neucha:300,300italic,400,400italic,700,700italic&subset=latin,latin-ext"
          rel="stylesheet" type="text/css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{homeAssets('/css/main.css')}}" rel="stylesheet" type="text/css"/>
</head>
<body itemscope itemtype="http://schema.org/WebPage" lang="zh-Hans">
<script type="text/javascript">
    var _hmt = _hmt || [];
    (function () {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?340874ba9357cbe81570aa4ac1185941";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();
</script>
<div class="container one-collumn sidebar-position-right page-home">
    <div class="headband"></div>
    <header id="header" class="header" itemscope itemtype="http://schema.org/WPHeader">
        <div class="header-inner">
            <div class="site-meta custom-logo">
                <div class="custom-logo-site-title">
                    <a href="/" class="brand" rel="start">
                        <span class="logo-line-before"><i></i></span>
                        <span class="site-title">liutsing - {{config('app.name')}}</span>
                        <span class="logo-line-after"><i></i></span>
                    </a>
                </div>
                <h1 class="site-subtitle" itemprop="description"></h1>
            </div>
            <div class="site-nav-toggle">
                <button>
                    <span class="btn-bar"></span>
                    <span class="btn-bar"></span>
                    <span class="btn-bar"></span>
                </button>
            </div>
            @include('themes.default.common.nav')
        </div>
    </header>

    <main id="main" class="main">
        <div class="main-inner">
            <div class="content-wrap">
                <div id="content" class="content">
                    <section id="posts" class="posts-expand">
                        @yield('article')
                    </section>
                    <!--<nav class="pagination">
                        <span class="page-number current">1</span><a class="page-number" href="/page/2/">2</a><span
                                class="space">&hellip;</span><a class="page-number" href="/page/8/">8</a><a
                                class="extend next" rel="next" href="/page/2/"><i class="fa fa-angle-right"></i></a>
                    </nav>-->
                </div>
            </div>
            <div class="sidebar-toggle">
                <div class="sidebar-toggle-line-wrap">
                    <span class="sidebar-toggle-line sidebar-toggle-line-first"></span>
                    <span class="sidebar-toggle-line sidebar-toggle-line-middle"></span>
                    <span class="sidebar-toggle-line sidebar-toggle-line-last"></span>
                </div>
            </div>
            <!--侧边栏-->
            @include('themes.default.common.aside')
        </div>
    </main>
    <footer id="footer" class="footer">
        <div class="footer-inner">
            <div class="copyright">&copy; 2014 -
                <span itemprop="copyrightYear">2017</span>
                <span class="with-love"><i class="fa fa-heart"></i></span>
                <span class="author" itemprop="copyrightHolder">Liutsing</span>
            </div>
        </div>
    </footer>
    <div class="back-to-top">
        <i class="fa fa-arrow-up"></i>
    </div>
</div>
<script type="text/javascript">
    if (Object.prototype.toString.call(window.Promise) !== '[object Function]') {
        window.Promise = null;
    }
</script>
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/fastclick/1.0.6/fastclick.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery.lazyload/1.9.3/jquery.lazyload.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/velocity/1.2.3/velocity.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/velocity/1.2.3/velocity.ui.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/fancybox/2.1.5/jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="{{homeAssets('/js/bootstrap.min.js')}}"></script>
<script type="text/javascript">
    // Popup Window;
    var isfetched = false;
    // Search DB path;
    var search_path = "search.xml";
    if (search_path.length == 0) {
        search_path = "search.xml";
    }
    var path = "/" + search_path;
    // monitor main search box;

    function proceedsearch() {
        $("body").append('<div class="popoverlay">').css('overflow', 'hidden');
        $('.popup').toggle();
    }
    // handle and trigger popup window;
    $('.popup-trigger').click(function (e) {
        e.stopPropagation();
        if (isfetched == false) {
            searchFunc(path, 'local-search-input', 'local-search-result');
        } else {
            proceedsearch();
        }
        ;
    });

    $('.popup-btn-close').click(function (e) {
        $('.popup').hide();
        $(".popoverlay").remove();
        $('body').css('overflow', '');
    });
    $('.popup').click(function (e) {
        e.stopPropagation();
    });
</script>
</body>
<!--http://www.ezlippi.com/-->
</html>
