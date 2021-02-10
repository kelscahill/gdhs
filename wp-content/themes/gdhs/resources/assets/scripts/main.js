/* eslint-disable */

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

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var er = {
    // All pages
    'common': {
      init: function() {

        // JavaScript to be fired on all pages

        // Add class if is mobile
        function isMobile() {
          if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            return true;
          }
          return false;
        }

        // Add class if is mobile
        if (isMobile()) {
          $('html').addClass(' touch');
        } else if (!isMobile()){
          $('html').addClass(' no-touch');
        }

        // check window width
        var getWidth = function() {
          var width;
          if (document.body && document.body.offsetWidth) {
            width = document.body.offsetWidth;
          }
          if (document.compatMode === 'CSS1Compat' &&
              document.documentElement &&
              document.documentElement.offsetWidth ) {
             width = document.documentElement.offsetWidth;
          }
          if (window.innerWidth) {
             width = window.innerWidth;
          }
          return width;
        };
        window.onload = function() {
          getWidth();
        };
        window.onresize = function() {
          getWidth();
        };

        // This will create a single gallery from all elements that have class "c-gallery__image"
        $('.c-gallery__image-link').magnificPopup({
          type: 'image',
          gallery:{
            enabled:true
          }
        });

        $(window).load(function() {
          setTimeout(function(){
            $('html').removeClass("preload");
          }, 1000);
        });

        $('.o-filter-select').on('change', function() {
          var data = $(this).find(':selected').data('filter');
          window.history.pushState({}, '', data);
          location.reload();
        });

        // Add active class the menu-nav link
        var url = window.location.toString();

        $('.c-primary-nav__list-item a').each(function() {
           var myHref = $(this).attr('href');
           if (url == myHref) {
              $(this).parent().parent().addClass('active');
           }
        });

        $('.c-primary-nav__list-item > ul').parent().addClass('has-sub-nav');

        /**
         * Slick sliders
         */
        $('.slick').slick({
          prevArrow: '<span class="u-icon--arrow u-icon--arrow-prev"></span>',
          nextArrow: '<span class="u-icon--arrow u-icon--arrow-next"></span>',
          dots: false,
          autoplay: true,
          autoplaySpeed: 5000,
          arrows: true,
          infinite: true,
          speed: 250,
          fade: true,
          cssEase: 'linear',
          useTransform: true
        });

        $('.slick-gallery').slick({
          dots: true,
          autoplay: false,
          arrows: false,
          infinite: true,
          speed: 250,
          cssEase: 'linear',
          adaptiveHeight: true
        });

        var $slickGalleryImages = $('.js-block-gallery');
        var $slickGalleryNav = $('.js-block-gallery-nav');
        if ($slickGalleryImages.length) {
          $slickGalleryImages.slick({
            speed: 500,
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            fade: true,
            dots: false,
            asNavFor: $slickGalleryNav,
            prevArrow: '<span class="u-icon--arrow u-icon--arrow-prev"></span>',
            nextArrow: '<span class="u-icon--arrow u-icon--arrow-next"></span>',
          });

          $slickGalleryNav.slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            asNavFor: $slickGalleryImages,
            draggable: true,
            focusOnSelect: true,
            arrows: false
          });
        }

        /**
         * Fixto
         */
        $('.js-sticky').fixTo('body', {
          className: 'sticky-is-active',
          useNativeSticky: true,
          zIndex: 9999,
          mind: 'c-utility',
        });

        $('.js-sticky-social').fixTo('.js-sticky-parent', {
          useNativeSticky: false,
          zIndex: 2,
          mind: 'c-header',
          top: 90
        });

        // Smooth scrolling on anchor clicks
        $(function() {
          $('a[href*="#"]:not([href="#"])').click(function() {
            if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
              var target = $(this.hash);
              target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
              if (target.length) {
                $('html, body').animate({
                  scrollTop: target.offset().top - 50
                }, 1000);
                return false;
              }
            }
          });
        });

        var $toggled = '';
        var toggleClasses = function(element) {
          var $this = element,
              $togglePrefix = $this.data('prefix') || 'this';

          // If the element you need toggled is relative to the toggle, add the
          // .js-this class to the parent element and "this" to the data-toggled attr.
          if ($this.data('toggled') === "this") {
            $toggled = $this.parents('.js-this');
          }
          else {
            $toggled = $('.' + $this.data('toggled'));
          }

          $this.toggleClass($togglePrefix + '-is-active');
          $toggled.toggleClass($togglePrefix + '-is-active');

          // Remove a class on another element, if needed.
          if ($this.data('remove')) {
            $('.' + $this.data('remove')).removeClass($this.data('remove'));
          }
        };

        /*
         * Toggle Active Classes
         *
         * @description:
         *  toggle specific classes based on data-attr of clicked element
         *
         * @requires:
         *  'js-toggle' class and a data-attr with the element to be
         *  toggled's class name both applied to the clicked element
         *
         * @example usage:
         *  <span class="js-toggle" data-toggled="toggled-class">Toggler</span>
         *  <div class="toggled-class">This element's class will be toggled</div>
         *
         */
        $('.js-toggle').on('click', function(e) {
          e.stopPropagation();
          toggleClasses($(this));
        });

        // Toggle parent class
        $('.js-toggle-parent').on('click', function(e) {
          e.preventDefault();
          var $this = $(this);

          $this.parent().toggleClass('is-active');
        });

        // Toggle hovered classes
        if (getWidth() >= 1100) {
          $('.js-hover').on('mouseenter mouseleave', function(e) {
            e.preventDefault();
            toggleClasses($(this));
          });
        }

      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      },
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      },
    },
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = er;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    },
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
