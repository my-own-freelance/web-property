<!-- ARCHIVES JS -->
<script src="{{ asset('frontpage/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('frontpage/js/rangeSlider.js') }}"></script>
<script src="{{ asset('frontpage/js/tether.min.js') }}"></script>
<script src="{{ asset('frontpage/js/moment.js') }}"></script>
<script src="{{ asset('frontpage/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontpage/js/mmenu.min.js') }}"></script>
<script src="{{ asset('frontpage/js/mmenu.js') }}"></script>
<script src="{{ asset('frontpage/js/aos.js') }}"></script>
<script src="{{ asset('frontpage/js/aos2.js') }}"></script>
<script src="{{ asset('frontpage/js/slick.min.js') }}"></script>
<script src="{{ asset('frontpage/js/fitvids.js') }}"></script>
<script src="{{ asset('frontpage/js/fitvids.js') }}"></script>
<script src="{{ asset('frontpage/js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('frontpage/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('frontpage/js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('frontpage/js/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('frontpage/js/smooth-scroll.min.js') }}"></script>
<script src="{{ asset('frontpage/js/lightcase.js') }}"></script>
<script src="{{ asset('frontpage/js/search.js') }}"></script>
<script src="{{ asset('frontpage/js/owl.carousel.js') }}"></script>
<script src="{{ asset('frontpage/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('frontpage/js/ajaxchimp.min.js') }}"></script>
<script src="{{ asset('frontpage/js/newsletter.js') }}"></script>
<script src="{{ asset('frontpage/js/jquery.form.js') }}"></script>
<script src="{{ asset('frontpage/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('frontpage/js/searched.js') }}"></script>
<script src="{{ asset('frontpage/js/forms-2.js') }}"></script>
<script src="{{ asset('frontpage/js/range.js') }}"></script>
<script src="{{ asset('frontpage/js/color-switcher.js') }}"></script>
<script src="{{ asset('frontpage/js/leaflet.js') }}"></script>
<script src="{{ asset('frontpage/js/leaflet-gesture-handling.min.js') }}"></script>
<script src="{{ asset('frontpage/js/leaflet-providers.js') }}"></script>
<script src="{{ asset('frontpage/js/leaflet.markercluster.js') }}"></script>
<script src="{{ asset('frontpage/js/map-single.js') }}"></script>

<script>
    $(window).on('scroll load', function() {
        $("#header.cloned #logo img").attr("src", $('#header #logo img').attr('data-sticky-logo'));
    });
</script>

<!-- Slider Revolution scripts -->
<script src="{{ asset('frontpage/revolution/js/jquery.themepunch.tools.min.js') }}"></script>
<script src="{{ asset('frontpage/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
            disableOn: 700,
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false
        });
    });

</script>

<script>
    $('.slick-lancers').slick({
        infinite: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        dots: true,
        arrows: true,
        adaptiveHeight: true,
        responsive: [{
            breakpoint: 1292,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                dots: true,
                arrows: false
            }
        }, {
            breakpoint: 993,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                dots: true,
                arrows: false
            }
        }, {
            breakpoint: 769,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: true,
                arrows: false
            }
        }, ]
    });
</script>
<script>
    $('.slick-lancers2').slick({
        infinite: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        dots: true,
        arrows: false,
        adaptiveHeight: true,
        responsive: [{
            breakpoint: 1292,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                dots: true,
                arrows: false
            }
        }, {
            breakpoint: 993,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                dots: true,
                arrows: false
            }
        }, {
            breakpoint: 769,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: true,
                arrows: false
            }
        }, ]
    });
</script>
<script>
    $('.job_clientSlide').owlCarousel({
        items: 2,
        loop: true,
        margin: 30,
        autoplay: false,
        nav: true,
        smartSpeed: 1000,
        slideSpeed: 1000,
        navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            991: {
                items: 2
            }
        }
    });
</script>

<script>
    $(".dropdown-filter").on('click', function() {

        $(".explore__form-checkbox-list").toggleClass("filter-block");

    });
</script>

<!-- MAIN JS -->
<script src="{{ asset('frontpage/js/script.js') }}"></script>
