@extends('home.layouts.home')

@section('title', $config['sitename'] . ' ' . $config['connection'] . ' ' . $config['sitename2'])
@section('description', $config['description'])
@section('keywords', $config['keywords'])


@section('main')
    @foreach($top as $v)
        <div class="card card-horizontal">
            <div class="card-body">
                <div class="card-horizontal-left">
                    <div class="card-category">
                        @foreach($category as $vs)
                            @if($vs['id'] == $v['category_id'])
                                {{ $vs['name'] }}
                            @endif
                        @endforeach
                    </div>
                    <h3 class="card-title"><a href="/article/{{ $v['id'] }}">{{ $v['title'] }}</a> <span class="badge badge-danger"><a href="#">置顶</a></span></h3>
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

    @foreach($article as $v)
        <div class="card card-horizontal">
            <div class="card-body">
                <div class="card-horizontal-left">
                    <div class="card-category">
                        @foreach($category as $vs)
                            @if($vs['id'] == $v['category_id'])
                                {{ $vs['name'] }}
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

    <!-- 正文结束   -->

    <!-- VIEW ALL BUTTON -->
    <div class="eskimo-view-more">
        <a class="btn btn-default" href="{{ URL('/all') }}">查看所有文章</a>
    </div>

    <!-- DIVIDER -->
    <hr class="section-divider" />

    <!-- CAROUSEL -->
    <div class="eskimo-widget-title">
        <h3 class="eskimo-carousel-title"><span>点击率最高</span></h3>
    </div>

    <div class="eskimo-carousel-container">
        <div class="eskimo-carousel-view-more">
            <a href="blog.html">VIEW ALL</a>
        </div>

        <div id="eskimo-post-carousel" class="eskimo-carousel">
            <!-- CAROUSEL ITEM 1 -->
            @foreach($hot as $v)
                <div>
                    <div class="card-masonry card-small">
                        <div class="card">
                            <a href="/article/{{ $v['id'] }}">
                                <img class="card-vertical-img" src="{{ $v['cover'] or URL::asset('home/images/blog.jpg') }}" alt="{{ $v['keywords'] }}" />
                            </a>
                            <div class="card-border">
                                <div class="card-body">
                                    <div class="card-category">
                                        <a href="/article/{{ $v['id'] }}">{{ $v['created_at'] }}</a>
                                    </div>
                                    <h5 class="card-title"><a href="/article/{{ $v['id'] }}">{{ $v['title'] }}</a></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

@endsection