(function($) {
	'use strict';
	
	$(document).ready(function(){
		mkdfInitProductCategoriesPosition();
	});


	function mkdfInitProductCategoriesPosition(){
	    var lists = $('.mkdf-prod-cats-holder');
	    if (lists.length) {
	    	lists.each(function(){
	    		var list = $(this),
	    			items = list.find('.mkdf-prod-cat.mkdf-cat-with-image');

	    		list.waitForImages(function(){

		    		items.each(function(i){
		    			var thisItem = $(this),
		    				siblingItem,
		    				itemHeight,
		    				siblingHeight,
		    				margins;

		    			if (list.hasClass('mkdf-two-columns')){
							if ((i+1)%4 == 1) {
								siblingItem = thisItem.next();
							} else if ((i+1)%4 == 0) {
								siblingItem = thisItem.prev();
							}
						} else {
							if ((i+1)%6 == 1) {
								siblingItem = thisItem.next();
							} else if ((i+1)%2 == 1) {
								siblingItem = thisItem.prev();
							}						
						}

		    			
		    		});
		    	});

	    	});
	    }

	}
	
})(jQuery);