@extends('home.layouts.home');

@section('title','陈坤');



@section('main')
    <div class="card card-horizontal">
        <div class="card-body">
            <div class="card-horizontal-left">
                <div class="card-category">
                    <a href="category.html">Food &amp; Drink</a> </div>
                <h3 class="card-title"><a href="single-post.html">Best and Worst Summer Foods</a></h3>
                <div class="card-excerpt">
                    <p>Admodum comprehenderit id non cillum anim de appellat, ubi tamen singulis sempiternum, occaecat sunt appellat appellat ex varias an in quem laborum an si ita quid multos irure do excepteur culpa quamquam. Nam aliqua iudicem aliquip o sunt cupidatat...</p>
                </div>
                <div class="card-horizontal-meta">
                    <div class="eskimo-author-meta">
                        By <a class="author-meta" href="author.html">Egemenerd</a>
                    </div>
                    <div class="eskimo-date-meta">
                        <a href="single-post.html">May 22, 2018</a>
                    </div>
                    <div class="eskimo-reading-meta">3 min read</div>
                </div>
            </div>
            <div class="card-horizontal-right" data-img="http://eskimo.egemenerd.com/wp-content/uploads/2018/05/blog18-1024x682.jpg">
                <a class="card-featured-img" href="single-post.html"></a>
            </div>
        </div>
    </div>
    <!-- 正文结束   -->

    <!-- VIEW ALL BUTTON -->
    <div class="eskimo-view-more">
        <a class="btn btn-default" href="blog.html">VIEW ALL POSTS</a>
    </div>

    <!-- DIVIDER -->
    <hr class="section-divider" />

    <!-- CAROUSEL -->
    <div class="eskimo-widget-title">
        <h3 class="eskimo-carousel-title"><span>POPULAR POSTS</span></h3>
    </div>

    <div class="eskimo-carousel-container">
        <div class="eskimo-carousel-view-more">
            <a href="blog.html">VIEW ALL</a>
        </div>

        <div id="eskimo-post-carousel" class="eskimo-carousel">
            <!-- CAROUSEL ITEM 1 -->
            <div>
                <div class="card-masonry card-small">
                    <div class="card">
                        <a href="single-post.html">
                            <img class="card-vertical-img" src="http://eskimo.egemenerd.com/wp-content/uploads/2018/05/blog4-1-900x600.jpg" alt="Ketchup Flavored Ice Cream!" />
                        </a>
                        <div class="card-border">
                            <div class="card-body">
                                <div class="card-category">
                                    <a href="single-post.html">May 28, 2018</a>
                                </div>
                                <h5 class="card-title"><a href="single-post.html">Ketchup Flavored Ice Cream!</a></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection