<!-- JS FILES -->
<script src="{{ URL::asset('home/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ URL::asset('home/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('home/js/salvattore.min.js') }}"></script>
<script src="{{ URL::asset('home/js/slick.min.js') }}"></script>
<script src="{{ URL::asset('home/js/panel.js') }}"></script>
<script src="{{ URL::asset('home/js/reading-position-indicator.js') }}"></script>
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