@extends('themes.feiyang.common')
@section('title')
    枫叶映像
@endsection
@section('content')
    <div id="content" class="inner">
        <!--文章列表-->
        <article class="post">
            <h2 class="title">
                <a href="/2014/05/handle-php-error-better-introduce-errors">
                    我的网站测试中。。。</a>
            </h2>
            <div class="entry-content">
                <p>本来这篇博文准备早点发布，没想到拖延症还是没有改善，但对于责任心很强的人类来说，这始终是个压力。写这个的时候还在灰机上，我想下飞机就可以释放一下了。</p>
                <p>废话不多说，进入正题。本篇文章主要是为了向你介绍 PHP 都有哪些错误和处理方法：</p>
                <h2>错误类型</h2>
                <p>PHP 主要有两种错误：触发错误和异常。其中触发错误大概可以分为：编译错误、引擎错误和运行时错误，其中前两个是无法捕获的；异常都是可以捕获的，当没有尝试捕获时则会中断代码。</p>
                <p>触发错误可以通过 <code>error_get_last()</code> 来进行获得，异常可以使用标准的 <code>try...catch</code> 语句来捕获。</p>
                <a href="#" class="more-link">Read on &rarr;</a>
            </div>
            <div class="meta">
                <div class="date">
                    <time datetime="2014-05-09T21:05:00+08:00" pubdate data-updated="true">May 9<span>th</span>, 2014
                    </time>
                </div>
                <div class="tags">
                </div>
                <div class="comments"><a href="#">Comments</a>
                </div>
            </div>
        </article>
        <nav id="pagenavi">
            <a href="#" class="next">Next</a>
            <div class="center"><a href="#">Blog Archives</a></div>
        </nav>
    </div>
@endsection