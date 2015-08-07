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
  var Sage = {
    // All pages
    'common': {
      init: function() {
        // JavaScript to be fired on all pages

        if(0 < $('#user_login').length) {
          $('p.login-username').replaceWith('<input type="text" name="log" id="user_login" class="input" value="" size="20" placeholder="Email">');
        }
        if(0 < $('#user_pass').length) {
          $('p.login-password').replaceWith('<input type="password" name="pwd" id="user_pass" class="input" value="" size="20" placeholder="Password">');
        }

        $(document).on('click', '.must-log-in > a', function(){
          $('#login-form-container').slideDown(800);
          if($(window).scrollTop() >= 300) { //has scrolled considerably to animate
            $('html, body').animate({ scrollTop: '+0' }, 1200);
          }
          return false;
        });

        $(document).on('click', '.menu-item.registration-button', function(){
          if($('#topBanner').is(':visible')) {
            $('#topBanner').slideUp(800);
          }
          if($('#login-form-container').is(':visible')) {
            $('#login-form-container').slideUp(800);
          }
          if($('#registration-form-container').not(':visible')) {
            $('#registration-form-container').slideDown(800);
          }
        });

        $(document).on('click', '.menu-item.login-button', function(){
          if($('#topBanner').is(':visible')) {
            $('#topBanner').slideUp(800);
          }
          if($('#login-form-container').not(':visible')) {
            $('#login-form-container').slideDown(800);
          }
          if($('#registration-form-container').is(':visible')) {
            $('#registration-form-container').slideUp(800);
          }
        });

        // Submit the password reset form via ajax
        $( '#resetpassform' ).submit(function(e) {

          e.preventDefault();

          $('.login-error').slideUp();

          //check if password fields are empty
          if ($('#pass1').val() == '' || $('#pass1').val() == '') {
            return false;
          }

          var formData = $(this).serialize();

          $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {form_values: formData, action: 'reset_user_pass'},
          })
              .done(function (status) {

                switch (status) {

                  case 'expiredkey' :
                  case 'invalidkey' :
                    $('.login-error').html('<div>Sorry, the link does not appear to be valid or is expired.</div>').slideDown();
                    break;

                  case 'mismatch' :
                    $('.login-error').html('<div>The passwords do not match.</div>').slideDown();
                    break;

                  case 'success' :
                    $('.login-error').html('<div>Your password has been reset.</div>').slideDown();
                    break;

                  default:
                    console.log(status);
                    $('.login-error').html('<div>Something went wrong.Please try again </div>').slideDown();
                    break;

                }

              })
              .fail(function () {
                console.log("error");
              })
              .always(function () {
                console.log("complete");
              });
        }); // end of password reset
      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // About us page, note the change from about-us to about_us.
    'about_us': {
      init: function() {
        // JavaScript to be fired on the about us page
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
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
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
