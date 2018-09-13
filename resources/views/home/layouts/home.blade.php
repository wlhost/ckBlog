<!DOCTYPE html>
<html lang="en-US">

<!-- source http://www.scnoob.com More templates http://www.scnoob.com/moban.html -->
<head>
    <title>@yield('title')</title>
    <!-- META TAGS -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <!-- CSS FILES -->
    <link href="{{ URL::asset('home/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('home/css/fontawesome.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('home/css/slick.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('home/css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('home/css/rrssb.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('home/css/featherlight.css') }}" rel="stylesheet" type="text/css">

    @yield('css')
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
            <!-- 左侧导航栏开始 -->
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
            <!-- 左侧导航栏结束 -->

            <!-- 右侧区域开始 -->
            <!-- 右侧悬浮-->
            <ul class="eskimo-top-icons">
                <li id="eskimo-panel-icon">
                    <a href="#eskimo-panel" class="eskimo-panel-open"><i class="fa fa-bars"></i></a>
                </li>
                <li id="eskimo-search-icon">
                    <a id="eskimo-open-search" href="#"><i class="fa fa-search"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
            <!-- 右侧悬浮-->

            <!-- 正文开始   -->

            @section('main')
                @show

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
                    Made with love by Egemenerd More Templates <a href="http://www.scnoob.com">菜鸟素材</a> - Collect from <a href="http://www.scnoob.com/moban.html">网页模板</a>
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
<div id="eskimo-panels">
    <aside id="eskimo-panel" class="eskimo-panel">
        <div class="eskimo-panel-inner">
            <!-- CLOSE SLIDE PANEL BUTTON -->
            <a href="#" class="eskimo-panel-close"><i class="fa fa-times"></i></a>
            <!-- AUTHOR BOX -->
            <div class="eskimo-author-box eskimo-widget">
                <div class="eskimo-author-img">
                    <img src="http://eskimo.egemenerd.com/wp-content/uploads/2018/05/img.jpg" alt="JOHN DOE" />
                </div>
                <h3><span>JOHN DOE</span></h3>
                <p class="eskimo-author-subtitle">WEB DESIGNER &amp; DEVELOPER</p>
                <p class="eskimo-author-description">I'm a Web Developer and Designer with a strong passion for UX/UI design. I have experience building websites, web applications, and brand assets. Contact me if you have any questions!</p>
                <div class="eskimo-author-box-btn">
                    <a class="btn btn-default" href="about.html">CONTACT ME</a>
                </div>
            </div>
            <!-- RECENT POSTS -->
            <div class="eskimo-recent-entries eskimo-widget">
                <h5 class="eskimo-title-with-border"><span>Recent Posts</span></h5>
                <ul>
                    <li>
                        <a href="single-post.html">Ketchup Flavored Ice Cream!</a>
                        <span class="post-date">May 28, 2018</span>
                    </li>
                    <li>
                        <a href="single-post.html">Hair You've Always Dreamed Of</a>
                        <span class="post-date">May 27, 2018</span>
                    </li>
                    <li>
                        <a href="single-post.html">15 Of The World's Best Carnivals</a>
                        <span class="post-date">May 25, 2018</span>
                    </li>
                    <li>
                        <a href="single-post.html">5 Ways to a Healthy Lifestyle</a>
                        <span class="post-date">May 25, 2018</span>
                    </li>
                    <li>
                        <a href="single-post.html">Best Breakfast In The World</a>
                        <span class="post-date">May 23, 2018</span>
                    </li>
                </ul>
            </div>
            <!-- CATEGORIES -->
            <div class="eskimo-categories eskimo-widget">
                <h5 class="eskimo-title-with-border"><span>Categories</span></h5>
                <ul>
                    <li>
                        <a href="category.html" title="The best restaurants, cafes, bars and shops in town.">Food &amp; Drink</a> <span class="badge badge-pill badge-default">5</span>
                    </li>
                    <li>
                        <a href="category.html" title="An up-to-date, personal urban guide.">Lifestyle</a> <span class="badge badge-pill badge-default">5</span>
                    </li>
                    <li>
                        <a href="category.html" title="Latest technology news and updates.">Technology</a> <span class="badge badge-pill badge-default">4</span>
                    </li>
                    <li>
                        <a href="category.html" title="Travel advice, information and inspiration.">Travel</a> <span class="badge badge-pill badge-default">5</span>
                    </li>
                    <li>
                        <a href="category.html" title="The latest news about movies and TV shows.">TV &amp; Movies</a> <span class="badge badge-pill badge-default">4</span>
                    </li>
                </ul>
            </div>
            <!-- TAGS -->
            <div class="eskimo-widget">
                <h5 class="eskimo-title-with-border"><span>Tags</span></h5>
                <div class="eskimo-tag-cloud">
                    <a href="category.html">aute<span>7</span></a>
                    <a href="category.html">enim<span>7</span></a>
                    <a href="category.html">commodo<span>7</span></a>
                    <a href="category.html">voluptatibus<span>7</span></a>
                    <a href="category.html">culpa<span>7</span></a>
                    <a href="category.html">offendit<span>7</span></a>
                    <a href="category.html">magna<span>7</span></a>
                    <a href="category.html">quorum<span>7</span></a>
                    <a href="category.html">mandaremus<span>7</span></a>
                    <a href="category.html">ingeniis<span>7</span></a>
                    <a href="category.html">tempor<span>7</span></a>
                    <a href="category.html">summis<span>7</span></a>
                    <a href="category.html">consequat<span>6</span></a>
                    <a href="category.html">iudicem<span>6</span></a>
                    <a href="category.html">expetendis<span>6</span></a>
                    <a href="category.html">deserunt<span>6</span></a>
                </div>
            </div>
        </div>
    </aside>
</div>
<!-- FULLSCREEN SEARCH -->
<div id="eskimo-fullscreen-search">
    <div id="eskimo-fullscreen-search-content">
        <a href="#" id="eskimo-close-search"><i class="fa fa-times"></i></a>
        <form role="search" method="get" action="search.html" class="eskimo-lg-form">
            <div class="input-group">
                <input type="text" class="form-control form-control-lg" placeholder="Enter a keyword..." name="s" />
                <div class="input-group-append">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- JS FILES -->
<script src="{{ URL::asset('home/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ URL::asset('home/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('home/js/salvattore.min.js') }}"></script>
<script src="{{ URL::asset('home/js/slick.min.js') }}"></script>
<script src="{{ URL::asset('home/js/panel.js') }}"></script>
<script src="{{ URL::asset('home/js/reading-position-indicator.js') }}"></script>
<script src="{{ URL::asset('home/js/featherlight.js') }}"></script>
<script src="{{ URL::asset('home/js/rrssb.min.js') }}"></script>
<script src="{{ URL::asset('home/js/custom.js') }}"></script>
<!-- POST SLIDER -->

<!-- POST CAROUSEL -->
<script>
    (function($) {
        "use strict";
        $(document).ready(function() {
            $('#eskimo-post-carousel').slick({
                infinite: false,
                slidesToScroll: 1,
                arrows: true,
                dots: false,
                slidesToShow: 3,
                responsive: [{
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2
                    }
                }, {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1
                    }
                }]

            });
            $('#eskimo-post-carousel').css('opacity', '1');
        });
    })(jQuery);
</script>
</body>


<!-- source http://www.scnoob.com More templates http://www.scnoob.com/moban.html -->
</html>