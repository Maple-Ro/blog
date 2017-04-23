@extends('themes.feiyang.common')
@inject('article', 'App\Presenters\ArticlePresenter')
@section('title')
    MapleImage - 枫叶映像
@endsection
@section('content')
    <div id="content" class="inner">
        <!--文章列表-->
        @if(empty($data))
            <p>还未发表文章</p>
        @else
            {!! $article->list($data) !!}
            {!! $links !!}
        @endif
    </div>
@endsection