(function ($) {
	"use strict";
	jQuery(document).ready(function(){
		jQuery('.ftc-product.product').unbind('click').on('click',function(event){
        //remove all pre-existing active classes
        jQuery(this).addClass('delay');
        jQuery('.delay').removeClass('delay').addClass('active');
        jQuery('.active').off(event);
        //add the active class to the link we clicked

         event.preventDefault();

     });

    });
})(jQuery);