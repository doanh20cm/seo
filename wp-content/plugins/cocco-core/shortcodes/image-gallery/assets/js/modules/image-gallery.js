(function($) {
    'use strict';
	
	var imageGallery = {};
	mkdf.modules.imageGallery = imageGallery;
	
	imageGallery.mkdfInitImageGalleryMasonry = mkdfInitImageGalleryMasonry;
	
	
	imageGallery.mkdfOnWindowLoad = mkdfOnWindowLoad;
	
	$(window).load(mkdfOnWindowLoad);
	
	/*
	 ** All functions to be called on $(window).load() should be in this function
	 */
	function mkdfOnWindowLoad() {
		mkdfInitImageGalleryMasonry();
	}
	
	/*
	 ** Init Image Gallery shortcode - Masonry layout
	 */
	function mkdfInitImageGalleryMasonry(){
		var holder = $('.mkdf-image-gallery.mkdf-ig-masonry-type');
		
		if(holder.length){
			holder.each(function(){
				var thisHolder = $(this),
					masonry = thisHolder.find('.mkdf-ig-masonry'),
					size = masonry.find('.mkdf-ig-grid-sizer').width();
				
				masonry.waitForImages(function() {
					masonry.isotope({
						layoutMode: 'packery',
						itemSelector: '.mkdf-ig-image',
						percentPosition: true,
						packery: {
							gutter: '.mkdf-ig-grid-gutter',
							columnWidth: '.mkdf-ig-grid-sizer'
						}
					});

					if (thisHolder.hasClass('mkdf-ig-masonry-fixed-type')) {					
						mkdfResizeImageMasonryLayoutItems(size, masonry);
					}

					setTimeout(function() {
						masonry.isotope('layout');
						mkdf.modules.common.mkdfInitParallax();
					}, 800);
					
					masonry.css('opacity', '1');
				});
			});
		}
	}

	function mkdfResizeImageMasonryLayoutItems(size,container){
		var space_between_items = parseInt(container.find('.mkdf-ig-image').css('paddingLeft')),
			space_between_items_size = space_between_items !== undefined && space_between_items !== '' ? parseInt(space_between_items, 10) : 0,
			newSize = size - 2 * space_between_items_size,
			defaultMasonryItem = container.find('.mkdf-default-masonry-item'),
			largeWidthMasonryItem = container.find('.mkdf-large-width-masonry-item'),
			largeHeightMasonryItem = container.find('.mkdf-large-height-masonry-item'),
			largeWidthHeightMasonryItem = container.find('.mkdf-large-width-height-masonry-item');
		
		if (mkdf.windowWidth > 768) {
			defaultMasonryItem.css('height', newSize);
			largeHeightMasonryItem.css('height', Math.round(2 * ( newSize + space_between_items_size )));
			largeWidthHeightMasonryItem.css('height', Math.round(2 * ( newSize + space_between_items_size )));
			largeWidthMasonryItem.css('height', newSize);
		} else {
			defaultMasonryItem.css('height', newSize);
			largeHeightMasonryItem.css('height', Math.round(2 * ( newSize + space_between_items_size )));
			largeWidthHeightMasonryItem.css('height', newSize);
			largeWidthMasonryItem.css('height', Math.round(newSize / 2));
		}
	}

})(jQuery);