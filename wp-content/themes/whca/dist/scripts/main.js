/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// identity function for calling harmony imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/wp-content/themes/whca/dist/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 5);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports) {

module.exports = jQuery;

/***/ }),
/* 1 */,
/* 2 */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(jQuery) {/* ========================================================================
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

        // Add active class the menu-nav link
        if (!$('body').hasClass('home')) {
          var url = window.location.pathname;
          if (url == '/') {
            $('nav li > a[href="/"]').parent().addClass('active');
            setTimeout(function() {
              $('.c-header').addClass('this-is-active');
            }, 500); // set the time here
          } else {
            var urlRegExp = new RegExp(url.replace(/\/$/, '') + "$");
            $('nav li > a').each(function () {
              if (urlRegExp.test(this.href.replace(/\/$/, ''))) {
                $(this).parent().addClass('active');
                $(this).parent().parent().parent().addClass('active');
                setTimeout(function() {
                  $('.c-header').addClass('this-is-active');
                }, 500); // set the time here
              }
            });
          }
        }

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
        $('.js-hover').on('mouseenter mouseleave', function(e) {
          e.preventDefault();
          toggleClasses($(this));
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

/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(0)))

/***/ }),
/* 3 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),
/* 4 */,
/* 5 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(2);
module.exports = __webpack_require__(3);


/***/ })
/******/ ]);
//# sourceMappingURL=main.js.map