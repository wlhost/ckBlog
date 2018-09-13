@extends('home.layouts.home')

@section('title', $config['sitename'] . ' ' . $config['connection'] . ' ' . $config['sitename2'])
@section('description', $config['description'])
@section('keywords', $config['keywords'])

@section('main')
    <div class="eskimo-page-title">
        <h1 class="no-border">全部博文</h1>
    </div>
    <!-- BLOG POSTS -->
    <!-- POST 1 -->
    @foreach($article as $v)
        <div class="card card-horizontal">
            <div class="card-body">
                <div class="card-horizontal-left">
                    <div class="card-category">
                        @foreach($category as $vs)
                            @if($vs['id'] = $v['category_id'])
                                <a href="/category/{{ $vs['alias'] }}">
                                    {{ $vs['name'] }}
                                </a>
                            @endif
                        @endforeach
                    </div>
                    <h3 class="card-title"><a href="/article/{{ $v['id'] }}">{{ $v['title'] }}</a></h3>
                    <div class="card-excerpt">
                        <p>{{ $v['description'] }}</p>
                    </div>
                    <div class="card-horizontal-meta">
                        <div class="eskimo-author-meta">
                            By <a class="author-meta" >{{ $v['author'] }}</a>
                        </div>
                        <div class="eskimo-date-meta">
                            <a href="/article/{{ $v['id'] }}">{{ $v['created_at'] }}</a>
                        </div>
                        <div class="eskimo-reading-meta">{{ $v['click'] }} read</div>
                    </div>
                </div>
                @if($v['cover'] != '')
                    <div class="card-horizontal-right" data-img="{{ $v['cover'] }}">
                        <a class="card-featured-img" href="/article/{{ $v['id'] }}"></a>
                    </div>
                @endif
            </div>
        </div>
    @endforeach

    {{ $article->links() }}
    <div class="clearfix"></div>
@endsection