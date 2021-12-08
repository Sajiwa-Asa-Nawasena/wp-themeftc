(function ($) {
  "use strict";

  
  /*header dropdown builder*/
  $('.header-dropdown-element').each(function(){
    $(this).find('.header-icon').on('click', function(){
      $(this).closest('.header-dropdown-element').find('.content-dropdown').slideToggle();
    });
  });
  /*Dropdown menu vertical*/
  $('.ftc-element.ftc-vertical-menu .title-menu').on('click', function(){
    $('.ftc-element.ftc-vertical-menu').toggleClass('active');
    $('.ftc-element.ftc-vertical-menu .menu-dropdown').slideToggle();
  });

  var tabs = $('.ftc-list-product-by-categories');
  tabs.each( function(){

        var $_Tabs = $(this); // Single tabs holder
        
        var tabsWrapper = $_Tabs.find('.product-category-tab'),
        tabTitles   = tabsWrapper.find('.tab-title'),
        tabsContent = $_Tabs.find('.content-product'),
        content     = tabsContent.find('.products');
        
        //tabTitles.click( function(event) {
         $('.tab-0').addClass('active');
         $( document ).on( 'click', '.tab-title', function(event) {
          $(this).addClass('active');
          $(this).siblings().removeClass('active');

          // Hide inactive tab titles and show active one and content
          var tab = $(this).data('tab');
          content.not('.tab-'+ tab).css('display', 'none').removeClass('active');
          tabsContent.find('.tab-' + tab).addClass('active');
        });

       });
  
  $(window).on("load", function() {
    $(".elementor-image-gallery .gallery").isotope();
  });

  if($(window).width() < 768){
    $('.min .ftc-product-tabs').each(function(){
      var width_sli = $(window).width();
      var tru = width_sli - 30;
      $(this).css("width", tru + 'px');
    });
  }

  // out container - wide
  $('.elementor-container.elementor-column-gap-wide .swiper-container').each(function(){
    var ww = $(window).width();
    var www = ww ;
    $(this).closest('.elementor-widget-container').css("width", www + 'px');
  });
// end
// out container - extended
$('.elementor-container.elementor-column-gap-extended .swiper-container ').each(function(){
  var ww = $(window).width();
  var www = ww ;
  if(www <= 1024){
    $(this).closest('.elementor-widget-container').css("width", www + 'px');
  }

});
// end

var tabs = $('.ftc-list-product-by-categories');
tabs.each( function(){

        var $_Tabs = $(this); // Single tabs holder
        
        var tabsWrapper = $_Tabs.find('.product-category-tab'),
        tabTitles   = tabsWrapper.find('.tab-title'),
        tabsContent = $_Tabs.find('.content-product'),
        content     = tabsContent.find('.products');
        
        //tabTitles.click( function(event) {
         $('.tab-0').addClass('active');
         $( document ).on( 'click', '.tab-title', function(event) {
          $(this).addClass('active');
          $(this).siblings().removeClass('active');

          // Hide inactive tab titles and show active one and content
          var tab = $(this).data('tab');
          content.not('.tab-'+ tab).css('display', 'none').removeClass('active');
          tabsContent.find('.tab-' + tab).addClass('active');
        });

       });

function ftc_owl_slider(){
  /*tab slider element product*/
  $('.ftc-tabs .ftc-product.products, .ftc-list-product-by-categories .content-product .products.tab.slider, .ftc-instagram .slider').each(function () {
    var element = $(this);
    var columns = element.data('columns');
    var nav = element.data('nav') ;  
    var dots = element.data('dots') ;             
    var desksmall_items = element.data('desksmall_items');
    var tabletmini_items = element.data('tabletmini_items');
    var tablet_items = element.data('tablet_items');
    var mobile_items = element.data('mobile_items');
    var mobilesmall_items = element.data('mobilesmall_items'); 
    var margin  =  element.data('margin');
    var timespeed  =  element.data('timespeed');  
    $(this).addClass('loading');
    $(this).owlCarousel({
      loop: true
      ,nav: nav
      ,dots: dots
      ,navText: [,]
      ,navSpeed: 1000
      ,slideBy: 1
      ,rtl: $('body').hasClass('rtl')
      ,margin: margin
      ,navRewind: false
      ,autoplay: true
      ,autoplayTimeout: timespeed
      ,autoplayHoverPause: true
      ,autoplaySpeed: 1000
      ,autoHeight: true
      ,responsive: {
        0:{
          items: mobilesmall_items,
          margin: 20
        },
        480:{
          items: mobile_items
        },
        700:{
          items: tabletmini_items
        },
        768:{
          items: tablet_items
        },
        991:{
          items: desksmall_items
        },
        1199:{
          items:columns
        }
      }
      ,onInitialized: function(){
        element.addClass('loaded').removeClass('loading');
      }

    });

  });
}
ftc_owl_slider();

/*Slider Insta new*/
$('.ftc-instagram-widget.slider').each(function () {
  var element = $(this);
  var columns = element.data('columns') ; 
  var show_nav = element.data('show_nav') ;  
  var auto_play = element.data('auto_play') ;
  var margin = element.data('margin') ;       
  $(this).owlCarousel({
    loop: true
    ,nav: show_nav
    ,dots: false
    ,navText: [,]
    ,navSpeed: 1000
    ,slideBy: 1
    ,rtl: $('body').hasClass('rtl')
    ,margin: margin
    ,navRewind: false
    ,autoplay: auto_play
    ,autoplayTimeout: 5000
    ,autoplayHoverPause: true
    ,autoplaySpeed: 1000
    ,autoHeight: true
    ,responsive: {
      0:{
        items: 2
      },
      480:{
        items: 2
      },
      700:{
        items: columns
      },
      768:{
        items: columns
      },
      991:{
        items: columns
      },
      1199:{
        items:columns
      }
    }
    ,onInitialized: function(){
      element.addClass('loaded').removeClass('loading');
    }

  });

});
/*Circle countdown*/
$("#DateCountdown").TimeCircles();
$("#CountDownTimer").TimeCircles({ time: { Days: { show: false }, Hours: { show: false } }});
$("#PageOpenTimer").TimeCircles();

var updateTime = function(){
  var date = $("#date").val();
  var time = $("#time").val();
  var datetime = date + ' ' + time + ':00';
  $("#DateCountdown").data('date', datetime).TimeCircles().start();
}
$("#date").change(updateTime).keyup(updateTime);
$("#time").change(updateTime).keyup(updateTime);

            // Start and stop are methods applied on the public TimeCircles instance
            $(".startTimer").click(function() {
              $("#CountDownTimer").TimeCircles().start();
            });
            $(".stopTimer").click(function() {
              $("#CountDownTimer").TimeCircles().stop();
            });

            // Fade in and fade out are examples of how chaining can be done with TimeCircles
            $(".fadeIn").click(function() {
              $("#PageOpenTimer").fadeIn();
            });
            $(".fadeOut").click(function() {
              $("#PageOpenTimer").fadeOut();
            });


            $('.ftc-product-grid').each(function(){
              var element = $(this);
              var atts = element.data('atts');
              var ass  = element.data('args');

              /* Show more */
              element.find('a.load-more').bind('click', function(){
                var button = $(this);
                if( button.hasClass('loading') ){
                  return false;
                }
                button.addClass('loading');
                var paged = button.attr('data-paged');

                $.ajax({
                  type : "POST",
                  timeout : 30000,
                  url : ftc_shortcode_params.ajax_uri,
                  data : {action: 'ftc_products_elements_load_items', paged: paged, atts : atts,  ass : ass},
                  error: function(xhr,err){

                  },
                  success: function(response) {
                    button.removeClass('loading');
                    button.attr('data-paged', ++paged);
                    if( response != 0 && response != '' ){
                      element.find('.products').append(response);
                      ftc_quickshop_action_element();
                    }
                    else{ /* No results */
                      button.parent().remove();
                    }
                  }
                });
                return false;
              });
            });
            
            /*Click Hotspot*/
            $('.ftc-hot-spot-image').each(function (e) {
              $('.ftc-hot-spot-wrap.click .ftc-hot-spot-inner').bind('click', function () {
                $(this).toggleClass('active');
                $(this).closest('.ftc-hot-spot-wrap.click').find('.content').toggle();
              });
            });

    // $("body").not('.ftc-hot-spot-wrap').click(function() {  
    //   $(this).find('.ftc-hot-spot-wrap').removeClass('active');
    // });
    
    /*Quick view*/
    function ftc_quickshop_action_element() {
      jQuery('a.quickview').prettyPhoto({
        deeplinking: false
        , opacity: 0.9
        , social_tools: false
        , default_width: 900
        , default_height: 450
        , theme: 'pp_woocommerce'
        , changepicturecallback: function () {
          jQuery('.pp_inline').find('form.variations_form').wc_variation_form();
          jQuery('.pp_inline').find('form.variations_form .variations select').change();
          jQuery('body').trigger('wc_fragments_loaded');

          jQuery('.pp_inline .variations_form').on('click', '.reset_variations', function () {
            jQuery(this).closest('.variations').find('.ftc-product-attribute .option').removeClass('selected');
          });

          jQuery('.pp_woocommerce').addClass('loaded');

          var _this = jQuery('.ftc-quickshop-wrapper .images-slider-wrapper');

          if (_this.find('.image-item').length <= 1) {
            return;
          }

          var owl = _this.find('.image-items').owlCarousel({
            items: 1
            , loop: true
            , nav: true
            , navText: [, ]
            , dots: false
            , navSpeed: 1000
            , slideBy: 1
            , rtl: jQuery('body').hasClass('rtl')
            , margin: 10
            , navRewind: false
            , autoplay: false
            , autoplayTimeout: 5000
            , autoplayHoverPause: false
            , autoplaySpeed: false
            , mouseDrag: true
            , touchDrag: true
            , responsiveBaseElement: _this
            , responsiveRefreshRate: 1000
            , onInitialized: function () {
              _this.addClass('loaded').removeClass('loading');
            }
          });

        }
      });
    }
    /*Actice thumbnail gallery*/


    jQuery(document).ready(function(){
      jQuery('.ftc-thumbnails-gallery ul.details-thumbnails li span').click(function(event){
        //remove all pre-existing active classes
        jQuery('.active_tb').removeClass('active_tb');

        //add the active class to the link we clicked
        // jQuery(this).find('a .cover_image').addClass('active');
        jQuery(this).addClass('active_tb');
        jQuery(this).closest('.ftc-products').find('.images a .cover_image').addClass('active_tb');
        var changeSrc =  $(this).find('img').attr("src");
        $("a .cover_image.active_tb img").fadeOut(300, function() {
          $("a .cover_image.active_tb img").attr("srcset", changeSrc); 
        })
        .fadeIn(300);
        event.preventDefault();
      });
    });


    /*Hover avtive gallery product Swiper slider */

    jQuery('.ftc-product .ftc-thumbnails-gallery ul li img').mouseenter(function(event){
      jQuery('.activeee').removeClass('activeee');
      jQuery(this).addClass('activeee');
      jQuery(this).closest('.ftc-product').find('.images a .cover_image').addClass('activeee');
      var changeSrc =  jQuery(this).attr("src");
      jQuery("a .cover_image.activeee .wp-post-image").attr("srcset", changeSrc).fadeIn(300);
      event.preventDefault();
    });

    jQuery(".ftc-product .ftc-thumbnails-gallery  ul li img").mouseleave(function() {
      jQuery("a .cover_image.activeee.wp-post-image").attr("srcset", '').fadeIn(300);
    });

  })(jQuery);