@extends('themes.feiyang.common')
@inject('article', 'App\Presenters\ArticlePresenter')
@section('title')
    MapleImage - 枫叶映像
@endsection
@section('content')
    <div id="content" class="inner">
        <!--文章列表-->
        {!! $article->list($data) !!}
        <nav id="pagenavi">
            <a href="#" class="next">Next</a>
            <div class="center"><a href="#">Blog Archives</a></div>
        </nav>
    </div>
@endsection