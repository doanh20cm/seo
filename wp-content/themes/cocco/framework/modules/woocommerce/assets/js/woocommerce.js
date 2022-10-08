(function($) {
    'use strict';

    var woocommerce = {};
    mkdf.modules.woocommerce = woocommerce;

    woocommerce.mkdfOnDocumentReady = mkdfOnDocumentReady;
    woocommerce.mkdfOnWindowLoad = mkdfOnWindowLoad;
    woocommerce.mkdfOnWindowResize = mkdfOnWindowResize;

    $(document).ready(mkdfOnDocumentReady);
	$(window).on('load', function(){
		mkdfOnWindowLoad();
	});
    $(window).resize(mkdfOnWindowResize);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function mkdfOnDocumentReady() {
        mkdfInitQuantityButtons();
        mkdfInitSelect2();
	    mkdfInitSingleProductLightbox();
		mkdfInitProductListFilter().init();
		mkdfQuickViewGallery().init();
		mkdfQuickViewSelect2();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function mkdfOnWindowLoad() {
        mkdfInitProductListMasonryShortcode();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function mkdfOnWindowResize() {
        mkdfInitProductListMasonryShortcode();
    }
	
    /*
    ** Init quantity buttons to increase/decrease products for cart
    */
	function mkdfInitQuantityButtons() {
		$(document).on('click', '.mkdf-quantity-minus, .mkdf-quantity-plus', function (e) {
			e.stopPropagation();
			
			var button = $(this),
				inputField = button.siblings('.mkdf-quantity-input'),
				step = parseFloat(inputField.data('step')),
				max = parseFloat(inputField.data('max')),
				minus = false,
				inputValue = parseFloat(inputField.val()),
				newInputValue;
			
			if (button.hasClass('mkdf-quantity-minus')) {
				minus = true;
			}
			
			if (minus) {
				newInputValue = inputValue - step;
				if (newInputValue >= 1) {
					inputField.val(newInputValue);
				} else {
					inputField.val(0);
				}
			} else {
				newInputValue = inputValue + step;
				if (max === undefined) {
					inputField.val(newInputValue);
				} else {
					if (newInputValue >= max) {
						inputField.val(max);
					} else {
						inputField.val(newInputValue);
					}
				}
			}
			
			inputField.trigger('change');
		});
	}
    function mkdfQuickViewGallery() {

	    var initGallery = function(){
	        var sliders = $('.mkdf-quick-view-gallery.mkdf-owl-slider');

	        if (sliders.length) {
	            sliders.each(function(){
	                var slider = $(this);
	                slider.owlCarousel({
	                    items: 1,
	                    loop: true,
	                    autoplay: false,
	                    smartSpeed: 600,
	                    margin: 0,
	                    center: false,
	                    autoWidth: false,
	                    animateIn : false,
	                    animateOut : false,
	                    dots: false,
	                    nav: true,
	                    navText: [
	                        '<span class="mkdf-prev-icon"><span class="dripicons-arrow-thin-left"></span></span>',
	                        '<span class="mkdf-next-icon"><span class="dripicons-arrow-thin-right"></span></span>'
	                    ],
	                    onInitialize: function () {
	                        slider.css('visibility', 'visible');
	                    }
	                });
	            });
	        }
	    }

	    return {
	        init: function () {
	            //trigger defined in yith-woocommerce-quick-view\assets\js\frontend.js, after quick view is returned
	            $(document).on('qv_loader_stop',function(){
	                initGallery();

	                $('.yith-wcqv-wrapper').css('top', mkdf.scroll+20); //positioning popup on screens smaller than ipad portrait
	            });
	        }
	    }
	}

    function mkdfQuickViewSelect2() {
        $(document).on('qv_loader_stop',function(){
            $('#yith-quick-view-modal select').select2();
        });
    }
    /*
    ** Init select2 script for select html dropdowns
    */
	function mkdfInitSelect2() {
		var orderByDropDown = $('.woocommerce-ordering .orderby');
		if (orderByDropDown.length) {
			orderByDropDown.select2({
				minimumResultsForSearch: Infinity
			});
		}
		
		var variableProducts = $('.mkdf-woocommerce-page .mkdf-content .variations td.value select');
		if (variableProducts.length) {
			variableProducts.select2();
		}
		
		var shippingCountryCalc = $('#calc_shipping_country');
		if (shippingCountryCalc.length) {
			shippingCountryCalc.select2();
		}
		
		var shippingStateCalc = $('.cart-collaterals .shipping select#calc_shipping_state');
		if (shippingStateCalc.length) {
			shippingStateCalc.select2();
		}
	}
	
	/*
	 ** Init Product Single Pretty Photo attributes
	 */
	function mkdfInitSingleProductLightbox() {
		var item = $('.mkdf-woo-single-page.mkdf-woo-single-has-pretty-photo .images .woocommerce-product-gallery__image');
		
		if(item.length) {
			item.children('a').attr('data-rel', 'prettyPhoto[woo_single_pretty_photo]');
			
			if (typeof mkdf.modules.common.mkdfPrettyPhoto === "function") {
				mkdf.modules.common.mkdfPrettyPhoto();
			}
		}
	}
	
	/*
	 ** Init Product List Masonry Shortcode Layout
	 */
	function mkdfInitProductListMasonryShortcode() {
		var container = $('.mkdf-pl-holder.mkdf-masonry-layout .mkdf-pl-outer');
		
		if (container.length) {
			container.each(function () {
				var thisContainer = $(this),
					size = thisContainer.find('.mkdf-pl-sizer').width();
				
				thisContainer.waitForImages(function () {
					thisContainer.isotope({
						itemSelector: '.mkdf-pli',
						resizable: false,
						masonry: {
							columnWidth: '.mkdf-pl-sizer',
							gutter: '.mkdf-pl-gutter'
						}
					});

					mkdf.modules.common.setFixedImageProportionSize(thisContainer.parent(), thisContainer.find('.mkdf-pli'), size);

					thisContainer.isotope('layout').css('opacity', 1);
				});
			});
		}
	}



	function mkdfInitProductListFilter(){
		var productList = $('.mkdf-pl-holder');
		var queryParams = {};

		var initFilterClick = function(thisProductList){
			var links = thisProductList.find('.mkdf-pl-categories a, .mkdf-pl-ordering a');

			links.on('click', function(e) {
				e.preventDefault();
				e.stopPropagation();

				var clickedLink = $(this);
				if(!clickedLink.hasClass('active')) {
					initMainPagFunctionality(thisProductList, clickedLink);
				}
			});
		}

		//used for replacing content after ajax call
		var mkdfReplaceStandardContent = function(thisProductListInner, loader, responseHtml) {
			thisProductListInner.html(responseHtml);
			loader.fadeOut();
		};

		//used for replacing content after ajax call
		var mkdfReplaceMasonryContent = function(thisProductListInner, loader, responseHtml) {
			thisProductListInner.find('.mkdf-pli').remove();

			thisProductListInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
			// mkdfProductImageSizes(thisProductListInner);

			mkdf.modules.common.setFixedImageProportionSize(thisProductListInner.parent(), thisProductListInner.find('.mkdf-pli'), thisProductListInner.find('.mkdf-pl-sizer').width());
			setTimeout(function() {
				thisProductListInner.isotope('layout');
				loader.fadeOut();
			}, 400);
		};

		//used for storing parameters in global object
		var mkdfReturnOrderingParemeters = function(queryParams, data){

			for (var key in data) {
				queryParams[key] = data[key];
			}

			//store ordering parameters
			switch(queryParams.ordering) {
				case 'menu_order':
					queryParams.metaKey = '';
					queryParams.order = 'asc';
					queryParams.orderby = 'menu_order title';
					break;
				case 'popularity':
					queryParams.metaKey = 'total_sales';
					queryParams.order = 'desc';
					queryParams.orderby = 'meta_value_num';
					break;
				case 'rating':
					queryParams.metaKey = '_wc_average_rating';
					queryParams.order = 'desc';
					queryParams.orderby = 'meta_value_num';
					break;
				case 'newness':
					queryParams.metaKey = '';
					queryParams.order = 'desc';
					queryParams.orderby = 'date';
					break;
				case 'price':
					queryParams.metaKey = '_price';
					queryParams.order = 'asc';
					queryParams.orderby = 'meta_value_num';
					break;
				case 'price-desc':
					queryParams.metaKey = '_price';
					queryParams.order = 'desc';
					queryParams.orderby = 'meta_value_num';
					break;
			}

			return queryParams;
		}

		var initMainPagFunctionality = function(thisProductList, clickedLink){
			var thisProductListInner = thisProductList.find('.mkdf-pl-outer');

			var loadData = mkdf.modules.common.getLoadMoreData(thisProductList),
				loader = thisProductList.find('.mkdf-prl-loading');

			//store parameters in global object
			mkdfReturnOrderingParemeters(queryParams, clickedLink.data());

			//set paremeters for new query passed through ajax
			loadData.category = queryParams.category !== undefined ? queryParams.category : '';
			loadData.metaKey = queryParams.metaKey !== undefined ? queryParams.metaKey : '';
			loadData.order = queryParams.order !== undefined ? queryParams.order : '';
			loadData.orderby = queryParams.orderby !== undefined ? queryParams.orderby : '';
			loadData.minPrice = queryParams.minprice !== undefined ? queryParams.minprice : '';
			loadData.maxPrice = queryParams.maxprice !== undefined ? queryParams.maxprice : '';

			loader.fadeIn();

			var ajaxData = mkdf.modules.common.setLoadMoreAjaxData(loadData, 'cocco_mikado_product_ajax_load_category');

			$.ajax({
				type: 'POST',
				data: ajaxData,
				url: mkdfGlobalVars.vars.mkdfAjaxUrl,
				success: function (data) {
					var response = $.parseJSON(data),
						responseHtml =  response.html;

					thisProductList.waitForImages(function(){
						clickedLink.parent().siblings().find('a').removeClass('active');
						clickedLink.addClass('active');
						if(thisProductList.hasClass('mkdf-masonry-layout')) {
							mkdfReplaceMasonryContent(thisProductListInner, loader, responseHtml);
						}else{
							mkdfReplaceStandardContent(thisProductListInner, loader, responseHtml);
						}
					});

				}
			});
		}

		var initMobileFilterClick = function(cliked, holder){
			cliked.on('click',function(){
				if(mkdf.windowWidth <= 768) {
					if(!cliked.hasClass('opened')){
						cliked.addClass('opened');
						holder.slideDown();
					}else{
						cliked.removeClass('opened');
						holder.slideUp();
					}
				}
			});
		}

		return {
			init: function () {
				if (productList.length) {
					productList.each(function () {
						var thisProductList = $(this);
						initFilterClick(thisProductList);

						initMobileFilterClick(thisProductList.find('.mkdf-pl-ordering-outer h6'), thisProductList.find('.mkdf-pl-ordering'));
						initMobileFilterClick(thisProductList.find('.mkdf-pl-categories-label'),thisProductList.find('.mkdf-pl-categories-label').next('ul'));
					});
				}
			},

		}
	}

})(jQuery);