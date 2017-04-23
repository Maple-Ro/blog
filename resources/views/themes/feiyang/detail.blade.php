@extends('themes.feiyang.common')
@inject('article', 'App\Presenters\ArticlePresenter')
@section('title')
    MapleImage
@endsection
@section('content')
    <div id="content" class="inner">
        <!--文章列表-->
        {!! $article->detail($data) !!}
    </div>
@endsection