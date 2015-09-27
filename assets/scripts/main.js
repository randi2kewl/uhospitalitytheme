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
        $('input[name="user_username"]').attr('placeholder', 'Email');
        $('input[name="user_password"]').attr('placeholder', 'Password');
        $('input[name="forgot"][type="submit"]').val('Reset Password');
        $('form[name="login"] input[type="submit"]').parent('.form-group').css('clear', 'both');

        $('#infinite-handle > span').text('SHOW MORE').addClass('btn btn-blue btn-outlined');

        $(document).on('click', '.must-log-in > a', function(e){
          e.preventDefault();

          $('#login-form-container').slideDown(800);
          if($(window).scrollTop() >= 300) { //has scrolled considerably to animate
            $('html, body').animate({ scrollTop: '+0' }, 1200);
          }
        });

        $(document).on('click', '.menu-item.registration-button, .signup-button', function(e){
          e.preventDefault();

          $('.navbar-toggle:visible').click();
          if($(window).scrollTop() >= 300) { //has scrolled considerably to animate
            $('html, body').animate({ scrollTop: '+0' }, 1200);
          }

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

        $(document).on('click', '.menu-item.login-button', function(e){
          e.preventDefault();

          $('.navbar-toggle:visible').click();
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

        $(document).on('click', '#forgot-password-link', function(e){
          e.preventDefault();

          $('#loginform').hide();
          $('#login-form-label').text('');
          $('#resetpassform').show();
        });

        $(document).on('click', '#forgot-cancel', function(e){
          e.preventDefault();

          $('#resetpassform').hide();
          $('#login-form-label').text("");
          $('#loginform').show();
        });

        $(document).on('submit', '#forgot', function(e) {
          e.preventDefault();

            $.ajax({
               type: "POST",
               url: $("form#forgot").attr('action'),
               data: $("form#forgot").serialize(), // serializes the form's elements.
               success: function(data){}
             });

          $('#login-form-label').text('Please check your email for further directions.');
        });

        if($('.et_social_gmail > a').length) {
          $('.et_social_gmail > a').each(function(){
            var subject = $('.entry-title').text();
            var body = window.location.href;

            $(this).attr('href', 'mailto:?subject=' + subject + '&body=' + body);
          });
        }
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
