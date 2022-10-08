(function($) {
	'use strict';
	
	$(document).ready(function(){
		mkdfProductListAppear();
	});

	function mkdfProductListAppear(){
	    var lists = $('.mkdf-pl-holder.mkdf-pl-enable-appear');

	    if (lists.length) {

	    	lists.each(function(){
                var thisProductList = $(this),
                    products = thisProductList.find('.mkdf-pli'),
                    itemsInRow = $(this).data('number-of-columns'),
                    cycle = 0,
                    delay = 150;

                    products.each(function(l) {
		                var thisProduct = $(this);

		                setTimeout(function(){
		                    thisProduct.appear(function() {

		                        if (cycle == itemsInRow) {
		                            cycle = 0;
		                        }

		                        setTimeout(function(){
		                            thisProduct.addClass('mkdf-appeared');
		                        }, cycle*delay);

		                        cycle++;

		                    },{accX: 0, accY: 0});
		                }, 20); //wait for rewind calc
		            });

	    	});
	    }

	}
	
})(jQuery);