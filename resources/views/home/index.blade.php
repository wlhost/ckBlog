<!DOCTYPE html>
<html lang="en-US">

<!-- source http://www.scnoob.com More templates http://www.scnoob.com/moban.html -->
<head>
    <title>ichenkun's BLOG</title>
    <!-- META TAGS -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="description" content="">
    <meta name="keywords" content="">
    <!-- CSS FILES -->
    <link href="{{ URL::asset('home/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('home/css/fontawesome.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('home/css/slick.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('home/css/style.css') }}" rel="stylesheet" type="text/css">


</head>
<body>
<!-- READING POSITION INDICATOR -->
<progress value="0" id="eskimo-progress-bar">
        <span class="eskimo-progress-container">
            <span class="eskimo-progress-bar"></span>
        </span>
</progress>
<!-- SITE WRAPPER -->
<div id="eskimo-site-wrapper">
    <!-- MAIN CONTAINER -->
    <main id="eskimo-main-container">
        <div class="container">
            <!-- SIDEBAR -->
            <div id="eskimo-sidebar">
                <div id="eskimo-sidebar-wrapper" class="d-flex align-items-start flex-column h-100 w-100">
                    <!-- LOGO -->
                    <div id="eskimo-logo-cell" class="w-100">
                        <a class="eskimo-logo-link" href="index.html">
                            <img src="{{ URL::asset('home/images/logo.png') }}" class="eskimo-logo" alt="eskimo" />
                        </a>
                    </div>
                    <!-- MENU CONTAINER -->
                    <div id="eskimo-sidebar-cell" class="w-100">
                        <!-- MOBILE MENU BUTTON -->
                        <div id="eskimo-menu-toggle">MENU</div>
                        <!-- MENU -->
                        <nav id="eskimo-main-menu" class="menu-main-menu-container">
                            <ul class="eskimo-menu-ul">
                                @foreach($category as $item)
                                <li><a href="/category/{{ $item['alias'] }}">{{ $item['name'] }}</a>
                                    <ul class="sub-menu">
                                        @foreach($category as $item)
                                            @if($item['id'] = $item['pid'])
                                            <li><a href="/category/{{ $item['alias'] }}">{{ $item['name'] }}</a></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                                @endforeach
                            </ul>
                        </nav>
                    </div>
                    <!-- SOCIAL MEDIA ICONS -->
                    <div id="eskimo-social-cell" class="mt-auto w-100">
                        <div id="eskimo-social-inner">
                            <ul class="eskimo-social-icons">
                                <li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fa fa-vimeo"></i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- TOP ICONS -->
            <ul class="eskimo-top-icons">
                <li id="eskimo-panel-icon">
                    <a href="#eskimo-panel" class="eskimo-panel-open"><i class="fa fa-bars"></i></a>
                </li>
                <li id="eskimo-search-icon">
                    <a id="eskimo-open-search" href="#"><i class="fa fa-search"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
            <!-- SLIDER -->
            <!-- BLOG POSTS -->
            <!-- POST 1 -->
            @foreach($article as $item)
            <div class="card card-horizontal">
                <div class="card-body">
                    <div class="card-horizontal-left">
                        <div class="card-category">
                            @foreach($category as $ca)
                                @if($ca['id'] = $item['category_id'])
                            <a href="/category{{ $ca['alias'] }}">{{ $ca['name'] }}</a>
                                @endif
                            @endforeach
                        </div>
                        <h3 class="card-title"><a href="/article{{ $item['id'] }}">{{ $item['title'] }}</a></h3>
                        <div class="card-excerpt">
                            <p>{{ $item['description'] }}</p>
                        </div>
                        <div class="card-horizontal-meta">
                            <div class="eskimo-author-meta">
                                By <a class="author-meta" href="#">{{ $item['author'] }}</a>
                            </div>
                            <div class="eskimo-date-meta">
                                <a href="/article{{ $item['id'] }}">{{ $item['created_at'] }}</a>
                            </div>
                            <div class="eskimo-reading-meta">3 min read</div>
                        </div>
                    </div>
                    @if(isset($item['cover']))
                    <div class="card-horizontal-right" data-img="{{ $item['cover'] }}">
                        <a class="card-featured-img" href="/article{{ $item['id'] }}"></a>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
            <!-- POST 2 -->

            <!-- VIEW ALL BUTTON -->
            <div class="eskimo-view-more">
                <a class="btn btn-default" href="blog.html">VIEW ALL POSTS</a>
            </div>

            <!-- DIVIDER -->
            <hr class="section-divider" />

            <!-- CAROUSEL -->
            <div class="eskimo-widget-title">
                <h3 class="eskimo-carousel-title"><span>点击排行</span></h3>
            </div>

            <div class="eskimo-carousel-container">
                <div class="eskimo-carousel-view-more">
                    <a href="blog.html">查看全部</a>
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
                    <!-- CAROUSEL ITEM 2 -->
                    <div>
                        <div class="card-masonry card-small">
                            <div class="card">
                                <a href="single-post.html">
                                    <img class="card-vertical-img" src="http://eskimo.egemenerd.com/wp-content/uploads/2018/05/blog1-900x600.jpg" alt="Hair You've Always Dreamed Of" />
                                </a>
                                <div class="card-border">
                                    <div class="card-body">
                                        <div class="card-category">
                                            <a href="single-post.html">May 27, 2018</a>
                                        </div>
                                        <h5 class="card-title"><a href="single-post.html">Hair You've Always Dreamed Of</a></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- CAROUSEL ITEM 3 -->
                    <div>
                        <div class="card-masonry card-small">
                            <div class="card">
                                <a href="single-post.html">
                                    <img class="card-vertical-img" src="http://eskimo.egemenerd.com/wp-content/uploads/2018/05/blog-900x600.jpg" alt="15 Of The World's Best Carnivals" />
                                </a>
                                <div class="card-border">
                                    <div class="card-body">
                                        <div class="card-category">
                                            <a href="single-post.html">May 25, 2018</a>
                                        </div>
                                        <h5 class="card-title"><a href="single-post.html">15 Of The World's Best Carnivals</a></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- CAROUSEL ITEM 4 -->
                    <div>
                        <div class="card-masonry card-small">
                            <div class="card">
                                <a href="single-post.html">
                                    <img class="card-vertical-img" src="http://eskimo.egemenerd.com/wp-content/uploads/2018/05/blog19-900x600.jpg" alt="5 Ways to a Healthy Lifestyle" />
                                </a>
                                <div class="card-border">
                                    <div class="card-body">
                                        <div class="card-category">
                                            <a href="single-post.html">May 25, 2018</a>
                                        </div>
                                        <h5 class="card-title"><a href="single-post.html">5 Ways to a Healthy Lifestyle</a></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- CAROUSEL ITEM 5 -->
                    <div>
                        <div class="card-masonry card-small">
                            <div class="card">
                                <a href="single-post.html">
                                    <img class="card-vertical-img" src="http://eskimo.egemenerd.com/wp-content/uploads/2018/05/blog5-900x600.jpg" alt="Best Breakfast In The World" />
                                </a>
                                <div class="card-border">
                                    <div class="card-body">
                                        <div class="card-category">
                                            <a href="single-post.html">May 23, 2018</a>
                                        </div>
                                        <h5 class="card-title"><a href="single-post.html">Best Breakfast In The World</a></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- FOOTER -->
    <footer id="eskimo-footer">
        <div class="container">
            <div class="row eskimo-footer-wrapper">
                <!-- FOOTER WIDGET 1 -->
                <div class="col-12 col-lg-6 mb-4 mb-lg-0">
                    <h5 class="eskimo-title-with-border"><span>About Me</span></h5>
                    <p>Trusted by thousands of customers, my unique themes and plugins help you make beautiful responsive web sites with ease.</p>
                    <p><a href="about.html" class="btn btn-default">Read More</a></p>
                </div>
                <!-- FOOTER WIDGET 2 -->
                <div class="col-12 col-lg-6">
                    <h5 class="eskimo-title-with-border"><span>Newsletter</span></h5>
                    <form method="post" action="index.html">
                        <label>Subscribe to our mailing list!</label>
                        <div class="input-group">
                            <input type="email" class="form-control" name="EMAIL" placeholder="Your email address" required />
                            <div class="input-group-append">
                                <input type="submit" value="Sign up"  class="btn btn-default" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- CREDITS -->
            <div class="eskimo-footer-credits">
                <p>
                    Power BY - ichenkun
                </p>
            </div>
        </div>
    </footer>
</div>
<!-- GO TO TOP BUTTON -->
<a id="eskimo-gototop" href="#"><i class="fa fa-chevron-up"></i></a>
<!-- SLIDE PANEL OVERLAY -->
<div id="eskimo-overlay"></div>
<!-- SLIDE PANEL -->
@include('home.common.intro');
<!-- FULLSCREEN SEARCH -->

@include('home.common.search');

@include('home.common.footer');