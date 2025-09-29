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

        /**
         * Set equal block heights
         * 1. Select all elements with the class .js-block-height
         * 2. Reset heights to auto to recalculate based on the new size
         * 3. Find the tallest block height
         * 4. Apply the tallest height to each block as inline style
         * 5. Ensure the content is fully loaded before executing the height adjustment
         * 6. Reapply the height on window resize
         * 7. Reapply the height on tab change
         */
        function setEqualBlockHeights() {
          /* 1 */
          const blocks = document.querySelectorAll('.c-block-news');
          /* 2 */
          blocks.forEach(block => {
            block.style.height = 'auto';
          });
          /* 3 */
          let maxHeight = 0;
          blocks.forEach(block => {
            const blockHeight = block.offsetHeight;
            if (blockHeight > maxHeight) {
              maxHeight = blockHeight;
            }
          });
          /* 4 */
          blocks.forEach(block => {
            block.style.height = `${maxHeight}px`;
          });
        }
        /* 5 */
        window.addEventListener('load', () => {
          setEqualBlockHeights();
        });
        /* 6 */
        window.addEventListener("resize", setEqualBlockHeights);

        // This will create a single gallery from all elements that have class "c-gallery__image"
        $('.c-block-gallery__image-link, .c-gallery__image-link').magnificPopup({
          type: 'image',
          gallery: {
            enabled:true
          }
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
              $(this).parent().addClass('active');
              $(this).parent().parent().addClass('active');
              $(this).parent().parent().parent().addClass('active');
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

        $('.js-block-gallery').each(function(key, item) {
          var id = $(this).attr('id');
          var $slickGalleryImages = $('#' + id +' .js-block-gallery-image');
          var $slickGalleryNav = $('#' + id +' .js-block-gallery-nav');

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
              adaptiveHeight: true
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
        });

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

        /**
         * General helper function to support toggle functions.
         */
        var toggleClasses = function(element) {
          var $this = element,
              $togglePrefix = $this.data('prefix') || 'this';

          // If the element you need toggled is relative to the toggle, add the
          // .js-this class to the parent element and "this" to the data-toggled attr.
          if ($this.data('toggled') == "this") {
            var $toggled = $this.closest('.js-this');
          }
          else {
            var $toggled = $('.' + $this.data('toggled'));
          }
          if ($this.attr('aria-expanded', 'true')) {
            $this.attr('aria-expanded', 'true')
          }
          else {
            $this.attr('aria-expanded', 'false')
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
          e.preventDefault();
          e.stopPropagation();
          toggleClasses($(this));
        });

        // Toggle parent class
        $('.js-toggle-parent').on('click', function(e) {
          e.preventDefault();
          var $this = $(this);
          $this.toggleClass('this-is-active');
          $this.parent().toggleClass('this-is-active');
        });

        // Prevent bubbling to the body. Add this class to the element (or element
        // container) that should allow the click event.
        $('.js-stop-prop').on('click', function(e) {
          e.stopPropagation();
        });

        /**
         * Get product ID mapping via AJAX and add to select options
         */
        function addProductIdsToWPFormsOptions() {
          // Make AJAX call to get product mapping
          $.ajax({
            url: window.location.origin + '/wp-admin/admin-ajax.php',
            type: 'POST',
            data: {
              action: 'get_product_id_mapping'
            },
            success: function(response) {
              if (response.success && response.data) {
                var productMapping = response.data;

                // Target only field ID 21
                $('select[name="wpforms[fields][21]"]').each(function() {
                  var $select = $(this);

                  $select.find('option').each(function() {
                    var $option = $(this);
                    var optionText = $option.text().trim();

                    // Remove leading spaces from indented options (from categories)
                    var cleanOptionText = optionText.replace(/^\s+/, '');

                    // Check if we have a product ID for this title
                    if (productMapping[cleanOptionText]) {
                      $option.attr('data-product-id', productMapping[cleanOptionText]);
                    }
                  });
                });

                // Now run auto-select after IDs are added
                autoSelectWPFormsProduct();
              }
            },
            error: function() {
              console.log('Failed to load product mapping');
            }
          });
        }

        /**
         * Auto-select WPForms product based on URL hash (product ID)
         */
        function autoSelectWPFormsProduct() {
          // Check if there's a hash in the URL
          var hash = window.location.hash;

          if (hash && hash.length > 1) {
            var productId = hash.substring(1); // Remove the # symbol

            // Target only field ID 21
            var targetSelectors = [
              'select[name="wpforms[fields][21]"]'
            ];

            // Function to find and select matching option by product ID
            function selectProductById($select, id) {
              var found = false;

              // Try to find a matching option by product ID
              $select.find('option').each(function() {
                var $option = $(this);
                var optionValue = $option.val();
                var productId = $option.data('product-id') || $option.attr('data-product-id');

                // Skip empty options
                if (!optionValue || optionValue === '0.00' || optionValue === '') {
                  return true; // continue
                }

                // Check if product ID matches
                if (productId && productId.toString() === id.toString()) {
                  $option.prop('selected', true);
                  $select.trigger('change'); // Trigger change to update WPForms totals
                  found = true;
                  console.log('Auto-selected product ID:', id, 'Product:', $option.text().trim());
                  return false; // Break the loop
                }
              });

              if (!found) {
                console.log('Product not found in dropdown for ID:', id);
                console.log('Available options:');
                $select.find('option').each(function() {
                  var $option = $(this);
                  var productId = $option.data('product-id') || $option.attr('data-product-id');
                  if (productId) {
                    console.log('- ID:', productId, 'Text:', $option.text().trim());
                  }
                });
              }

              return found;
            }

            // Apply to all target selectors
            targetSelectors.forEach(function(selector) {
              var $element = $(selector);
              if ($element.length) {
                selectProductById($element, productId);
              }
            });
          }
        }

        // Load product IDs and run auto-select on page load
        addProductIdsToWPFormsOptions();

        // Also run when WPForms is loaded (in case forms load via AJAX)
        $(document).on('wpformsReady', function() {
          addProductIdsToWPFormsOptions();
        });
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
