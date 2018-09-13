@extends('home.layouts.home')

@section('title',  $cat['name']  . ' ' . $config['connection'] . ' ' . $config['sitename'])
@section('description', $cat['description'] or $config['description'])
@section('keywords', $cat['keywords'] or $config['keywords'])

@section('main')
    <!-- PAGE TITLE -->
    <div class="eskimo-page-title">
        <h1><span>{{ $cat['name'] }}</span></h1>
        <p class="eskimo-page-subtitle">{{ $cat['description'] }}</p>
    </div>
    <!-- BLOG POSTS -->
    <div class="eskimo-masonry-grid">
        <div class="eskimo-two-columns" data-columns>
            <!-- POST 1 -->
            @foreach($articles as $v)
                <div class="card-masonry">
                    <div class="card">
                        <a href="/article/{{ $v['id'] }}">
                            <img class="card-vertical-img" src="{{ $v['cover'] or URL::asset('home/images/blog.jpg') }}" alt="{{ $v['keywords'] }}" />
                        </a>
                        <div class="card-border">
                            <div class="card-body">
                                <div class="card-category">
                                    <span><a href="/category/{{ $v['category_id'] }}">{{ $cat['name'] }}</a></span>
                                </div>
                                <h3 class="card-title">
                                    <a href="/article/{{ $v['id'] }}">{{ $v['title'] }}</a>
                                </h3>
                                <p>{{ $v['description'] }}</p>
                            </div>
                            <div class="card-footer">
                                <div class="eskimo-author-meta">
                                    By <a class="author-meta" href="#">{{ $v['author'] }}</a>
                                </div>
                                <div class="eskimo-date-meta">
                                    <a href="single-post.html">{{ $v['created_at'] }}</a>
                                </div>
                                <div class="eskimo-reading-meta">{{ $v['click'] }} read</div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

        </div>
    </div>

    {{ $articles->links() }}
    <!-- PAGINATION -->

    <div class="clearfix"></div>

@endsection