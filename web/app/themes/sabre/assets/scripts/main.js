/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function ($) {

    // Use this variable to set up the common and page specific functions. If you
    // rename this variable, you will also need to rename the namespace below.
    var Sage = {
        // All pages
        'common': {
            init: function () {
                $(".dropdown-menu > li > a.trigger").on("click",function(e){
                    var current=$(this).next();
                    var grandparent=$(this).parent().parent();
                    grandparent.find(".sub-menu:visible").not(current).hide();
                    current.toggle();
                    e.stopPropagation();
                    e.preventDefault();
                });
                $(".dropdown-menu > li > a:not(.trigger)").on("click",function(e){
                    var root=$(this).closest('.dropdown');
                    root.find('.sub-menu:visible').hide();
                });

            },
            finalize: function () {
                // JavaScript to be fired on all pages, after page specific JS is fired
            }
        },
        // Home page
        'home': {
            init: function () {
                // JavaScript to be fired on the home page
                var player;
                $('#video-modal').on('show.bs.modal', function(event) {
                    player = new YT.Player('yt-player');
                    var video = $(event.relatedTarget);
                    var videoSrc = video.data('src');
                    var modal = $(this);
                    modal.find('.embed-responsive-item').attr('src', videoSrc + '?rel=0&wmode=Opaque&enablejsapi=1');
                });

                $('#video-modal').on('hide.bs.modal', function() {
                    player.stopVideo();
                });

                $(document).ready(function() {
                    $('#homepage-media-slider').addClass('flexslider');
                    $('#homepage-media-slider').flexslider({
                        slideshowSpeed:3000,
                        animation:'slide',
                        controlNav:true,
                        directionNav:true,
                        pauseOnHover:true,
                        direction:'horizontal',
                        reverse:false,
                        animationSpeed:600,
                        prevText:"&lt;",
                        nextText:"&gt;",
                        easing:"linear",
                        slideshow:true,
                        maxItems:3,
                        itemWidth:180,
                        minItems:1,
                        itemMargin:100
                    });
                });

                var sourceSwap = function () {
                    var $this = $(this);
                    var newSource = $this.data('alt-src');
                    $this.data('alt-src', $this.attr('src'));
                    $this.attr('src', newSource);
                }

                $(function() {
                    $('img[data-alt-src]').each(function() {
                        new Image().src = $(this).data('alt-src');
                    }).hover(sourceSwap, sourceSwap);
                });

                lightbox.option({
                   'maxWidth': 1200
                });

            },
            finalize: function () {
                // JavaScript to be fired on the home page, after the init JS
            }
        },
        // About us page, note the change from about-us to about_us.
        'about_us': {
            init: function () {
                // JavaScript to be fired on the about us page
            }
        },
        'single_brand': {
            init: function () {

                $(window).load(function() {
                    $('.flexslider').flexslider({
                        slideshowSpeed:3000,
                        controlNav:true,
                        animation:"fade",
                        prevText: '',
                        nextText: ''

                    });
                });
                var applyHeight = function() {
                    if ($(window).width() > 767) {
                        var flexHeight = $(".row.top > .brand-slider").height()
                        $(".row.top > .brand-aside").height(flexHeight);
                    } else {
                        $(".row.top > .brand-aside").css({'height': 'auto'});
                        $(".row.top > .brand-aside > .brand-aside-content > .vertical-centre > div").css({"margin": 0});
                    }
                };
                $(window).load(function() {
                    applyHeight();
                });
                $(window).resize(function() {
                    applyHeight();
                });


            }
        }
    };

    // The routing fires all common scripts, followed by the page specific scripts.
    // Add additional events for more control over timing e.g. a finalize event
    var UTIL = {
        fire: function (func, funcname, args) {
            var fire;
            var namespace = Sage;
            funcname = (funcname === undefined) ? 'init' : funcname;
            fire = func !== '';
            fire = fire && namespace[func];
            fire = fire && typeof namespace[func][funcname] === 'function';

            if (fire) {
                namespace[func][funcname](args);
            }
        },
        loadEvents: function () {
            // Fire common init JS
            UTIL.fire('common');

            // Fire page-specific init JS, and then finalize JS
            $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function (i, classnm) {
                UTIL.fire(classnm);
                UTIL.fire(classnm, 'finalize');
            });

            // Fire common finalize JS
            UTIL.fire('common', 'finalize');
        }
    };

    // Load Events
    $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
