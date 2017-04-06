@extends('themes.feiyang.common')
@inject('article', 'App\Presenters\ArticlePresenter')
@section('title')
    MapleImage
@endsection
@section('content')
    <div id="content" class="inner">
        <!--文章列表-->
        {!! $article->article($data,2) !!}
        <nav id="pagenavi">
            <a href="#" class="next">Next</a>
            <div class="center"><a href="#">Blog Archives</a></div>
        </nav>
    </div>
@endsection