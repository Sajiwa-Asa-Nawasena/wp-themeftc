( function($) {
	"use strict";

	$(document).ready(function() {
	
		// Example of Elementor editor JS hooks
		// run code when "FTC Products categories" settings are opened
		elementor.hooks.addAction( 'panel/open_editor/widget/ftc-products-slider', function( panel, model, view ) {
			console.log("FTC Products Slider");
		} );

	} );
function ftc_owl_slider(){
/*tab slider element product*/
  $('.ftc-tabs .ftc-product.products').each(function () {
    var element = $(this);
    var columns = element.data('columns');
    var nav = element.data('nav') ;  
    var dots = element.data('dots') ;             
    var desksmall_items = element.data('desksmall_items');
    var tabletmini_items = element.data('tabletmini_items');
    var tablet_items = element.data('tablet_items');
    var mobile_items = element.data('mobile_items');
    var mobilesmall_items = element.data('mobilesmall_items');    
    $(this).addClass('loading');
    $(this).owlCarousel({
      loop: true
      ,nav: nav
      ,dots: dots
      ,navText: [,]
      ,navSpeed: 1000
      ,slideBy: 1
      ,rtl: $('body').hasClass('rtl')
      ,margin: 10
      ,navRewind: false
      ,autoplay: true
      ,autoplayTimeout: 5000
      ,autoplayHoverPause: true
      ,autoplaySpeed: 1000
      ,autoHeight: true
      ,responsive: {
        0:{
          items: mobilesmall_items
        },
        480:{
          items: mobile_items
        },
        700:{
          items: tablet_items
        },
        768:{
          items: tabletmini_items
        },
        991:{
          items: desksmall_items
        },
        1199:{
          items:columns
        }
      }
      ,onInitialized: function(){
        element.find('.meta-slider').addClass('loaded').removeClass('loading');
      }

    });

  });
}
	
} )( jQuery );