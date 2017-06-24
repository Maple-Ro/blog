@extends('themes.feiyang.common')
@section('title')
    MapleImage - {{$data->title}}
@endsection
@section('js')
    <script src="http://oq1gjw90c.bkt.clouddn.com/content.js" type="text/javascript" defer></script>
@endsection
@section('content')
    <div id="content" class="inner">
        <article class="post">
            <h2 class="title">
                <a href="/detail/{{$data->_id}}">{{$data->title}}</a>
            </h2>
            <div class="entry-content"><div id="article_content" data-content="{!! htmlspecialchars($data->content) !!}"></div></div>
            <!--左侧日期评论数目统计区域-->
            <div class="meta">
                <div class="date">
                    <span>{{$data->updated_at}}</span>
                </div>
                <div class="tags">
                    @if(!empty($data->tags))
                        @foreach($data->tags as $i)
                            <a href="javascript:;">#{{$i}}</a>
                        @endforeach
                    @endif
                </div>
                <div class="comments"><a href="javascript:;">Comments</a>
                </div>
            </div>
        </article>
    </div>
@endsection