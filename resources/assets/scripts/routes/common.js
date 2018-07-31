export default {
  init() {

    //=====Grid/List View change in Facilities=====
    if($("#switchViewBtn").length) {
      $(".listView").hide();
    }

    $("#switchViewBtn").toggle(
      function(){
        $(".gridView").hide();
        $(".listView").show();
        $("#switchViewBtn").html('<i class="fa fa-th-large" aria-hidden="true"></i> Switch to Grid View');
      },
      function() {
        $(".gridView").show();
        $(".listView").hide();
        $("#switchViewBtn").html('<i class="fa fa-list" aria-hidden="true"></i> Switch to List View');
      }
    );
    //=============================================

    // JavaScript to be fired on all pages
    var headings = $('.anchorific').data('headings');
    headings = headings ? headings : 'h2,h3,h4';

    $('.usa-layout-docs').anchorific({
      headers: headings,
      anchorText: false,
      top: false,
      spyOffset: 2,
      exclude: '.screen-reader-text',
    });
    $('.anchorific > ul').addClass('usa-sidenav-list');
    $('.anchorific li > ul').addClass('usa-sidenav-sub_list');

    // media query event handler
    if (matchMedia) {
      var mq = window.matchMedia("(min-width: 1201px)");
      mq.addListener(WidthChange);
      WidthChange(mq);
    }

    // media query change
    function WidthChange(mq) {
      if (mq.matches) {
        // window width is at least 1201px
        // move aside before .usa-layout-docs-main_content
        $('aside.usa-layout-docs-sidenav').insertBefore( $('.usa-layout-docs-main_content') );
        $('.usa-layout-docs-sidenav').addClass('sticky usa-width-one-fourth');
      } else {
        // window width is less than 1201px
        //move aside under .usa-font-lead if exists or under header if it doesn't
        if($('aside.usa-layout-docs-sidenav').insertAfter( $('.usa-layout-docs-main_content').find('header').first().siblings('.usa-font-lead').first() ).length == 0) {
          $('aside.usa-layout-docs-sidenav').insertAfter( $('.usa-layout-docs-main_content').find('header').first() );
        }
        $('.usa-layout-docs-sidenav').css('height', '');
        $('.usa-layout-docs-sidenav').removeClass('sticky usa-width-one-fourth');
      }
    }
    var adminBarHeight = $('#wpadminbar').height();
    var navHeight = function (mq) {
      if (mq.matches) {
        $('.usa-layout-docs-sidenav').css('height', (window.innerHeight - 110 - adminBarHeight));
      }
    };

    navHeight(mq);

    $( window ).resize(function () {
      navHeight(mq);
    });

    $('.sticky').Stickyfill();

    var didScroll = false;
    var topNav = $('header.usa-header');

    window.onscroll = doThisStuffOnScroll;

    function doThisStuffOnScroll() {
      var scroll = $(window).scrollTop();
      var scrollHeight = 55;

      if (scroll >= scrollHeight) {
        topNav.addClass('show-logo');
      }
      else {
        topNav.removeClass('show-logo');
      }

      didScroll = true;
    }

    setInterval(function() {
      if(didScroll) {
        didScroll = false;
      }
    }, 500);

  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
