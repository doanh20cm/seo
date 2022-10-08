(function($) {
    "use strict";

    window.mkdf = {};
    mkdf.modules = {};

    mkdf.scroll = 0;
    mkdf.window = $(window);
    mkdf.document = $(document);
    mkdf.windowWidth = $(window).width();
    mkdf.windowHeight = $(window).height();
    mkdf.body = $('body');
    mkdf.html = $('html, body');
    mkdf.htmlEl = $('html');
    mkdf.menuDropdownHeightSet = false;
    mkdf.defaultHeaderStyle = '';
    mkdf.minVideoWidth = 1500;
    mkdf.videoWidthOriginal = 1280;
    mkdf.videoHeightOriginal = 720;
    mkdf.videoRatio = 1.61;

    mkdf.mkdfOnDocumentReady = mkdfOnDocumentReady;
    mkdf.mkdfOnWindowLoad = mkdfOnWindowLoad;
    mkdf.mkdfOnWindowResize = mkdfOnWindowResize;
    mkdf.mkdfOnWindowScroll = mkdfOnWindowScroll;

    $(document).ready(mkdfOnDocumentReady);
    $(window).on('load', function(){
        mkdfOnWindowLoad();
    });
    $(window).resize(mkdfOnWindowResize);
    $(window).scroll(mkdfOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function mkdfOnDocumentReady() {
        mkdf.scroll = $(window).scrollTop();

        //set global variable for header style which we will use in various functions
        if(mkdf.body.hasClass('mkdf-dark-header')){ mkdf.defaultHeaderStyle = 'mkdf-dark-header';}
        if(mkdf.body.hasClass('mkdf-light-header')){ mkdf.defaultHeaderStyle = 'mkdf-light-header';}
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function mkdfOnWindowLoad() {

    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function mkdfOnWindowResize() {
        mkdf.windowWidth = $(window).width();
        mkdf.windowHeight = $(window).height();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function mkdfOnWindowScroll() {
        mkdf.scroll = $(window).scrollTop();
    }

    //set boxed layout width variable for various calculations

    switch(true){
        case mkdf.body.hasClass('mkdf-grid-1300'):
            mkdf.boxedLayoutWidth = 1350;
            break;
        case mkdf.body.hasClass('mkdf-grid-1200'):
            mkdf.boxedLayoutWidth = 1250;
            break;
        case mkdf.body.hasClass('mkdf-grid-1000'):
            mkdf.boxedLayoutWidth = 1050;
            break;
        case mkdf.body.hasClass('mkdf-grid-800'):
            mkdf.boxedLayoutWidth = 850;
            break;
        default :
            mkdf.boxedLayoutWidth = 1150;
            break;
    }

})(jQuery);
(function($) {
	"use strict";

    var common = {};
    mkdf.modules.common = common;

    common.mkdfFluidVideo = mkdfFluidVideo;
    common.mkdfEnableScroll = mkdfEnableScroll;
    common.mkdfDisableScroll = mkdfDisableScroll;
    common.mkdfOwlSlider = mkdfOwlSlider;
    common.mkdfInitParallax = mkdfInitParallax;
    common.mkdfInitSelfHostedVideoPlayer = mkdfInitSelfHostedVideoPlayer;
    common.mkdfSelfHostedVideoSize = mkdfSelfHostedVideoSize;
    common.mkdfPrettyPhoto = mkdfPrettyPhoto;
	common.mkdfStickySidebarWidget = mkdfStickySidebarWidget;
    common.getLoadMoreData = getLoadMoreData;
    common.setLoadMoreAjaxData = setLoadMoreAjaxData;
	common.setFixedImageProportionSize = setFixedImageProportionSize;

    common.mkdfOnDocumentReady = mkdfOnDocumentReady;
    common.mkdfOnWindowLoad = mkdfOnWindowLoad;
    common.mkdfOnWindowResize = mkdfOnWindowResize;

    $(document).ready(mkdfOnDocumentReady);
	$(window).on('load', function(){
		mkdfOnWindowLoad();
	});
    $(window).resize(mkdfOnWindowResize);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function mkdfOnDocumentReady() {
	    mkdfIconWithHover().init();
	    mkdfDisableSmoothScrollForMac();
	    mkdfInitAnchor().init();
	    mkdfInitBackToTop();
	    mkdfBackButtonShowHide();
	    mkdfInitSelfHostedVideoPlayer();
	    mkdfSelfHostedVideoSize();
	    mkdfFluidVideo();
	    mkdfOwlSlider();
	    mkdfPreloadBackgrounds();
	    mkdfPrettyPhoto();
	    mkdfSearchPostTypeWidget();
	    mkdfDashboardForm();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function mkdfOnWindowLoad() {
	    mkdfInitParallax();
        mkdfSmoothTransition();
	    mkdfStickySidebarWidget().init();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function mkdfOnWindowResize() {
        mkdfSelfHostedVideoSize();
    }
	
	/*
	 ** Disable smooth scroll for mac if smooth scroll is enabled
	 */
	function mkdfDisableSmoothScrollForMac() {
		var os = navigator.appVersion.toLowerCase();
		
		if (os.indexOf('mac') > -1 && mkdf.body.hasClass('mkdf-smooth-scroll')) {
			mkdf.body.removeClass('mkdf-smooth-scroll');
		}
	}
	
	function mkdfDisableScroll() {
		if (window.addEventListener) {
			window.addEventListener('wheel', mkdfWheel, {passive:false});
		}
		
		//window.onmousewheel = document.onmousewheel = mkdfWheel;
		document.onkeydown = mkdfKeydown;
	}
	
	function mkdfEnableScroll() {
		if (window.removeEventListener) {
			window.removeEventListener('wheel', mkdfWheel, {passive:false});
		}
		
		window.onmousewheel = document.onmousewheel = document.onkeydown = null;
	}
	
	function mkdfWheel(e) {
		mkdfPreventDefaultValue(e);
	}
	
	function mkdfKeydown(e) {
		var keys = [37, 38, 39, 40];
		
		for (var i = keys.length; i--;) {
			if (e.keyCode === keys[i]) {
				mkdfPreventDefaultValue(e);
				return;
			}
		}
	}
	
	function mkdfPreventDefaultValue(e) {
		e = e || window.event;
		if (e.preventDefault) {
			e.preventDefault();
		}
		e.returnValue = false;
	}
	
	/*
	 **	Anchor functionality
	 */
	var mkdfInitAnchor = function() {
		/**
		 * Set active state on clicked anchor
		 * @param anchor, clicked anchor
		 */
		var setActiveState = function(anchor){
			var headers = $('.mkdf-main-menu, .mkdf-mobile-nav, .mkdf-fullscreen-menu');
			
			headers.each(function(){
				var currentHeader = $(this);
				
				if (anchor.parents(currentHeader).length) {
					currentHeader.find('.mkdf-active-item').removeClass('mkdf-active-item');
					anchor.parent().addClass('mkdf-active-item');
					
					currentHeader.find('a').removeClass('current');
					anchor.addClass('current');
				}
			});
		};
		
		/**
		 * Check anchor active state on scroll
		 */
		var checkActiveStateOnScroll = function(){
			var anchorData = $('[data-mkdf-anchor]'),
				anchorElement,
				siteURL = window.location.href.split('#')[0];
			
			if (siteURL.substr(-1) !== '/') {
				siteURL += '/';
			}
			
			anchorData.waypoint( function(direction) {
				if(direction === 'down') {
					if ($(this.element).length > 0) {
						anchorElement = $(this.element).data("mkdf-anchor");
					} else {
						anchorElement = $(this).data("mkdf-anchor");
					}
				
					setActiveState($("a[href='"+siteURL+"#"+anchorElement+"']"));
				}
			}, { offset: '50%' });
			
			anchorData.waypoint( function(direction) {
				if(direction === 'up') {
					if ($(this.element).length > 0) {
						anchorElement = $(this.element).data("mkdf-anchor");
					} else {
						anchorElement = $(this).data("mkdf-anchor");
					}
					
					setActiveState($("a[href='"+siteURL+"#"+anchorElement+"']"));
				}
			}, { offset: function(){
				return -($(this.element).outerHeight() - 150);
			} });
		};
		
		/**
		 * Check anchor active state on load
		 */
		var checkActiveStateOnLoad = function(){
			var hash = window.location.hash.split('#')[1];
			
			if(hash !== "" && $('[data-mkdf-anchor="'+hash+'"]').length > 0){
				anchorClickOnLoad(hash);
			}
		};
		
		/**
		 * Handle anchor on load
		 */
		var anchorClickOnLoad = function ($this) {
			var scrollAmount,
				anchor = $('.mkdf-main-menu a, .mkdf-mobile-nav a, .mkdf-fullscreen-menu a'),
				hash = $this,
				anchorData = hash !== '' ? $('[data-mkdf-anchor="' + hash + '"]') : '';
			
			if (hash !== '' && anchorData.length > 0) {
				var anchoredElementOffset = anchorData.offset().top;
				scrollAmount = anchoredElementOffset - headerHeightToSubtract(anchoredElementOffset) - mkdfGlobalVars.vars.mkdfAddForAdminBar;
				
				if(anchor.length) {
					anchor.each(function(){
						var thisAnchor = $(this);
						
						if(thisAnchor.attr('href').indexOf(hash) > -1) {
							setActiveState(thisAnchor);
						}
					});
				}
				
				mkdf.html.stop().animate({
					scrollTop: Math.round(scrollAmount)
				}, 1000, function () {
					//change hash tag in url
					if (history.pushState) {
						history.pushState(null, '', '#' + hash);
					}
				});
				
				return false;
			}
		};
		
		/**
		 * Calculate header height to be substract from scroll amount
		 * @param anchoredElementOffset, anchorded element offset
		 */
		var headerHeightToSubtract = function (anchoredElementOffset) {
			
			if (mkdf.modules.stickyHeader.behaviour === 'mkdf-sticky-header-on-scroll-down-up') {
				mkdf.modules.stickyHeader.isStickyVisible = (anchoredElementOffset > mkdf.modules.header.stickyAppearAmount);
			}
			
			if (mkdf.modules.stickyHeader.behaviour === 'mkdf-sticky-header-on-scroll-up') {
				if ((anchoredElementOffset > mkdf.scroll)) {
					mkdf.modules.stickyHeader.isStickyVisible = false;
				}
			}
			
			var headerHeight = mkdf.modules.stickyHeader.isStickyVisible ? mkdfGlobalVars.vars.mkdfStickyHeaderTransparencyHeight : mkdfPerPageVars.vars.mkdfHeaderTransparencyHeight;
			
			if (mkdf.windowWidth < 1025) {
				headerHeight = 0;
			}
			
			return headerHeight;
		};
		
		/**
		 * Handle anchor click
		 */
		var anchorClick = function () {
			mkdf.document.on("click", ".mkdf-main-menu a, .mkdf-fullscreen-menu a, .mkdf-btn, .mkdf-anchor, .mkdf-mobile-nav a", function () {
				var scrollAmount,
					anchor = $(this),
					hash = anchor.prop("hash").split('#')[1],
					anchorData = hash !== '' ? $('[data-mkdf-anchor="' + hash + '"]') : '';
				
				if (hash !== '' && anchorData.length > 0) {
					var anchoredElementOffset = anchorData.offset().top;
					scrollAmount = anchoredElementOffset - headerHeightToSubtract(anchoredElementOffset) - mkdfGlobalVars.vars.mkdfAddForAdminBar;
					
					setActiveState(anchor);
					
					mkdf.html.stop().animate({
						scrollTop: Math.round(scrollAmount)
					}, 1000, function () {
						//change hash tag in url
						if (history.pushState) {
							history.pushState(null, '', '#' + hash);
						}
					});
					
					return false;
				}
			});
		};
		
		return {
			init: function () {
				if ($('[data-mkdf-anchor]').length) {
					anchorClick();
					checkActiveStateOnScroll();
					
					$(window).load(function () {
						checkActiveStateOnLoad();
					});
				}
			}
		};
	};
	
	function mkdfInitBackToTop() {
		var backToTopButton = $('#mkdf-back-to-top');
		backToTopButton.on('click', function (e) {
			e.preventDefault();
			mkdf.html.animate({scrollTop: 0}, mkdf.window.scrollTop() / 3, 'linear');
		});
	}
	
	function mkdfBackButtonShowHide() {
		mkdf.window.scroll(function () {
			var b = $(this).scrollTop(),
				c = $(this).height(),
				d;
			
			if (b > 0) {
				d = b + c / 2;
			} else {
				d = 1;
			}
			
			if (d < 1e3) {
				mkdfToTopButton('off');
			} else {
				mkdfToTopButton('on');
			}
		});
	}
	
	function mkdfToTopButton(a) {
		var b = $("#mkdf-back-to-top");
		b.removeClass('off on');
		if (a === 'on') {
			b.addClass('on');
		} else {
			b.addClass('off');
		}
	}
	
	function mkdfInitSelfHostedVideoPlayer() {
		var players = $('.mkdf-self-hosted-video');
		
		if (players.length) {
			players.mediaelementplayer({
				audioWidth: '100%'
			});
		}
	}
	
	function mkdfSelfHostedVideoSize(){
		var selfVideoHolder = $('.mkdf-self-hosted-video-holder .mkdf-video-wrap');
		
		if(selfVideoHolder.length) {
			selfVideoHolder.each(function(){
				var thisVideo = $(this),
					videoWidth = thisVideo.closest('.mkdf-self-hosted-video-holder').outerWidth(),
					videoHeight = videoWidth / mkdf.videoRatio;
				
				if(navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/)){
					thisVideo.parent().width(videoWidth);
					thisVideo.parent().height(videoHeight);
				}
				
				thisVideo.width(videoWidth);
				thisVideo.height(videoHeight);
				
				thisVideo.find('video, .mejs-overlay, .mejs-poster').width(videoWidth);
				thisVideo.find('video, .mejs-overlay, .mejs-poster').height(videoHeight);
			});
		}
	}
	
	function mkdfFluidVideo() {
        fluidvids.init({
			selector: ['iframe'],
			players: ['www.youtube.com', 'player.vimeo.com']
		});
	}
	
	function mkdfSmoothTransition() {

		if (mkdf.body.hasClass('mkdf-smooth-page-transitions')) {

			//check for preload animation
			if (mkdf.body.hasClass('mkdf-smooth-page-transitions-preloader')) {
				var loader = $('body > .mkdf-smooth-transition-loader.mkdf-mimic-ajax');

				if($('.mkdf-cocco-loader').length){
					$('.mkdf-cocco-loader').addClass('mkdf-cocco-loader-loaded');
					loader.addClass('mkdf-cocco-loader-loaded');
					setTimeout(function(){
						loader.fadeOut(500);
					},1500);

					setTimeout(function(){
						if($('.mkdf-skip-rev').length){
							var revSliderHeight = $('.mkdf-skip-rev').outerHeight();
							$("html, body").animate({ scrollTop: revSliderHeight }, 1200, 'easeInSine');
						}
					}, 3600);
				}
				else {
					loader.fadeOut(500);
					$(window).on( 'pageshow', function (event) {
						if (event.originalEvent.persisted) {
							loader.fadeOut(500);
						}
					});
				}
			}
			
			// if back button is pressed, than reload page to avoid state where content is on display:none
			
			window.addEventListener( "pageshow", function ( event ) {
				var historyPath = event.persisted || ( typeof window.performance != "undefined" && window.performance.navigation.type === 2 );
				if ( historyPath ) {
					window.location.reload();
				}
			});
			
			//check for fade out animation
			if (mkdf.body.hasClass('mkdf-smooth-page-transitions-fadeout')) {
				var linkItem = $('a');
				
				linkItem.on("click", function (e) {
					var a = $(this);

					if ((a.parents('.mkdf-shopping-cart-dropdown').length || a.parent('.product-remove').length) && a.hasClass('remove')) {
						return;
					}

					if (
						e.which === 1 && // check if the left mouse button has been pressed
						a.attr('href').indexOf(window.location.host) >= 0 && // check if the link is to the same domain
						(typeof a.data('rel') === 'undefined') && //Not pretty photo link
						(typeof a.attr('rel') === 'undefined') && //Not VC pretty photo link
                        (!a.hasClass('lightbox-active')) && //Not lightbox plugin active
						(typeof a.attr('target') === 'undefined' || a.attr('target') === '_self') && // check if the link opens in the same window
						(a.attr('href').split('#')[0] !== window.location.href.split('#')[0]) // check if it is an anchor aiming for a different page
					) {
						e.preventDefault();
						$('.mkdf-wrapper-inner').fadeOut(1000, function () {
							window.location = a.attr('href');
						});
					}
				});
			}
		}
	}
	
	/*
	 *	Preload background images for elements that have 'mkdf-preload-background' class
	 */
	function mkdfPreloadBackgrounds(){
		var preloadBackHolder = $('.mkdf-preload-background');
		
		if(preloadBackHolder.length) {
			preloadBackHolder.each(function() {
				var preloadBackground = $(this);
				
				if(preloadBackground.css('background-image') !== '' && preloadBackground.css('background-image') !== 'none') {
					var bgUrl = preloadBackground.attr('style');
					
					bgUrl = bgUrl.match(/url\(["']?([^'")]+)['"]?\)/);
					bgUrl = bgUrl ? bgUrl[1] : "";
					
					if (bgUrl) {
						var backImg = new Image();
						backImg.src = bgUrl;
						$(backImg).load(function(){
							preloadBackground.removeClass('mkdf-preload-background');
						});
					}
				} else {
					$(window).load(function(){ preloadBackground.removeClass('mkdf-preload-background'); }); //make sure that mkdf-preload-background class is removed from elements with forced background none in css
				}
			});
		}
	}
	
	function mkdfPrettyPhoto() {
		/*jshint multistr: true */
		var markupWhole = '<div class="pp_pic_holder"> \
                        <div class="ppt">&nbsp;</div> \
                        <div class="pp_top"> \
                            <div class="pp_left"></div> \
                            <div class="pp_middle"></div> \
                            <div class="pp_right"></div> \
                        </div> \
                        <div class="pp_content_container"> \
                            <div class="pp_left"> \
                            <div class="pp_right"> \
                                <div class="pp_content"> \
                                    <div class="pp_loaderIcon"></div> \
                                    <div class="pp_fade"> \
                                        <a href="#" class="pp_expand" title="Expand the image">Expand</a> \
                                        <div class="pp_hoverContainer"> \
                                            <a class="pp_next" href="#"><span class="fa fa-angle-right"></span></a> \
                                            <a class="pp_previous" href="#"><span class="fa fa-angle-left"></span></a> \
                                        </div> \
                                        <div id="pp_full_res"></div> \
                                        <div class="pp_details"> \
                                            <div class="pp_nav"> \
                                                <a href="#" class="pp_arrow_previous">Previous</a> \
                                                <p class="currentTextHolder">0/0</p> \
                                                <a href="#" class="pp_arrow_next">Next</a> \
                                            </div> \
                                            <p class="pp_description"></p> \
                                            {pp_social} \
                                            <a class="pp_close" href="#">Close</a> \
                                        </div> \
                                    </div> \
                                </div> \
                            </div> \
                            </div> \
                        </div> \
                        <div class="pp_bottom"> \
                            <div class="pp_left"></div> \
                            <div class="pp_middle"></div> \
                            <div class="pp_right"></div> \
                        </div> \
                    </div> \
                    <div class="pp_overlay"></div>';
		
		$("a[data-rel^='prettyPhoto']").prettyPhoto({
			hook: 'data-rel',
			animation_speed: 'normal', /* fast/slow/normal */
			slideshow: false, /* false OR interval time in ms */
			autoplay_slideshow: false, /* true/false */
			opacity: 0.80, /* Value between 0 and 1 */
			show_title: true, /* true/false */
			allow_resize: true, /* Resize the photos bigger than viewport. true/false */
			horizontal_padding: 0,
			default_width: 960,
			default_height: 540,
			counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
			theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
			hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
			wmode: 'opaque', /* Set the flash wmode attribute */
			autoplay: true, /* Automatically start videos: True/False */
			modal: false, /* If set to true, only the close button will close the window */
			overlay_gallery: false, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
			keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
			deeplinking: false,
			custom_markup: '',
			social_tools: false,
			markup: markupWhole
		});
	}

    function mkdfSearchPostTypeWidget() {
        var searchPostTypeHolder = $('.mkdf-search-post-type');

        if (searchPostTypeHolder.length) {
            searchPostTypeHolder.each(function () {
                var thisSearch = $(this),
                    searchField = thisSearch.find('.mkdf-post-type-search-field'),
                    resultsHolder = thisSearch.siblings('.mkdf-post-type-search-results'),
                    searchLoading = thisSearch.find('.mkdf-search-loading'),
                    searchIcon = thisSearch.find('.mkdf-search-icon');

                searchLoading.addClass('mkdf-hidden');

                var postType = thisSearch.data('post-type'),
                    keyPressTimeout;

                searchField.on('keyup paste', function() {
                    var field = $(this);
                    field.attr('autocomplete','off');
                    searchLoading.removeClass('mkdf-hidden');
                    searchIcon.addClass('mkdf-hidden');
                    clearTimeout(keyPressTimeout);

                    keyPressTimeout = setTimeout( function() {
                        var searchTerm = field.val();
                        
                        if(searchTerm.length < 3) {
                            resultsHolder.html('');
                            resultsHolder.fadeOut();
                            searchLoading.addClass('mkdf-hidden');
                            searchIcon.removeClass('mkdf-hidden');
                        } else {
                            var ajaxData = {
                                action: 'cocco_mikado_search_post_types',
                                term: searchTerm,
                                postType: postType
                            };

                            $.ajax({
                                type: 'POST',
                                data: ajaxData,
                                url: mkdfGlobalVars.vars.mkdfAjaxUrl,
                                success: function (data) {
                                    var response = JSON.parse(data);
                                    if (response.status === 'success') {
                                        searchLoading.addClass('mkdf-hidden');
                                        searchIcon.removeClass('mkdf-hidden');
                                        resultsHolder.html(response.data.html);
                                        resultsHolder.fadeIn();
                                    }
                                },
                                error: function(XMLHttpRequest, textStatus, errorThrown) {
                                    console.log("Status: " + textStatus);
                                    console.log("Error: " + errorThrown);
                                    searchLoading.addClass('mkdf-hidden');
                                    searchIcon.removeClass('mkdf-hidden');
                                    resultsHolder.fadeOut();
                                }
                            });
                        }
                    }, 500);
                });

                searchField.on('focusout', function () {
                    searchLoading.addClass('mkdf-hidden');
                    searchIcon.removeClass('mkdf-hidden');
                    resultsHolder.fadeOut();
                });
            });
        }
    }
	
	/**
	 * Initializes load more data params
	 * @param container with defined data params
	 * return array
	 */
	function getLoadMoreData(container){
		var dataList = container.data(),
			returnValue = {};
		
		for (var property in dataList) {
			if (dataList.hasOwnProperty(property)) {
				if (typeof dataList[property] !== 'undefined' && dataList[property] !== false) {
					returnValue[property] = dataList[property];
				}
			}
		}
		
		return returnValue;
	}
	
	/**
	 * Sets load more data params for ajax function
	 * @param container with defined data params
	 * @param action with defined action name
	 * return array
	 */
	function setLoadMoreAjaxData(container, action) {
		var returnValue = {
			action: action
		};
		
		for (var property in container) {
			if (container.hasOwnProperty(property)) {
				
				if (typeof container[property] !== 'undefined' && container[property] !== false) {
					returnValue[property] = container[property];
				}
			}
		}
		
		return returnValue;
	}

	/**
	 * Initializes size for fixed image proportion - masonry layout
	 */
	function setFixedImageProportionSize(container, item, size, isFixedEnabled) {
		if (container.hasClass('mkdf-masonry-images-fixed') || isFixedEnabled === true) {
			var padding = parseInt(item.css('paddingLeft'), 10),
				newSize = size - 2 * padding,
				defaultMasonryItem = container.find('.mkdf-masonry-size-small'),
				largeWidthMasonryItem = container.find('.mkdf-masonry-size-large-width'),
				largeHeightMasonryItem = container.find('.mkdf-masonry-size-large-height'),
				largeWidthHeightMasonryItem = container.find('.mkdf-masonry-size-large-width-height');

			defaultMasonryItem.css('height', newSize);
			largeHeightMasonryItem.css('height', Math.round(2 * (newSize + padding)));

			if (mkdf.windowWidth > 680) {
				largeWidthMasonryItem.css('height', newSize);
				largeWidthHeightMasonryItem.css('height', Math.round(2 * (newSize + padding)));
			} else {
				largeWidthMasonryItem.css('height', Math.round(newSize / 2));
				largeWidthHeightMasonryItem.css('height', newSize);
			}
		}
	}

	/**
	 * Object that represents icon with hover data
	 * @returns {{init: Function}} function that initializes icon's functionality
	 */
	var mkdfIconWithHover = function() {
		//get all icons on page
		var icons = $('.mkdf-icon-has-hover');
		
		/**
		 * Function that triggers icon hover color functionality
		 */
		var iconHoverColor = function(icon) {
			if(typeof icon.data('hover-color') !== 'undefined') {
				var changeIconColor = function(event) {
					event.data.icon.css('color', event.data.color);
				};
				
				var hoverColor = icon.data('hover-color'),
					originalColor = icon.css('color');
				
				if(hoverColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverColor}, changeIconColor);
					icon.on('mouseleave', {icon: icon, color: originalColor}, changeIconColor);
				}
			}
		};
		
		return {
			init: function() {
				if(icons.length) {
					icons.each(function() {
						iconHoverColor($(this));
					});
				}
			}
		};
	};
	
	/*
	 ** Init parallax
	 */
	function mkdfInitParallax(){
		var parallaxHolder = $('.mkdf-parallax-row-holder');
		
		if(parallaxHolder.length){
			parallaxHolder.each(function() {
				var parallaxElement = $(this),
					image = parallaxElement.data('parallax-bg-image'),
					speed = parallaxElement.data('parallax-bg-speed') * 0.4,
					height = 0;
				
				if (typeof parallaxElement.data('parallax-bg-height') !== 'undefined' && parallaxElement.data('parallax-bg-height') !== false) {
					height = parseInt(parallaxElement.data('parallax-bg-height'));
				}
				
				parallaxElement.css({'background-image': 'url('+image+')'});
				
				if(height > 0) {
					parallaxElement.css({'min-height': height+'px', 'height': height+'px'});
				}
				
				parallaxElement.parallax('50%', speed);
			});
		}
	}
	
	/*
	 **  Init sticky sidebar widget
	 */
	function mkdfStickySidebarWidget(){
		var sswHolder = $('.mkdf-widget-sticky-sidebar'),
			headerHolder = $('.mkdf-page-header'),
			headerHeight = headerHolder.length ? headerHolder.outerHeight() : 0,
			widgetTopOffset = 0,
			widgetTopPosition = 0,
			sidebarHeight = 0,
			sidebarWidth = 0,
			objectsCollection = [];
		
		function addObjectItems() {
			if (sswHolder.length) {
				sswHolder.each(function () {
					var thisSswHolder = $(this),
						mainSidebarHolder = thisSswHolder.parents('aside.mkdf-sidebar'),
						widgetiseSidebarHolder = thisSswHolder.parents('.wpb_widgetised_column'),
						sidebarHolder = '',
						sidebarHolderHeight = 0;
					
					widgetTopOffset = thisSswHolder.offset().top;
					widgetTopPosition = thisSswHolder.position().top;
					sidebarHeight = 0;
					sidebarWidth = 0;
					
					if (mainSidebarHolder.length) {
						sidebarHeight = mainSidebarHolder.outerHeight();
						sidebarWidth = mainSidebarHolder.outerWidth();
						sidebarHolder = mainSidebarHolder;
						sidebarHolderHeight = mainSidebarHolder.parent().parent().outerHeight();
						
						var blogHolder = mainSidebarHolder.parent().parent().find('.mkdf-blog-holder');
						if (blogHolder.length) {
							sidebarHolderHeight -= parseInt(blogHolder.css('marginBottom'));
						}
					} else if (widgetiseSidebarHolder.length) {
						sidebarHeight = widgetiseSidebarHolder.outerHeight();
						sidebarWidth = widgetiseSidebarHolder.outerWidth();
						sidebarHolder = widgetiseSidebarHolder;
						sidebarHolderHeight = widgetiseSidebarHolder.parents('.vc_row').outerHeight();
					}
					
					objectsCollection.push({
						'object': thisSswHolder,
						'offset': widgetTopOffset,
						'position': widgetTopPosition,
						'height': sidebarHeight,
						'width': sidebarWidth,
						'sidebarHolder': sidebarHolder,
						'sidebarHolderHeight': sidebarHolderHeight
					});
				});
			}
		}
		
		function initStickySidebarWidget() {
			
			if (objectsCollection.length) {
				$.each(objectsCollection, function (i) {
					var thisSswHolder = objectsCollection[i]['object'],
						thisWidgetTopOffset = objectsCollection[i]['offset'],
						thisWidgetTopPosition = objectsCollection[i]['position'],
						thisSidebarHeight = objectsCollection[i]['height'],
						thisSidebarWidth = objectsCollection[i]['width'],
						thisSidebarHolder = objectsCollection[i]['sidebarHolder'],
						thisSidebarHolderHeight = objectsCollection[i]['sidebarHolderHeight'];
					
					if (mkdf.body.hasClass('mkdf-fixed-on-scroll')) {
						var fixedHeader = $('.mkdf-fixed-wrapper.fixed');
						
						if (fixedHeader.length) {
							headerHeight = fixedHeader.outerHeight() + mkdfGlobalVars.vars.mkdfAddForAdminBar;
						}
					} else if (mkdf.body.hasClass('mkdf-no-behavior')) {
						headerHeight = mkdfGlobalVars.vars.mkdfAddForAdminBar;
					}
					
					if (mkdf.windowWidth > 1024 && thisSidebarHolder.length) {
						var sidebarPosition = -(thisWidgetTopPosition - headerHeight),
							sidebarHeight = thisSidebarHeight - thisWidgetTopPosition - 40; // 40 is bottom margin of widget holder
						
						//move sidebar up when hits the end of section row
						var rowSectionEndInViewport = thisSidebarHolderHeight + thisWidgetTopOffset - headerHeight - thisWidgetTopPosition - mkdfGlobalVars.vars.mkdfTopBarHeight;
						
						if ((mkdf.scroll >= thisWidgetTopOffset - headerHeight) && thisSidebarHeight < thisSidebarHolderHeight) {
							if (thisSidebarHolder.hasClass('mkdf-sticky-sidebar-appeared')) {
								thisSidebarHolder.css({'top': sidebarPosition + 'px'});
							} else {
								thisSidebarHolder.addClass('mkdf-sticky-sidebar-appeared').css({
									'position': 'fixed',
									'top': sidebarPosition + 'px',
									'width': thisSidebarWidth,
									'margin-top': '-10px'
								}).animate({'margin-top': '0'}, 200);
							}
							
							if (mkdf.scroll + sidebarHeight >= rowSectionEndInViewport) {
								var absBottomPosition = thisSidebarHolderHeight - sidebarHeight + sidebarPosition - headerHeight;
								
								thisSidebarHolder.css({
									'position': 'absolute',
									'top': absBottomPosition + 'px'
								});
							} else {
								if (thisSidebarHolder.hasClass('mkdf-sticky-sidebar-appeared')) {
									thisSidebarHolder.css({
										'position': 'fixed',
										'top': sidebarPosition + 'px'
									});
								}
							}
						} else {
							thisSidebarHolder.removeClass('mkdf-sticky-sidebar-appeared').css({
								'position': 'relative',
								'top': '0',
								'width': 'auto'
							});
						}
					} else {
						thisSidebarHolder.removeClass('mkdf-sticky-sidebar-appeared').css({
							'position': 'relative',
							'top': '0',
							'width': 'auto'
						});
					}
				});
			}
		}
		
		return {
			init: function () {
				addObjectItems();
				initStickySidebarWidget();
				
				$(window).scroll(function () {
					initStickySidebarWidget();
				});
			},
			reInit: initStickySidebarWidget
		};
	}

    /**
     * Init Owl Carousel
     */
    function mkdfOwlSlider() {
        var sliders = $('.mkdf-owl-slider');

        if (sliders.length) {
            sliders.each(function(){
                var slider = $(this),
                    owlSlider = $(this),
	                slideItemsNumber = slider.children().length,
	                numberOfItems = 1,
					numberOfRows = 1,
	                loop = true,
	                autoplay = true,
	                autoplayHoverPause = true,
	                sliderSpeed = 5000,
	                sliderSpeedAnimation = 600,
	                margin = 0,
	                responsiveMargin = 0,
	                responsiveMargin1 = 0,
	                stagePadding = 0,
	                stagePaddingEnabled = false,
	                center = false,
	                autoWidth = false,
	                animateInClass = false, // keyframe css animation
	                animateOutClass = false, // keyframe css animation
	                navigation = true,
	                pagination = false,
	                thumbnail = false,
                    thumbnailSlider,
	                sliderIsPortfolio = !!slider.hasClass('mkdf-pl-is-slider'),
	                sliderDataHolder = sliderIsPortfolio ? slider.parent() : slider;  // this is condition for portfolio slider

	            if (typeof slider.data('number-of-items') !== 'undefined' && slider.data('number-of-items') !== false && !sliderIsPortfolio) {
		            numberOfItems = slider.data('number-of-items');
	            }
	            if (typeof sliderDataHolder.data('number-of-columns') !== 'undefined' && sliderDataHolder.data('number-of-columns') !== false && sliderIsPortfolio) {
		            numberOfItems = sliderDataHolder.data('number-of-columns');
	            }
				if (typeof sliderDataHolder.data('number-of-rows') !== 'undefined' && sliderDataHolder.data('number-of-rows') !== false && sliderDataHolder.data('number-of-rows') != 1) {
					numberOfRows = sliderDataHolder.data('number-of-rows');

					var slides = slider.children();

					if (!slider.hasClass('owl-loaded')) {
						for (var i = 0; i <= slideItemsNumber; i = i + numberOfRows) {
							slides.slice(i, i + numberOfRows).wrapAll('<div class="mkdf-item-outer-holder" />');
						}
					}
				}
	            if (sliderDataHolder.data('enable-loop') === 'no') {
		            loop = false;
	            }
	            if (sliderDataHolder.data('enable-autoplay') === 'no') {
		            autoplay = false;
	            }
	            if (sliderDataHolder.data('enable-autoplay-hover-pause') === 'no') {
		            autoplayHoverPause = false;
	            }
	            if (typeof sliderDataHolder.data('slider-speed') !== 'undefined' && sliderDataHolder.data('slider-speed') !== false) {
		            sliderSpeed = sliderDataHolder.data('slider-speed');
	            }
	            if (typeof sliderDataHolder.data('slider-speed-animation') !== 'undefined' && sliderDataHolder.data('slider-speed-animation') !== false) {
		            sliderSpeedAnimation = sliderDataHolder.data('slider-speed-animation');
	            }
	            if (typeof sliderDataHolder.data('slider-margin') !== 'undefined' && sliderDataHolder.data('slider-margin') !== false) {
		            if (sliderDataHolder.data('slider-margin') === 'no') {
			            margin = 0;
		            } else {
			            margin = sliderDataHolder.data('slider-margin');
		            }
	            } else {
		            if(slider.parent().hasClass('mkdf-huge-space')) {
			            margin = 60;
		            } else if (slider.parent().hasClass('mkdf-large-space')) {
			            margin = 50;
		            } else if (slider.parent().hasClass('mkdf-medium-space')) {
			            margin = 40;
		            } else if (slider.parent().hasClass('mkdf-normal-space')) {
			            margin = 30;
		            } else if (slider.parent().hasClass('mkdf-small-space')) {
			            margin = 20;
		            } else if (slider.parent().hasClass('mkdf-tiny-space')) {
			            margin = 10;
		            }
	            }
	            if (sliderDataHolder.data('slider-padding') === 'yes') {
		            stagePaddingEnabled = true;
		            stagePadding = parseInt(slider.outerWidth() * 0.25);
		            // margin = 50;
	            }
	            if (sliderDataHolder.data('enable-center') === 'yes') {
		            center = true;
	            }
	            if (sliderDataHolder.data('enable-auto-width') === 'yes') {
		            autoWidth = true;
	            }
	            if (typeof sliderDataHolder.data('slider-animate-in') !== 'undefined' && sliderDataHolder.data('slider-animate-in') !== false) {
		            animateInClass = sliderDataHolder.data('slider-animate-in');
	            }
	            if (typeof sliderDataHolder.data('slider-animate-out') !== 'undefined' && sliderDataHolder.data('slider-animate-out') !== false) {
                    animateOutClass = sliderDataHolder.data('slider-animate-out');
	            }
	            if (sliderDataHolder.data('enable-navigation') === 'no') {
		            navigation = false;
	            }
	            if (sliderDataHolder.data('enable-pagination') === 'yes') {
		            pagination = true;
	            }

	            if (sliderDataHolder.data('enable-thumbnail') === 'yes') {
                    thumbnail = true;
	            }
	            
	            if(navigation && pagination) {
		            slider.addClass('mkdf-slider-has-both-nav');
	            }
	
	            if (slideItemsNumber <= 1) {
		            loop       = false;
		            autoplay   = false;
		            navigation = false;
		            pagination = false;
	            }
	
	            var responsiveNumberOfItems1 = 1,
		            responsiveNumberOfItems2 = 2,
		            responsiveNumberOfItems3 = 3,
		            responsiveNumberOfItems4 = numberOfItems;
	
	            if (numberOfItems < 3) {
		            responsiveNumberOfItems2 = numberOfItems;
		            responsiveNumberOfItems3 = numberOfItems;
	            }

				if (numberOfItems == 3) {
					responsiveNumberOfItems3 = 2;
				}
	
	            if (numberOfItems > 4) {
		            responsiveNumberOfItems4 = 4;
	            }
	
	            if (stagePaddingEnabled || margin > 30) {
		            responsiveMargin = 20;
		            responsiveMargin1 = 30;
	            }
	
	            if (margin > 0 && margin <= 30) {
		            responsiveMargin = margin;
		            responsiveMargin1 = margin;
	            }
	
	            slider.waitForImages(function () {
		            owlSlider = slider.owlCarousel({
			            items: numberOfItems,
			            loop: loop,
			            autoplay: autoplay,
			            autoplayHoverPause: autoplayHoverPause,
			            autoplayTimeout: sliderSpeed,
			            smartSpeed: sliderSpeedAnimation,
			            margin: margin,
			            stagePadding: stagePadding,
			            center: center,
			            autoWidth: autoWidth,
			            animateIn: animateInClass,
			            animateOut: animateOutClass,
			            dots: pagination,
			            nav: navigation,
			            navText: [
				            '<span class="mkdf-arrow-stack-outer"><span class="mkdf-arrow-stack"><span class="mkdf-arrow-stack-inner"><span class="mkdf-prev-icon dripicons-arrow-thin-left"></span></span></span></span>',
				            '<span class="mkdf-arrow-stack-outer"><span class="mkdf-arrow-stack"><span class="mkdf-arrow-stack-inner"><span class="mkdf-next-icon dripicons-arrow-thin-right"></span></span></span></span>'
			            ],
			            responsive: {
				            0: {
					            items: responsiveNumberOfItems1,
					            margin: responsiveMargin,
					            stagePadding: 0,
					            center: false,
					            autoWidth: false
				            },
				            681: {
					            items: responsiveNumberOfItems2,
					            margin: responsiveMargin1
				            },
				            769: {
					            items: responsiveNumberOfItems3,
					            margin: responsiveMargin1
				            },
				            1025: {
					            items: responsiveNumberOfItems4
				            },
				            1281: {
					            items: numberOfItems
				            }
			            },
			            onInitialize: function () {
				            slider.css('visibility', 'visible');
				            mkdfInitParallax();
                            if(thumbnail) {
                                thumbnailSlider.find('.mkdf-slider-thumbnail-item:first-child').addClass('active');
                            }
			            },
                        onTranslate: function(e) {
                            if(thumbnail) {
                                var index = e.item.index + 1;
                                thumbnailSlider.find('.mkdf-slider-thumbnail-item.active').removeClass('active');
                                thumbnailSlider.find('.mkdf-slider-thumbnail-item:nth-child(' + index + ')').addClass('active');
                            }
                        },
			            onDrag: function (e) {
				            if (mkdf.body.hasClass('mkdf-smooth-page-transitions-fadeout')) {
					            var sliderIsMoving = e.isTrigger > 0;
					
					            if (sliderIsMoving) {
						            slider.addClass('mkdf-slider-is-moving');
					            }
				            }
			            },
			            onDragged: function () {
				            if (mkdf.body.hasClass('mkdf-smooth-page-transitions-fadeout') && slider.hasClass('mkdf-slider-is-moving')) {
					
					            setTimeout(function () {
						            slider.removeClass('mkdf-slider-is-moving');
					            }, 500);
				            }
			            }
		            });
	            });

                if(thumbnail) {
                    thumbnailSlider = slider.parent().find('.mkdf-slider-thumbnail');

                    var numberOfThumbnails = parseInt(thumbnailSlider.data('thumbnail-count'));
                    var numberOfThumbnailsClass = '';

                    switch (numberOfThumbnails % 6) {
                        case 2 :
                            numberOfThumbnailsClass = 'two';
                            break;
                        case 3 :
                            numberOfThumbnailsClass = 'three';
                            break;
                        case 4 :
                            numberOfThumbnailsClass = 'four';
                            break;
                        case 5 :
                            numberOfThumbnailsClass = 'five';
                            break;
                        case 0 :
                            numberOfThumbnailsClass = 'six';
                            break;
                        default :
                            numberOfThumbnailsClass = 'six';
                            break;
                    }

                    if(numberOfThumbnailsClass !== '') {
                        thumbnailSlider.addClass('mkdf-slider-columns-' + numberOfThumbnailsClass)
                    }

                    thumbnailSlider.find('.mkdf-slider-thumbnail-item').on("click", function () {
                        $(this).siblings('.active').removeClass('active');
                        $(this).addClass('active');
                        owlSlider.trigger('to.owl.carousel', [$(this).index(), sliderSpeedAnimation]);
                    });
                }


            });
        }


    }


    function mkdfDashboardForm(){
        var forms = $('.mkdf-dashboard-form');

        if ( forms.length ) {
        	forms.each(function(){
        		var thisForm = $(this),
	                btnText = thisForm.find('button'),
	                updatingBtnText = btnText.data('updating-text'),
	                updatedBtnText = btnText.data('updated-text'),
	                actionName = thisForm.data('action');

	            thisForm.on('submit', function (e) {
	                e.preventDefault();
	                var prevBtnText = btnText.html(),
	                	gallery = $(this).find('.mkdf-dashboard-gallery-upload-hidden'),
	                	namesArray = [],
	                	action = '';

	                btnText.html(updatingBtnText);

	                //get data
	                var formData = new FormData();

	                //get files
	                gallery.each(function(){
	                	var thisGallery = $(this),
	                		thisName = thisGallery.attr('name'),
	                		thisRepeaterID = thisGallery.attr('id'),
	                		thisFiles = thisGallery[0].files,
	                		newName;

	                	//this part is needed for repeater with image uploads
	                	//adding specific names so they can be sorted in regular files and files in repeater
	            		if (thisName.indexOf("[") != "-1") {
	            			newName = thisName.substring(0,thisName.indexOf("["))+'_mkdf_regarray_';

	            			var firstIndex = thisRepeaterID.indexOf('[');
	            			var lastIndex = thisRepeaterID.indexOf(']');
	            			var index = thisRepeaterID.substring(firstIndex+1,lastIndex);

	            			namesArray.push(newName);
	            			newName = newName + index + '_';
	            		} else {
	            			newName = thisName + '_mkdf_reg_';
	            		}

	            		//if file not sent, send dummy file - so repeater fields are sent
	            		if (thisFiles.length == 0){
	            			formData.append(newName, new File([""], "mkdf-dummy-file.txt", {
								type: "text/plain",
							}));
	            		}

	                	for (var i = 0; i < thisFiles.length; i++) {
							var allowedTypes = ['image/png','image/jpg','image/jpeg','application/pdf'];
							//security purposed - check if there is more than one dot in file name, also check whether the file type is in allowed types
							if (thisFiles[i].name.match(/\./g).length == 1 && $.inArray(thisFiles[i].type, allowedTypes) !== -1) {
								formData.append(newName + i, thisFiles[i]);
							}
	                	};
	                });

					formData.append('action', actionName);
	                
					//get data from form
					var otherData = $(this).serialize();
					formData.append('data',otherData);

	                $.ajax({
	                    type: 'POST',
	                    data: formData,
				        contentType: false,
				        processData: false,
	                    url: mkdfGlobalVars.vars.mkdfAjaxUrl,
	                    success: function (data) {
	                        var response;
	                        response = JSON.parse(data);

	                        // append ajax response html
	                        mkdf.modules.socialLogin.mkdfRenderAjaxResponseMessage(response);
	                        if (response.status == 'success') {
	                            btnText.html(updatedBtnText);
	                        	window.location = response.redirect;
	                        } else {
	                            btnText.html(prevBtnText);
	                        }
	                    }
	                });
	                return false;
	            });
			});
        }
    }

})(jQuery);
(function ($) {
	"use strict";
	
	var footer = {};
    mkdf.modules.footer = footer;
	
	footer.mkdfOnWindowLoad = mkdfOnWindowLoad;
	
	$(window).load(mkdfOnWindowLoad);
	
	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	 
	function mkdfOnWindowLoad() {
		uncoveringFooter();
	}
	
	function uncoveringFooter() {
		var uncoverFooter = $('body:not(.error404) .mkdf-footer-uncover');

		if (uncoverFooter.length && !mkdf.htmlEl.hasClass('touch')) {

			var footer = $('footer'),
				footerHeight = footer.outerHeight(),
				content = $('.mkdf-content');
			
			var uncoveringCalcs = function () {
				content.css('margin-bottom', footerHeight);
				footer.css('height', footerHeight);
			};


			//set
			uncoveringCalcs();
			
			$(window).resize(function () {
				//recalc
				footerHeight = footer.find('.mkdf-footer-inner').outerHeight();
				uncoveringCalcs();
			});
		}
	}
	
})(jQuery);
(function($) {
	"use strict";
	
	var header = {};
	mkdf.modules.header = header;
	
	header.mkdfSetDropDownMenuPosition     = mkdfSetDropDownMenuPosition;
	header.mkdfSetDropDownWideMenuPosition = mkdfSetDropDownWideMenuPosition;
	
	header.mkdfOnDocumentReady = mkdfOnDocumentReady;
	header.mkdfOnWindowLoad = mkdfOnWindowLoad;
	
	$(document).ready(mkdfOnDocumentReady);
	$(window).load(mkdfOnWindowLoad);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
		mkdfSetDropDownMenuPosition();
		setTimeout(function(){
			mkdfDropDownMenu();
		}, 100);
	}
	
	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	function mkdfOnWindowLoad() {
		mkdfSetDropDownWideMenuPosition();
	}
	
	/**
	 * Set dropdown position
	 */
	function mkdfSetDropDownMenuPosition() {
		var menuItems = $('.mkdf-drop-down > ul > li.narrow.menu-item-has-children');
		
		if (menuItems.length) {
			menuItems.each(function (i) {
				var thisItem = $(this),
					menuItemPosition = thisItem.offset().left,
					dropdownHolder = thisItem.find('.second'),
					dropdownMenuItem = dropdownHolder.find('.inner ul'),
					dropdownMenuWidth = dropdownMenuItem.outerWidth(),
					menuItemFromLeft = mkdf.windowWidth - menuItemPosition;
				
				if (mkdf.body.hasClass('mkdf-boxed')) {
					menuItemFromLeft = mkdf.boxedLayoutWidth - (menuItemPosition - (mkdf.windowWidth - mkdf.boxedLayoutWidth ) / 2);
				}
				
				var dropDownMenuFromLeft; //has to stay undefined because 'dropDownMenuFromLeft < dropdownMenuWidth' conditional will be true
				
				if (thisItem.find('li.sub').length > 0) {
					dropDownMenuFromLeft = menuItemFromLeft - dropdownMenuWidth;
				}
				
				dropdownHolder.removeClass('right');
				dropdownMenuItem.removeClass('right');
				if (menuItemFromLeft < dropdownMenuWidth || dropDownMenuFromLeft < dropdownMenuWidth) {
					dropdownHolder.addClass('right');
					dropdownMenuItem.addClass('right');
				}
			});
		}
	}
	
	/**
	 * Set dropdown wide position
	 */
	function mkdfSetDropDownWideMenuPosition(){
		var menuItems = $(".mkdf-drop-down > ul > li.wide");
		
		if(menuItems.length) {
			menuItems.each( function(i) {
				var thisMenuItem = $(this),
					menuItemSubMenu = $(menuItems[i]).find('.second');

				if(menuItemSubMenu.length && !thisMenuItem.hasClass('left_position') && !thisMenuItem.hasClass('right_position')) {
					if (thisMenuItem.hasClass('mkdf-wide-menu-full-width') || thisMenuItem.hasClass('mkdf-wide-menu-in-grid')){
						menuItemSubMenu.css('left', 0);
						var leftPosition,
							secondLevelWidth;

						if(mkdf.body.hasClass('mkdf-boxed')) {
							var boxedWidth = $('.mkdf-boxed .mkdf-wrapper .mkdf-wrapper-inner').outerWidth();
							leftPosition = menuItemSubMenu.offset().left - (mkdf.windowWidth - boxedWidth) / 2;

							menuItemSubMenu.css({'left': -leftPosition, 'width': boxedWidth});
						} else {

							//if full width wide menu, else if grid wide menu
							if (thisMenuItem.hasClass('mkdf-wide-menu-full-width')) {
								secondLevelWidth = mkdf.windowWidth;
								leftPosition = menuItemSubMenu.offset().left;
							} else {
								secondLevelWidth = menuItemSubMenu.find('.inner>ul').outerWidth();
								leftPosition = menuItemSubMenu.offset().left - (mkdf.windowWidth - secondLevelWidth) / 2;
							}
							menuItemSubMenu.css({'left': -leftPosition, 'width': secondLevelWidth});
						}
					} else if (thisMenuItem.hasClass('mkdf-wide-menu-centered')){
						var leftPosition = menuItemSubMenu.offset().left,
							secondLevelWidth = menuItemSubMenu.find('.inner>ul').outerWidth(),
							newPosition = leftPosition - secondLevelWidth/2 + thisMenuItem.outerWidth()/2,
							newCalculatedPosition;

						//if newPosition is too far on the left or too far on the right
						if (newPosition <= 40) {
							newCalculatedPosition = 40 - leftPosition;
						} else if (newPosition + secondLevelWidth > mkdf.windowWidth - 40) {
							newCalculatedPosition = mkdf.windowWidth - 40 - leftPosition - secondLevelWidth;
						} else {
							newCalculatedPosition = - secondLevelWidth/2 + thisMenuItem.outerWidth()/2;
						}

						menuItemSubMenu.css({'left': newCalculatedPosition});
					}
				}
			});
		}
	}
	
	function mkdfDropDownMenu() {
		var menu_items = $('.mkdf-drop-down > ul > li');

		menu_items.each(function() {
			var thisItem = $(this);

			if(thisItem.find('.second').length) {
				thisItem.waitForImages(function(){
					var dropDownHolder = thisItem.find('.second'),
						dropDownHolderHeight = !mkdf.menuDropdownHeightSet ? dropDownHolder.outerHeight() : 0;

					if(thisItem.hasClass('wide')) {
						var tallest = 0,
							dropDownSecondItem = dropDownHolder.find('> .inner > ul > li');

						dropDownSecondItem.each(function() {
							var thisHeight = $(this).outerHeight();

							if(thisHeight > tallest) {
								tallest = thisHeight;
							}
						});

						dropDownSecondItem.css('height', '').height(tallest);

						if (!mkdf.menuDropdownHeightSet) {
							dropDownHolderHeight = dropDownHolder.outerHeight();
						}
					}

					if (!mkdf.menuDropdownHeightSet) {
						dropDownHolder.height(0);
					}

					if(navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
						thisItem.on("touchstart mouseenter", function() {
							dropDownHolder.css({
								'height': dropDownHolderHeight,
								'overflow': 'visible',
								'visibility': 'visible',
								'opacity': '1'
							});
						}).on("mouseleave", function() {
							dropDownHolder.css({
								'height': '0px',
								'overflow': 'hidden',
								'visibility': 'hidden',
								'opacity': '0'
							});
						});
					} else {
						if (mkdf.body.hasClass('mkdf-dropdown-animate-height')) {
							var animateConfig = {
								interval: 0,
								over: function () {
									setTimeout(function () {
										dropDownHolder.addClass('mkdf-drop-down-start').css({
											'visibility': 'visible',
											'height': '0',
											'opacity': '1'
										});
										dropDownHolder.stop().animate({
											'height': dropDownHolderHeight
										}, 400, 'easeInOutQuint', function () {
											dropDownHolder.css('overflow', 'visible');
										});
									}, 100);
								},
								timeout: 100,
								out: function () {
									dropDownHolder.stop().animate({
										'height': '0',
										'opacity': 0
									}, 100, function () {
										dropDownHolder.css({
											'overflow': 'hidden',
											'visibility': 'hidden'
										});
									});

									dropDownHolder.removeClass('mkdf-drop-down-start');
								}
							};

							thisItem.hoverIntent(animateConfig);
						} else {
							var config = {
								interval: 0,
								over: function () {
									setTimeout(function () {
										dropDownHolder.addClass('mkdf-drop-down-start').stop().css({'height': dropDownHolderHeight});
									}, 150);
								},
								timeout: 150,
								out: function () {
									dropDownHolder.stop().css({'height': '0'}).removeClass('mkdf-drop-down-start');
								}
							};

							thisItem.hoverIntent(config);
						}
					}
				});
			}
		});
		
		$('.mkdf-drop-down ul li.wide ul li a').on('click', function(e) {
			if (e.which === 1){
				var $this = $(this);
				
				setTimeout(function() {
					$this.mouseleave();
				}, 500);
			}
		});
		
		mkdf.menuDropdownHeightSet = true;
	}
	
})(jQuery);
(function($) {
	"use strict";

    var blog = {};
    mkdf.modules.blog = blog;

    blog.mkdfOnDocumentReady = mkdfOnDocumentReady;
    blog.mkdfOnWindowLoad = mkdfOnWindowLoad;
    blog.mkdfOnWindowResize = mkdfOnWindowResize;
    blog.mkdfOnWindowScroll = mkdfOnWindowScroll;

    $(document).ready(mkdfOnDocumentReady);
	$(window).on('load', function(){
		mkdfOnWindowLoad();
	});
    $(window).resize(mkdfOnWindowResize);
    $(window).scroll(mkdfOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function mkdfOnDocumentReady() {
        mkdfInitAudioPlayer();
        mkdfInitBlogMasonry();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function mkdfOnWindowLoad() {
	    mkdfInitBlogPagination().init();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function mkdfOnWindowResize() {
        mkdfInitBlogMasonry();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function mkdfOnWindowScroll() {
	    mkdfInitBlogPagination().scroll();
    }

    /**
    * Init audio player for Blog list and single pages
    */
    function mkdfInitAudioPlayer() {
	    var players = $('audio.mkdf-blog-audio');
	
	    if (players.length) {
		    players.mediaelementplayer({
			    audioWidth: '100%'
		    });
	    }
    }

    /**
    * Init Blog Masonry Layout
    */
    function mkdfInitBlogMasonry() {
	    var holder = $('.mkdf-blog-holder.mkdf-blog-type-masonry');
	
	    if(holder.length){
		    holder.each(function(){
			    var thisHolder = $(this),
				    masonry = thisHolder.children('.mkdf-blog-holder-inner'),
                    size = thisHolder.find('.mkdf-blog-masonry-grid-sizer').width();
                
			    masonry.waitForImages(function() {
				    masonry.isotope({
					    layoutMode: 'packery',
					    itemSelector: 'article',
					    percentPosition: true,
					    packery: {
						    gutter: '.mkdf-blog-masonry-grid-gutter',
						    columnWidth: '.mkdf-blog-masonry-grid-sizer'
					    }
				    });

					mkdf.modules.common.setFixedImageProportionSize(thisHolder, thisHolder.find('article'), size);

					masonry.isotope('layout').css('opacity', '1');
                });
		    });
	    }
    }
	
	/**
	 * Initializes blog pagination functions
	 */
	function mkdfInitBlogPagination(){
		var holder = $('.mkdf-blog-holder');
		
		var initLoadMorePagination = function(thisHolder) {
			var loadMoreButton = thisHolder.find('.mkdf-blog-pag-load-more a');
			
			loadMoreButton.on('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
				
				initMainPagFunctionality(thisHolder);
			});
		};
		
		var initInifiteScrollPagination = function(thisHolder) {
			var blogListHeight = thisHolder.outerHeight(),
				blogListTopOffest = thisHolder.offset().top,
				blogListPosition = blogListHeight + blogListTopOffest - mkdfGlobalVars.vars.mkdfAddForAdminBar;
			
			if(!thisHolder.hasClass('mkdf-blog-pagination-infinite-scroll-started') && mkdf.scroll + mkdf.windowHeight > blogListPosition) {
				initMainPagFunctionality(thisHolder);
			}
		};
		
		var initMainPagFunctionality = function(thisHolder) {
			var thisHolderInner = thisHolder.children('.mkdf-blog-holder-inner'),
				nextPage,
				maxNumPages;
			
			if (typeof thisHolder.data('max-num-pages') !== 'undefined' && thisHolder.data('max-num-pages') !== false) {
				maxNumPages = thisHolder.data('max-num-pages');
			}
			
			if(thisHolder.hasClass('mkdf-blog-pagination-infinite-scroll')) {
				thisHolder.addClass('mkdf-blog-pagination-infinite-scroll-started');
			}
			
			var loadMoreDatta = mkdf.modules.common.getLoadMoreData(thisHolder),
				loadingItem = thisHolder.find('.mkdf-blog-pag-loading');
			
			nextPage = loadMoreDatta.nextPage;
			
			if(nextPage <= maxNumPages){
				loadingItem.addClass('mkdf-showing');
				
				var ajaxData = mkdf.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'cocco_mikado_blog_load_more');
				
				$.ajax({
					type: 'POST',
					data: ajaxData,
					url: mkdfGlobalVars.vars.mkdfAjaxUrl,
					success: function (data) {
						nextPage++;
						
						thisHolder.data('next-page', nextPage);

						var response = $.parseJSON(data),
							responseHtml =  response.html;

						thisHolder.waitForImages(function(){
							if(thisHolder.hasClass('mkdf-blog-type-masonry')){
								mkdfInitAppendIsotopeNewContent(thisHolderInner, loadingItem, responseHtml);
								mkdf.modules.common.setFixedImageProportionSize(thisHolder, thisHolder.find('article'), size);
							} else {
								mkdfInitAppendGalleryNewContent(thisHolderInner, loadingItem, responseHtml);
							}
							
							setTimeout(function() {
								mkdfInitAudioPlayer();
								mkdf.modules.common.mkdfOwlSlider();
								mkdf.modules.common.mkdfFluidVideo();
                                mkdf.modules.common.mkdfInitSelfHostedVideoPlayer();
                                mkdf.modules.common.mkdfSelfHostedVideoSize();
								
								if (typeof mkdf.modules.common.mkdfStickySidebarWidget === 'function') {
									mkdf.modules.common.mkdfStickySidebarWidget().reInit();
								}

                                // Trigger event.
                                $( document.body ).trigger( 'blog_list_load_more_trigger' );

							}, 400);
						});
						
						if(thisHolder.hasClass('mkdf-blog-pagination-infinite-scroll-started')) {
							thisHolder.removeClass('mkdf-blog-pagination-infinite-scroll-started');
						}
					}
				});
			}
			
			if(nextPage === maxNumPages){
				thisHolder.find('.mkdf-blog-pag-load-more').hide();
			}
		};
		
		var mkdfInitAppendIsotopeNewContent = function(thisHolderInner, loadingItem, responseHtml) {
			thisHolderInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('mkdf-showing');
			
			setTimeout(function() {
				thisHolderInner.isotope('layout');
			}, 600);
		};
		
		var mkdfInitAppendGalleryNewContent = function(thisHolderInner, loadingItem, responseHtml) {
			loadingItem.removeClass('mkdf-showing');
			thisHolderInner.append(responseHtml);
		};
		
		return {
			init: function() {
				if(holder.length) {
					holder.each(function() {
						var thisHolder = $(this);
						
						if(thisHolder.hasClass('mkdf-blog-pagination-load-more')) {
							initLoadMorePagination(thisHolder);
						}
						
						if(thisHolder.hasClass('mkdf-blog-pagination-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			},
			scroll: function() {
				if(holder.length) {
					holder.each(function() {
						var thisHolder = $(this);
						
						if(thisHolder.hasClass('mkdf-blog-pagination-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			}
		};
	}

})(jQuery);
(function($) {
    'use strict';

    var like = {};
    
    like.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
    
    /**
    *  All functions to be called on $(document).ready() should be in this function
    **/
    function mkdfOnDocumentReady() {
        mkdfLikes();
    }

    function mkdfLikes() {
        $(document).on('click','.mkdf-like', function() {
            var likeLink = $(this),
                id = likeLink.attr('id'),
                type;

            if ( likeLink.hasClass('liked') ) {
                return false;
            }

            if (typeof likeLink.data('type') !== 'undefined') {
                type = likeLink.data('type');
            }

            var dataToPass = {
                action: 'cocco_mikado_like',
                likes_id: id,
                type: type
            };

            var like = $.post(mkdfGlobalVars.vars.mkdfAjaxUrl, dataToPass, function( data ) {
                likeLink.html(data).addClass('liked').attr('title', 'You already like this!');
            });

            return false;
        });
    }
    
})(jQuery);
(function($) {
    "use strict";

    var sidearea = {};
    mkdf.modules.sidearea = sidearea;

    sidearea.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function mkdfOnDocumentReady() {
	    mkdfSideArea();
	    mkdfSideAreaScroll();
    }
	
	/**
	 * Show/hide side area
	 */
    function mkdfSideArea() {

        var wrapper = $('.mkdf-wrapper'),
            sideMenu = $('.mkdf-side-menu'),
            sideMenuButtonOpen = $('a.mkdf-side-menu-button-opener'),
            cssClass,
            //Flags
            slideFromRight = false,
            slideWithContent = false,
            slideUncovered = false;

        if (mkdf.body.hasClass('mkdf-side-menu-slide-from-right')) {
            $('.mkdf-cover').remove();
            cssClass = 'mkdf-right-side-menu-opened';
            wrapper.prepend('<div class="mkdf-cover"/>');
            slideFromRight = true;
        } else if (mkdf.body.hasClass('mkdf-side-menu-slide-with-content')) {
            cssClass = 'mkdf-side-menu-open';
            slideWithContent = true;
        } else if (mkdf.body.hasClass('mkdf-side-area-uncovered-from-content')) {
            cssClass = 'mkdf-right-side-menu-opened';
            slideUncovered = true;
        }

        $('a.mkdf-side-menu-button-opener, a.mkdf-close-side-menu').on("click", function(e) {
            e.preventDefault();

            if(!sideMenuButtonOpen.hasClass('opened')) {

                sideMenuButtonOpen.addClass('opened');
                mkdf.body.addClass(cssClass);

                if (slideFromRight) {
                    $('.mkdf-wrapper .mkdf-cover').on("click", function() {
                        mkdf.body.removeClass('mkdf-right-side-menu-opened');
                        sideMenuButtonOpen.removeClass('opened');
                    });
                }

                if (slideUncovered) {
                    sideMenu.css({
                        'visibility' : 'visible'
                    });
                }

                var currentScroll = $(window).scrollTop();
                $(window).scroll(function() {
                    if(Math.abs(mkdf.scroll - currentScroll) > 400){
                        mkdf.body.removeClass(cssClass);
                        sideMenuButtonOpen.removeClass('opened');
                        if (slideUncovered) {
                            var hideSideMenu = setTimeout(function(){
                                sideMenu.css({'visibility':'hidden'});
                                clearTimeout(hideSideMenu);
                            },400);
                        }
                    }
                });

            } else {

                sideMenuButtonOpen.removeClass('opened');
                mkdf.body.removeClass(cssClass);
                if (slideUncovered) {
                    var hideSideMenu = setTimeout(function(){
                        sideMenu.css({'visibility':'hidden'});
                        clearTimeout(hideSideMenu);
                    },400);
                }

            }

            if (slideWithContent) {

                e.stopPropagation();
                wrapper.on("click", function() {
                    e.preventDefault();
                    sideMenuButtonOpen.removeClass('opened');
                    mkdf.body.removeClass('mkdf-side-menu-open');
                });

            }

        });

    }
	
	/*
	 **  Smooth scroll functionality for Side Area
	 */
	function mkdfSideAreaScroll(){
		var sideMenu = $('.mkdf-side-menu');
		
		if(sideMenu.length){
            sideMenu.perfectScrollbar({
                wheelSpeed: 0.6,
                suppressScrollX: true
            });
		}
	}

})(jQuery);

(function($) {
    "use strict";

    var title = {};
    mkdf.modules.title = title;

    title.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function mkdfOnDocumentReady() {
	    mkdfParallaxTitle();
    }

    /*
     **	Title image with parallax effect
     */
	function mkdfParallaxTitle() {
		var parallaxBackground = $('.mkdf-title-holder.mkdf-bg-parallax');
		
		if (parallaxBackground.length > 0 && mkdf.windowWidth > 1024) {
			var parallaxBackgroundWithZoomOut = parallaxBackground.hasClass('mkdf-bg-parallax-zoom-out'),
				titleHeight = parseInt(parallaxBackground.data('height')),
				imageWidth = parseInt(parallaxBackground.data('background-width')),
				parallaxRate = titleHeight / 10000 * 7,
				parallaxYPos = -(mkdf.scroll * parallaxRate),
				adminBarHeight = mkdfGlobalVars.vars.mkdfAddForAdminBar;
			
			parallaxBackground.css({'background-position': 'center ' + (parallaxYPos + adminBarHeight) + 'px'});
			
			if (parallaxBackgroundWithZoomOut) {
				parallaxBackground.css({'background-size': imageWidth - mkdf.scroll + 'px auto'});
			}
			
			//set position of background on window scroll
			$(window).scroll(function () {
				parallaxYPos = -(mkdf.scroll * parallaxRate);
				parallaxBackground.css({'background-position': 'center ' + (parallaxYPos + adminBarHeight) + 'px'});
				
				if (parallaxBackgroundWithZoomOut) {
					parallaxBackground.css({'background-size': imageWidth - mkdf.scroll + 'px auto'});
				}
			});
		}
	}

})(jQuery);

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
(function ($) {
	"use strict";
	
	var popup = {};
	mkdf.modules.popup = popup;
	
	popup.mkdfOnWindowLoad = mkdfOnWindowLoad;
	
	$(window).load(mkdfOnWindowLoad);
	
	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	function mkdfOnWindowLoad() {
		mkdfPopup();
	}
	
	function mkdfPopup() {
		var popupOpener = $('.mkdf-popup-holder'),
			popupClose = $('.mkdf-popup-close');
		
		if (popupOpener.length) {
			var popupPreventHolder = popupOpener.find('.mkdf-popup-prevent'),
				disabledPopup = 'no';
			
			if (popupPreventHolder.length) {
				var isLocalStorage = popupOpener.hasClass('mkdf-popup-prevent-cookies'),
					popupPreventInput = popupPreventHolder.find('.mkdf-popup-prevent-input'),
					preventValue = popupPreventInput.data('value');
				
				if (isLocalStorage) {
					disabledPopup = localStorage.getItem('disabledPopup');
					sessionStorage.removeItem('disabledPopup');
				} else {
					disabledPopup = sessionStorage.getItem('disabledPopup');
					localStorage.removeItem('disabledPopup');
				}
				
				popupPreventHolder.children().on('click', function (e) {
					if ( preventValue !== 'yes' ) {
						preventValue = 'yes';
						popupPreventInput.addClass('mkdf-popup-prevent-clicked').data('value', 'yes');
					} else {
						preventValue = 'no';
						popupPreventInput.removeClass('mkdf-popup-prevent-clicked').data('value', 'no');
					}
					
					if (preventValue === 'yes') {
						if (isLocalStorage) {
							localStorage.setItem('disabledPopup', 'yes');
						} else {
							sessionStorage.setItem('disabledPopup', 'yes');
						}
					} else {
						if (isLocalStorage) {
							localStorage.setItem('disabledPopup', 'no');
						} else {
							sessionStorage.setItem('disabledPopup', 'no');
						}
					}
				});
			}
			
			if (disabledPopup !== 'yes') {
				if (mkdf.body.hasClass('mkdf-popup-opened')) {
					mkdf.body.removeClass('mkdf-popup-opened');
					
					if (!mkdf.body.hasClass('page-template-full_screen-php')) {
						mkdf.modules.common.mkdfEnableScroll();
					}
				} else {
					mkdf.body.addClass('mkdf-popup-opened');
					if (!mkdf.body.hasClass('page-template-full_screen-php')) {
						mkdf.modules.common.mkdfDisableScroll();
					}
				}
				
				popupClose.on('click', function (e) {
					e.preventDefault();
					
					mkdf.body.removeClass('mkdf-popup-opened');
					
					if (!mkdf.body.hasClass('page-template-full_screen-php')) {
						mkdf.modules.common.mkdfEnableScroll();
					}
				});
				
				//Close on escape
				$(document).keyup(function (e) {
					if (e.keyCode === 27) { //KeyCode for ESC button is 27
						mkdf.body.removeClass('mkdf-popup-opened');
						
						if (!mkdf.body.hasClass('page-template-full_screen-php')) {
							mkdf.modules.common.mkdfEnableScroll();
						}
					}
				});
			}
		}
	}
	
})(jQuery);
(function($) {
    "use strict";

    var blogListSC = {};
    mkdf.modules.blogListSC = blogListSC;

    blogListSC.mkdfOnDocumentReady = mkdfOnDocumentReady;
    blogListSC.mkdfOnWindowLoad = mkdfOnWindowLoad;
    blogListSC.mkdfOnWindowScroll = mkdfOnWindowScroll;

    $(document).ready(mkdfOnDocumentReady);
    $(window).on('load', function(){
        mkdfOnWindowLoad();
    });
    $(window).scroll(mkdfOnWindowScroll);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitBlogListMasonry();
    }

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function mkdfOnWindowLoad() {
        mkdfInitBlogListShortcodePagination().init();
    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function mkdfOnWindowScroll() {
        mkdfInitBlogListShortcodePagination().scroll();
    }

    /**
     * Init blog list shortcode masonry layout
     */
    function mkdfInitBlogListMasonry() {
        var holder = $('.mkdf-blog-list-holder.mkdf-bl-masonry');

        if(holder.length){
            holder.each(function(){
                var thisHolder = $(this),
                    masonry = thisHolder.find('.mkdf-blog-list');

                masonry.waitForImages(function() {
                    masonry.isotope({
                        layoutMode: 'packery',
                        itemSelector: '.mkdf-bl-item',
                        percentPosition: true,
                        packery: {
                            gutter: '.mkdf-bl-grid-gutter',
                            columnWidth: '.mkdf-bl-grid-sizer'
                        }
                    });

                    masonry.css('opacity', '1');
                });
            });
        }
    }

    /**
     * Init blog list shortcode pagination functions
     */
    function mkdfInitBlogListShortcodePagination(){
        var holder = $('.mkdf-blog-list-holder');

        var initStandardPagination = function(thisHolder) {
            var standardLink = thisHolder.find('.mkdf-bl-standard-pagination li');

            if(standardLink.length) {
                standardLink.each(function(){
                    var thisLink = $(this).children('a'),
                        pagedLink = 1;

                    thisLink.on('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();

                        if (typeof thisLink.data('paged') !== 'undefined' && thisLink.data('paged') !== false) {
                            pagedLink = thisLink.data('paged');
                        }

                        initMainPagFunctionality(thisHolder, pagedLink);
                    });
                });
            }
        };

        var initLoadMorePagination = function(thisHolder) {
            var loadMoreButton = thisHolder.find('.mkdf-blog-pag-load-more a');

            loadMoreButton.on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                initMainPagFunctionality(thisHolder);
            });
        };

        var initInifiteScrollPagination = function(thisHolder) {
            var blogListHeight = thisHolder.outerHeight(),
                blogListTopOffest = thisHolder.offset().top,
                blogListPosition = blogListHeight + blogListTopOffest - mkdfGlobalVars.vars.mkdfAddForAdminBar;

            if(!thisHolder.hasClass('mkdf-bl-pag-infinite-scroll-started') && mkdf.scroll + mkdf.windowHeight > blogListPosition) {
                initMainPagFunctionality(thisHolder);
            }
        };

        var initMainPagFunctionality = function(thisHolder, pagedLink) {
            var thisHolderInner = thisHolder.find('.mkdf-blog-list'),
                nextPage,
                maxNumPages;

            if (typeof thisHolder.data('max-num-pages') !== 'undefined' && thisHolder.data('max-num-pages') !== false) {
                maxNumPages = thisHolder.data('max-num-pages');
            }

            if(thisHolder.hasClass('mkdf-bl-pag-standard-shortcodes')) {
                thisHolder.data('next-page', pagedLink);
            }

            if(thisHolder.hasClass('mkdf-bl-pag-infinite-scroll')) {
                thisHolder.addClass('mkdf-bl-pag-infinite-scroll-started');
            }

            var loadMoreDatta = mkdf.modules.common.getLoadMoreData(thisHolder),
                loadingItem = thisHolder.find('.mkdf-blog-pag-loading');

            nextPage = loadMoreDatta.nextPage;

            if(nextPage <= maxNumPages){
                if(thisHolder.hasClass('mkdf-bl-pag-standard-shortcodes')) {
                    loadingItem.addClass('mkdf-showing mkdf-standard-pag-trigger');
                    thisHolder.addClass('mkdf-bl-pag-standard-shortcodes-animate');
                } else {
                    loadingItem.addClass('mkdf-showing');
                }

                var ajaxData = mkdf.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'cocco_mikado_blog_shortcode_load_more');

                $.ajax({
                    type: 'POST',
                    data: ajaxData,
                    url: mkdfGlobalVars.vars.mkdfAjaxUrl,
                    success: function (data) {
                        if(!thisHolder.hasClass('mkdf-bl-pag-standard-shortcodes')) {
                            nextPage++;
                        }

                        thisHolder.data('next-page', nextPage);

                        var response = $.parseJSON(data),
                            responseHtml =  response.html;

                        if(thisHolder.hasClass('mkdf-bl-pag-standard-shortcodes')) {
                            mkdfInitStandardPaginationLinkChanges(thisHolder, maxNumPages, nextPage);

                            thisHolder.waitForImages(function(){
                                if(thisHolder.hasClass('mkdf-bl-masonry')){
                                    mkdfInitHtmlIsotopeNewContent(thisHolder, thisHolderInner, loadingItem, responseHtml);
                                } else {
                                    mkdfInitHtmlGalleryNewContent(thisHolder, thisHolderInner, loadingItem, responseHtml);

                                    if (typeof mkdf.modules.common.mkdfStickySidebarWidget === 'function') {
                                        mkdf.modules.common.mkdfStickySidebarWidget().reInit();
                                    }
                                }
                            });
                        } else {
                            thisHolder.waitForImages(function(){
                                if(thisHolder.hasClass('mkdf-bl-masonry')){
                                    mkdfInitAppendIsotopeNewContent(thisHolderInner, loadingItem, responseHtml);
                                } else {
                                    mkdfInitAppendGalleryNewContent(thisHolderInner, loadingItem, responseHtml);

                                    if (typeof mkdf.modules.common.mkdfStickySidebarWidget === 'function') {
                                        mkdf.modules.common.mkdfStickySidebarWidget().reInit();
                                    }
                                }
                            });
                        }

                        if(thisHolder.hasClass('mkdf-bl-pag-infinite-scroll-started')) {
                            thisHolder.removeClass('mkdf-bl-pag-infinite-scroll-started');
                        }
                    }
                });
            }

            if(nextPage === maxNumPages){
                thisHolder.find('.mkdf-blog-pag-load-more').hide();
            }
        };

        var mkdfInitStandardPaginationLinkChanges = function(thisHolder, maxNumPages, nextPage) {
            var standardPagHolder = thisHolder.find('.mkdf-bl-standard-pagination'),
                standardPagNumericItem = standardPagHolder.find('li.mkdf-bl-pag-number'),
                standardPagPrevItem = standardPagHolder.find('li.mkdf-bl-pag-prev a'),
                standardPagNextItem = standardPagHolder.find('li.mkdf-bl-pag-next a');

            standardPagNumericItem.removeClass('mkdf-bl-pag-active');
            standardPagNumericItem.eq(nextPage-1).addClass('mkdf-bl-pag-active');

            standardPagPrevItem.data('paged', nextPage-1);
            standardPagNextItem.data('paged', nextPage+1);

            if(nextPage > 1) {
                standardPagPrevItem.css({'opacity': '1'});
            } else {
                standardPagPrevItem.css({'opacity': '0'});
            }

            if(nextPage === maxNumPages) {
                standardPagNextItem.css({'opacity': '0'});
            } else {
                standardPagNextItem.css({'opacity': '1'});
            }
        };

        var mkdfInitHtmlIsotopeNewContent = function(thisHolder, thisHolderInner, loadingItem, responseHtml) {
            thisHolderInner.html(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
            loadingItem.removeClass('mkdf-showing mkdf-standard-pag-trigger');
            thisHolder.removeClass('mkdf-bl-pag-standard-shortcodes-animate');

            setTimeout(function() {
                thisHolderInner.isotope('layout');

                if (typeof mkdf.modules.common.mkdfStickySidebarWidget === 'function') {
                    mkdf.modules.common.mkdfStickySidebarWidget().reInit();
                }
            }, 600);
        };

        var mkdfInitHtmlGalleryNewContent = function(thisHolder, thisHolderInner, loadingItem, responseHtml) {
            loadingItem.removeClass('mkdf-showing mkdf-standard-pag-trigger');
            thisHolder.removeClass('mkdf-bl-pag-standard-shortcodes-animate');
            thisHolderInner.html(responseHtml);
        };

        var mkdfInitAppendIsotopeNewContent = function(thisHolderInner, loadingItem, responseHtml) {
            thisHolderInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
            loadingItem.removeClass('mkdf-showing');

            setTimeout(function() {
                thisHolderInner.isotope('layout');

                if (typeof mkdf.modules.common.mkdfStickySidebarWidget === 'function') {
                    mkdf.modules.common.mkdfStickySidebarWidget().reInit();
                }
            }, 600);
        };

        var mkdfInitAppendGalleryNewContent = function(thisHolderInner, loadingItem, responseHtml) {
            loadingItem.removeClass('mkdf-showing');
            thisHolderInner.append(responseHtml);
        };

        return {
            init: function() {
                if(holder.length) {
                    holder.each(function() {
                        var thisHolder = $(this);

                        if(thisHolder.hasClass('mkdf-bl-pag-standard-shortcodes')) {
                            initStandardPagination(thisHolder);
                        }

                        if(thisHolder.hasClass('mkdf-bl-pag-load-more')) {
                            initLoadMorePagination(thisHolder);
                        }

                        if(thisHolder.hasClass('mkdf-bl-pag-infinite-scroll')) {
                            initInifiteScrollPagination(thisHolder);
                        }
                    });
                }
            },
            scroll: function() {
                if(holder.length) {
                    holder.each(function() {
                        var thisHolder = $(this);

                        if(thisHolder.hasClass('mkdf-bl-pag-infinite-scroll')) {
                            initInifiteScrollPagination(thisHolder);
                        }
                    });
                }
            }
        };
    }

})(jQuery);
(function($) {
    "use strict";

    var headerMinimal = {};
    mkdf.modules.headerMinimal = headerMinimal;
	
	headerMinimal.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function mkdfOnDocumentReady() {
        mkdfFullscreenMenu();
    }

    /**
     * Init Fullscreen Menu
     */
    function mkdfFullscreenMenu() {
	    var popupMenuOpener = $( 'a.mkdf-fullscreen-menu-opener');
	    
        if (popupMenuOpener.length) {
            var popupMenuHolderOuter = $(".mkdf-fullscreen-menu-holder-outer"),
                cssClass,
            //Flags for type of animation
                fadeRight = false,
                fadeTop = false,
            //Widgets
                widgetAboveNav = $('.mkdf-fullscreen-above-menu-widget-holder'),
                widgetBelowNav = $('.mkdf-fullscreen-below-menu-widget-holder'),
            //Menu
                menuItems = $('.mkdf-fullscreen-menu-holder-outer nav > ul > li > a'),
                menuItemWithChild =  $('.mkdf-fullscreen-menu > ul li.has_sub > a'),
                menuItemWithoutChild = $('.mkdf-fullscreen-menu ul li:not(.has_sub) a');

            //set height of popup holder and initialize perfectScrollbar
            popupMenuHolderOuter.perfectScrollbar({
                wheelSpeed: 0.6,
                suppressScrollX: true
            });

            //set height of popup holder on resize
            $(window).resize(function() {
                popupMenuHolderOuter.height(mkdf.windowHeight);
            });

            if (mkdf.body.hasClass('mkdf-fade-push-text-right')) {
                cssClass = 'mkdf-push-nav-right';
                fadeRight = true;
            } else if (mkdf.body.hasClass('mkdf-fade-push-text-top')) {
                cssClass = 'mkdf-push-text-top';
                fadeTop = true;
            }

            //Appearing animation
            if (fadeRight || fadeTop) {
                if (widgetAboveNav.length) {
                    widgetAboveNav.children().css({
                        '-webkit-animation-delay' : 0 + 'ms',
                        '-moz-animation-delay' : 0 + 'ms',
                        'animation-delay' : 0 + 'ms'
                    });
                }
                menuItems.each(function(i) {
                    $(this).css({
                        '-webkit-animation-delay': (i+1) * 70 + 'ms',
                        '-moz-animation-delay': (i+1) * 70 + 'ms',
                        'animation-delay': (i+1) * 70 + 'ms'
                    });
                });
                if (widgetBelowNav.length) {
                    widgetBelowNav.children().css({
                        '-webkit-animation-delay' : (menuItems.length + 1)*70 + 'ms',
                        '-moz-animation-delay' : (menuItems.length + 1)*70 + 'ms',
                        'animation-delay' : (menuItems.length + 1)*70 + 'ms'
                    });
                }
            }

            // Open popup menu
            popupMenuOpener.on('click',function(e){
                e.preventDefault();

                if (!popupMenuOpener.hasClass('mkdf-fm-opened')) {
                    popupMenuOpener.addClass('mkdf-fm-opened');
                    mkdf.body.removeClass('mkdf-fullscreen-fade-out').addClass('mkdf-fullscreen-menu-opened mkdf-fullscreen-fade-in');
                    mkdf.body.removeClass(cssClass);
                    mkdf.modules.common.mkdfDisableScroll();
                    
                    $(document).keyup(function(e){
                        if (e.keyCode === 27 ) {
                            popupMenuOpener.removeClass('mkdf-fm-opened');
                            mkdf.body.removeClass('mkdf-fullscreen-menu-opened mkdf-fullscreen-fade-in').addClass('mkdf-fullscreen-fade-out');
                            mkdf.body.addClass(cssClass);
                            mkdf.modules.common.mkdfEnableScroll();

                            $("nav.mkdf-fullscreen-menu ul.sub_menu").slideUp(200);
                        }
                    });
                } else {
                    popupMenuOpener.removeClass('mkdf-fm-opened');
                    mkdf.body.removeClass('mkdf-fullscreen-menu-opened mkdf-fullscreen-fade-in').addClass('mkdf-fullscreen-fade-out');
                    mkdf.body.addClass(cssClass);
                    mkdf.modules.common.mkdfEnableScroll();

                    $("nav.mkdf-fullscreen-menu ul.sub_menu").slideUp(200);
                }
            });

            //logic for open sub menus in popup menu
            menuItemWithChild.on('tap click', function(e) {
                e.preventDefault();

                var thisItem = $(this),
	                thisItemParent = thisItem.parent(),
					thisItemParentSiblingsWithDrop = thisItemParent.siblings('.menu-item-has-children');

                if (thisItemParent.hasClass('has_sub')) {
	                var submenu = thisItemParent.find('> ul.sub_menu');
	
	                if (submenu.is(':visible')) {
		                submenu.slideUp(450, 'easeInOutQuint');
		                thisItemParent.removeClass('open_sub');
	                } else {
		                thisItemParent.addClass('open_sub');
		
		                if(thisItemParentSiblingsWithDrop.length === 0) {
			                submenu.slideDown(400, 'easeInOutQuint');
		                } else {
							thisItemParent.closest('li.menu-item').siblings().find('.menu-item').removeClass('open_sub');
			                thisItemParent.siblings().removeClass('open_sub').find('.sub_menu').slideUp(400, 'easeInOutQuint', function() {
				                submenu.slideDown(400, 'easeInOutQuint');
			                });
		                }
	                }
                }
                
                return false;
            });

            //if link has no submenu and if it's not dead, than open that link
            menuItemWithoutChild.on('click', function (e) {
                if(($(this).attr('href') !== "http://#") && ($(this).attr('href') !== "#")){
                    if (e.which === 1) {
                        popupMenuOpener.removeClass('mkdf-fm-opened');
                        mkdf.body.removeClass('mkdf-fullscreen-menu-opened');
                        mkdf.body.removeClass('mkdf-fullscreen-fade-in').addClass('mkdf-fullscreen-fade-out');
                        mkdf.body.addClass(cssClass);
                        $("nav.mkdf-fullscreen-menu ul.sub_menu").slideUp(200);
                        mkdf.modules.common.mkdfEnableScroll();
                    }
                } else {
                    return false;
                }
            });
        }
    }

})(jQuery);
(function($) {
    "use strict";

    var headerVertical = {};
    mkdf.modules.headerVertical = headerVertical;
	
	headerVertical.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function mkdfOnDocumentReady() {
        mkdfVerticalMenu().init();
    }

    /**
     * Function object that represents vertical menu area.
     * @returns {{init: Function}}
     */
    var mkdfVerticalMenu = function() {
	    var verticalMenuObject = $('.mkdf-vertical-menu-area');

	    /**
	     * Checks if vertical area is scrollable (if it has mkdf-with-scroll class)
	     *
	     * @returns {bool}
	     */
	    var verticalAreaScrollable = function () {
		    return verticalMenuObject.find('.mkdf-vertical-menu').hasClass('mkdf-with-scroll');
	    };
	
	    /**
	     * Initialzes navigation functionality. It checks navigation type data attribute and calls proper functions
	     */
	    var initNavigation = function () {
		    var verticalNavObject = verticalMenuObject.find('.mkdf-vertical-menu');

		    if (verticalNavObject.hasClass('mkdf-vertical-dropdown-below')) {
				dropdownClickToggle();
			} else if (verticalNavObject.hasClass('mkdf-vertical-dropdown-side')) {
				dropdownFloat();
			}
		
		    /**
		     * Initializes click toggle navigation type. Works the same for touch and no-touch devices
		     */
		    function dropdownClickToggle() {
			    var menuItems = verticalNavObject.find('ul li.menu-item-has-children');
			
			    menuItems.each(function () {
				    var elementToExpand = $(this).find(' > .second, > ul');
				    var menuItem = this;
				    var dropdownOpener = $(this).find('> a');
				    var slideUpSpeed = 'fast';
				    var slideDownSpeed = 'slow';
				
				    dropdownOpener.on('click tap', function (e) {
					    e.preventDefault();
					    e.stopPropagation();
					
					    if (elementToExpand.is(':visible')) {
						    $(menuItem).removeClass('open');
						    elementToExpand.slideUp(slideUpSpeed);
					    } else if (dropdownOpener.parent().parent().children().hasClass('open') && dropdownOpener.parent().parent().parent().hasClass('mkdf-vertical-menu')) {
						    $(this).parent().parent().children().removeClass('open');
						    $(this).parent().parent().children().find(' > .second').slideUp(slideUpSpeed);
						
						    $(menuItem).addClass('open');
						    elementToExpand.slideDown(slideDownSpeed);
					    } else {
						
						    if (!$(this).parents('li').hasClass('open')) {
							    menuItems.removeClass('open');
							    menuItems.find(' > .second, > ul').slideUp(slideUpSpeed);
						    }
						
						    if ($(this).parent().parent().children().hasClass('open')) {
							    $(this).parent().parent().children().removeClass('open');
							    $(this).parent().parent().children().find(' > .second, > ul').slideUp(slideUpSpeed);
						    }
						
						    $(menuItem).addClass('open');
						    elementToExpand.slideDown(slideDownSpeed);
					    }
				    });
			    });
		    }


			/**
			 * Initializes click float navigation type
			 */
			function dropdownFloat() {
				var menuItems = verticalNavObject.find('ul li.menu-item-has-children');
				var allDropdowns = menuItems.find(' > .second > .inner > ul, > ul');

				menuItems.each(function() {
					var elementToExpand = $(this).find(' > .second > .inner > ul, > ul');
					var menuItem = this;

					if(Modernizr.touch) {
						var dropdownOpener = $(this).find('> a');

						dropdownOpener.on('click tap', function(e) {
							e.preventDefault();
							e.stopPropagation();

							if(elementToExpand.hasClass('mkdf-float-open')) {
								elementToExpand.removeClass('mkdf-float-open');
								$(menuItem).removeClass('open');
							} else {
								if(!$(this).parents('li').hasClass('open')) {
									menuItems.removeClass('open');
									allDropdowns.removeClass('mkdf-float-open');
								}

								elementToExpand.addClass('mkdf-float-open');
								$(menuItem).addClass('open');
							}
						});
					} else {
						//must use hoverIntent because basic hover effect doesn't catch dropdown
						//it doesn't start from menu item's edge
						$(this).hoverIntent({
							over: function() {
								elementToExpand.addClass('mkdf-float-open');
								$(menuItem).addClass('open');
							},
							out: function() {
								elementToExpand.removeClass('mkdf-float-open');
								$(menuItem).removeClass('open');
							},
							timeout: 300
						});
					}
				});
			}
	    };

        /**
         * Initializes scrolling in vertical area. It checks if vertical area is scrollable before doing so
         */
        var initVerticalAreaScroll = function() {
            if(verticalAreaScrollable()) {
                verticalMenuObject.find('.mkdf-vertical-menu').perfectScrollbar({
                    wheelSpeed: 0.6,
                    suppressScrollX: true
                });
            }
        };

        return {
            /**
             * Calls all necessary functionality for vertical menu area if vertical area object is valid
             */
            init: function() {
                if(verticalMenuObject.length) {
                    initNavigation();
                    initVerticalAreaScroll();
                }
            }
        };
    };

})(jQuery);
(function ($) {
	"use strict";
	
	var mobileHeader = {};
	mkdf.modules.mobileHeader = mobileHeader;
	
	mobileHeader.mkdfOnDocumentReady = mkdfOnDocumentReady;
	mobileHeader.mkdfOnWindowResize = mkdfOnWindowResize;
	
	$(document).ready(mkdfOnDocumentReady);
	$(window).resize(mkdfOnWindowResize);
	
	/*
		All functions to be called on $(document).ready() should be in this function
	*/
	function mkdfOnDocumentReady() {
		mkdfInitMobileNavigation();
		mkdfInitMobileNavigationScroll();
		mkdfMobileHeaderBehavior();
	}
	
	/*
        All functions to be called on $(window).resize() should be in this function
    */
	function mkdfOnWindowResize() {
		mkdfInitMobileNavigationScroll();
	}
	
	function mkdfInitMobileNavigation() {
		var navigationOpener = $('.mkdf-mobile-header .mkdf-mobile-menu-opener, .mkdf-close-mobile-side-area-holder');
		var navigationHolder = $('.mkdf-mobile-header .mkdf-mobile-side-area');
		var dropdownOpener = $('.mkdf-mobile-nav .mobile_arrow, .mkdf-mobile-nav h6, .mkdf-mobile-nav a[href*="#"]');
		var animationSpeed = 200;

		//whole mobile menu opening / closing
		if (navigationOpener.length && navigationHolder.length) {
			navigationOpener.on('tap click', function (e) {
				e.stopPropagation();
				e.preventDefault();

				if (navigationHolder.hasClass('opened')) {
					navigationHolder.removeClass('opened');

				} else {
					navigationHolder.addClass('opened');
				}
			});
		}

		//dropdown opening / closing
		if (dropdownOpener.length) {
			dropdownOpener.each(function () {
				var thisItem = $(this),
					initialNavHeight = navigationHolder.outerHeight();

				thisItem.on('tap click', function (e) {
					var thisItemParent = thisItem.parent('li'),
						thisItemParentSiblingsWithDrop = thisItemParent.siblings('.menu-item-has-children');

					if (thisItemParent.hasClass('has_sub')) {
						var submenu = thisItemParent.find('> ul.sub_menu');

						if (submenu.is(':visible')) {
							submenu.slideUp(450, 'easeInOutQuint');
							thisItemParent.removeClass('mkdf-opened');
							navigationHolder.stop().animate({'height': initialNavHeight}, 300);
						} else {
							thisItemParent.addClass('mkdf-opened');

							if (thisItemParentSiblingsWithDrop.length === 0) {
								thisItemParent.find('.sub_menu').slideUp(400, 'easeInOutQuint', function () {
									submenu.slideDown(400, 'easeInOutQuint');
									navigationHolder.stop().animate({'height': initialNavHeight + 50}, 300);
								});
							} else {
								thisItemParent.siblings().removeClass('mkdf-opened').find('.sub_menu').slideUp(400, 'easeInOutQuint', function () {
									submenu.slideDown(400, 'easeInOutQuint');
									navigationHolder.stop().animate({'height': initialNavHeight + 50}, 300);
								});
							}
						}
					}
				});
			});
		}

		$('.mkdf-mobile-nav a, .mkdf-mobile-logo-wrapper a').on('click tap', function (e) {
			if ($(this).attr('href') !== 'http://#' && $(this).attr('href') !== '#') {
				//navigationHolder.slideUp(animationSpeed);
			}
		});
	}
	
	function mkdfInitMobileNavigationScroll() {
		if (mkdf.windowWidth <= 1024) {
			var mobileHeader = $('.mkdf-mobile-header'),
				navigationHolder = mobileHeader.find('.mkdf-mobile-side-area-inner'),
				navigationHeight = navigationHolder.outerHeight(),
				windowHeight = mkdf.windowHeight - 100;

			//init scrollable menu
			var scrollHeight = navigationHeight > windowHeight ? windowHeight : navigationHeight;

			navigationHolder.height(scrollHeight).perfectScrollbar({
				wheelSpeed: 0.6,
				suppressScrollX: true
			});
		}
	}
	
	function mkdfMobileHeaderBehavior() {
		var mobileHeader = $('.mkdf-mobile-header'),
			mobileMenuOpener = mobileHeader.find('.mkdf-mobile-menu-opener'),
			mobileHeaderHeight = mobileHeader.length ? mobileHeader.outerHeight() : 0,
			navigationHolder = $('.mkdf-mobile-header .mkdf-mobile-side-area');
		
		if (mkdf.body.hasClass('mkdf-content-is-behind-header') && mobileHeaderHeight > 0 && mkdf.windowWidth <= 1024) {
			$('.mkdf-content').css('marginTop', -mobileHeaderHeight);
		}
		
		if (mkdf.body.hasClass('mkdf-sticky-up-mobile-header')) {
			var stickyAppearAmount,
				adminBar = $('#wpadminbar');
			
			var docYScroll1 = $(document).scrollTop();
			stickyAppearAmount = mobileHeaderHeight + mkdfGlobalVars.vars.mkdfAddForAdminBar;
			
			$(window).scroll(function () {
				var docYScroll2 = $(document).scrollTop();
				
				if (docYScroll2 > stickyAppearAmount && !navigationHolder.hasClass('opened')) {
					mobileHeader.addClass('mkdf-animate-mobile-header');
				} else {
					mobileHeader.removeClass('mkdf-animate-mobile-header');
				}

				if (((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount) || (docYScroll2 < stickyAppearAmount)) || navigationHolder.hasClass('opened') ) {
					mobileHeader.removeClass('mobile-header-appear');
					mobileHeader.css('margin-bottom', 0);
					
					if (adminBar.length) {
						mobileHeader.find('.mkdf-mobile-header-inner').css('top', 0);
					}
				} else {
					mobileHeader.addClass('mobile-header-appear');
					mobileHeader.css('margin-bottom', stickyAppearAmount);
				}
				
				docYScroll1 = $(document).scrollTop();
			});
		}
	}
	
})(jQuery);
(function($) {
    "use strict";

    var stickyHeader = {};
    mkdf.modules.stickyHeader = stickyHeader;
	
	stickyHeader.isStickyVisible = false;
	stickyHeader.stickyAppearAmount = 0;
	stickyHeader.behaviour = '';
	
	stickyHeader.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function mkdfOnDocumentReady() {
	    if(mkdf.windowWidth > 1024) {
		    mkdfHeaderBehaviour();
	    }
    }

    /*
     **	Show/Hide sticky header on window scroll
     */
    function mkdfHeaderBehaviour() {
        var header = $('.mkdf-page-header'),
	        stickyHeader = $('.mkdf-sticky-header'),
            fixedHeaderWrapper = $('.mkdf-fixed-wrapper'),
	        fixedMenuArea = fixedHeaderWrapper.children('.mkdf-menu-area'),
	        fixedMenuAreaHeight = fixedMenuArea.outerHeight(),
            sliderHolder = $('.mkdf-slider'),
            revSliderHeight = sliderHolder.length ? sliderHolder.outerHeight() : 0,
	        stickyAppearAmount,
	        headerAppear;
        
        var headerMenuAreaOffset = fixedHeaderWrapper.length ? fixedHeaderWrapper.offset().top - mkdfGlobalVars.vars.mkdfAddForAdminBar : 0;

        switch(true) {
            // sticky header that will be shown when user scrolls up
            case mkdf.body.hasClass('mkdf-sticky-header-on-scroll-up'):
                mkdf.modules.stickyHeader.behaviour = 'mkdf-sticky-header-on-scroll-up';
                var docYScroll1 = $(document).scrollTop();
                stickyAppearAmount = parseInt(mkdfGlobalVars.vars.mkdfTopBarHeight) + parseInt(mkdfGlobalVars.vars.mkdfLogoAreaHeight) + parseInt(mkdfGlobalVars.vars.mkdfMenuAreaHeight) + parseInt(mkdfGlobalVars.vars.mkdfStickyHeaderHeight);
	            
                headerAppear = function(){
                    var docYScroll2 = $(document).scrollTop();
					
                    if((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount) || (docYScroll2 < stickyAppearAmount)) {
                        mkdf.modules.stickyHeader.isStickyVisible = false;
                        stickyHeader.removeClass('header-appear').find('.mkdf-main-menu .second').removeClass('mkdf-drop-down-start');
                        mkdf.body.removeClass('mkdf-sticky-header-appear');
                    } else {
                        mkdf.modules.stickyHeader.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
	                    mkdf.body.addClass('mkdf-sticky-header-appear');
                    }

                    docYScroll1 = $(document).scrollTop();
                };
                headerAppear();

                $(window).scroll(function() {
                    headerAppear();
                });

                break;

            // sticky header that will be shown when user scrolls both up and down
            case mkdf.body.hasClass('mkdf-sticky-header-on-scroll-down-up'):
                mkdf.modules.stickyHeader.behaviour = 'mkdf-sticky-header-on-scroll-down-up';

                if(mkdfPerPageVars.vars.mkdfStickyScrollAmount !== 0){
                    mkdf.modules.stickyHeader.stickyAppearAmount = parseInt(mkdfPerPageVars.vars.mkdfStickyScrollAmount);
                } else {
                    mkdf.modules.stickyHeader.stickyAppearAmount = parseInt(mkdfGlobalVars.vars.mkdfTopBarHeight) + parseInt(mkdfGlobalVars.vars.mkdfLogoAreaHeight) + parseInt(mkdfGlobalVars.vars.mkdfMenuAreaHeight) + parseInt(revSliderHeight);
                }

                headerAppear = function(){
                    if(mkdf.scroll < mkdf.modules.stickyHeader.stickyAppearAmount) {
                        mkdf.modules.stickyHeader.isStickyVisible = false;
                        stickyHeader.removeClass('header-appear').find('.mkdf-main-menu .second').removeClass('mkdf-drop-down-start');
	                    mkdf.body.removeClass('mkdf-sticky-header-appear');
                    }else{
                        mkdf.modules.stickyHeader.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
	                    mkdf.body.addClass('mkdf-sticky-header-appear');
                    }
                };

                headerAppear();

                $(window).scroll(function() {
                    headerAppear();
                });

                break;

            // on scroll down, part of header will be sticky
            case mkdf.body.hasClass('mkdf-fixed-on-scroll'):
                mkdf.modules.stickyHeader.behaviour = 'mkdf-fixed-on-scroll';
                var headerFixed = function(){
	
	                if(mkdf.scroll <= headerMenuAreaOffset) {
		                fixedHeaderWrapper.removeClass('fixed');
		                mkdf.body.removeClass('mkdf-fixed-header-appear');
		                header.css('margin-bottom', '0');
	                } else {
		                fixedHeaderWrapper.addClass('fixed');
		                mkdf.body.addClass('mkdf-fixed-header-appear');
		                header.css('margin-bottom', fixedMenuAreaHeight + 'px');
	                }
                };

                headerFixed();

                $(window).scroll(function() {
                    headerFixed();
                });

                break;
        }
    }

})(jQuery);
(function($) {
	"use strict";

	var searchCoversHeader = {};
	mkdf.modules.searchCoversHeader = searchCoversHeader;

	searchCoversHeader.mkdfOnDocumentReady = mkdfOnDocumentReady;

	$(document).ready(mkdfOnDocumentReady);

	/*
		All functions to be called on $(document).ready() should be in this function
	*/
	function mkdfOnDocumentReady() {
		mkdfSearchCoversHeader();
	}

	/**
	 * Init Search Types
	 */
	function mkdfSearchCoversHeader() {
		if ( mkdf.body.hasClass( 'mkdf-search-covers-header' ) ) {

			var searchOpener = $('a.mkdf-search-opener');

			if (searchOpener.length > 0) {
				searchOpener.each(function() {
					var thisOpener = $(this);
					thisOpener.on("click", function (e) {
						e.preventDefault();

						var thisSearchOpener = $(this),
							searchFormHeight,
							searchFormHeaderHolder = $('.mkdf-page-header'),
							searchFormTopHeaderHolder = $('.mkdf-top-bar'),
							searchFormFixedHeaderHolder = searchFormHeaderHolder.find('.mkdf-fixed-wrapper.fixed'),
							searchFormMobileHeaderHolder = $('.mkdf-mobile-header'),
							searchForm = $('.mkdf-search-cover'),
							searchFormIsInTopHeader = !!thisSearchOpener.parents('.mkdf-top-bar').length,
							searchFormIsInFixedHeader = !!thisSearchOpener.parents('.mkdf-fixed-wrapper.fixed').length,
							searchFormIsInStickyHeader = !!thisSearchOpener.parents('.mkdf-sticky-header').length,
							searchFormIsInMobileHeader = !!thisSearchOpener.parents('.mkdf-mobile-header').length;

						searchForm.removeClass('mkdf-is-active');

						//Find search form position in header and height
						if (searchFormIsInTopHeader) {
							searchFormHeight = mkdfGlobalVars.vars.mkdfTopBarHeight;
							searchFormTopHeaderHolder.find('.mkdf-search-cover').addClass('mkdf-is-active');

						} else if (searchFormIsInFixedHeader) {
							searchFormHeight = searchFormFixedHeaderHolder.outerHeight();
							searchFormHeaderHolder.children('.mkdf-search-cover').addClass('mkdf-is-active');

						} else if (searchFormIsInStickyHeader) {
							searchFormHeight = searchFormHeaderHolder.find('.mkdf-sticky-header').outerHeight();
							searchFormHeaderHolder.children('.mkdf-search-cover').addClass('mkdf-is-active');

						} else if (searchFormIsInMobileHeader) {
							if (searchFormMobileHeaderHolder.hasClass('mobile-header-appear')) {
								searchFormHeight = searchFormMobileHeaderHolder.children('.mkdf-mobile-header-inner').outerHeight();
							} else {
								searchFormHeight = searchFormMobileHeaderHolder.outerHeight();
							}

							searchFormMobileHeaderHolder.find('.mkdf-search-cover').addClass('mkdf-is-active');

						} else {
							searchFormHeight = searchFormHeaderHolder.outerHeight();
							searchFormHeaderHolder.children('.mkdf-search-cover').addClass('mkdf-is-active');
						}

						if (searchForm.hasClass('mkdf-is-active')) {
							searchForm.height(searchFormHeight).stop(true).fadeIn(600).find('input[type="text"]').focus();
						}

						searchForm.find('.mkdf-search-close').on("click", function (e) {
							e.preventDefault();
							searchForm.stop(true).fadeOut(450);
						});

						searchForm.blur(function () {
							searchForm.stop(true).fadeOut(450);
						});

						$(window).scroll(function () {
							searchForm.stop(true).fadeOut(450);
						});
					});
				});
			}
		}
	}

})(jQuery);

(function($) {
    "use strict";

    var searchFullscreen = {};
    mkdf.modules.searchFullscreen = searchFullscreen;

    searchFullscreen.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function mkdfOnDocumentReady() {
	    mkdfSearchFullscreen();
    }
	
	/**
	 * Init Search Types
	 */
	function mkdfSearchFullscreen() {
        if ( mkdf.body.hasClass( 'mkdf-fullscreen-search' ) ) {

            var searchOpener = $('a.mkdf-search-opener');

            if (searchOpener.length > 0) {

                var searchHolder = $('.mkdf-fullscreen-search-holder'),
                    searchClose = $('.mkdf-search-close');

                searchOpener.on("click", function (e) {
                    e.preventDefault();

                    if (searchHolder.hasClass('mkdf-animate')) {
                        mkdf.body.removeClass('mkdf-fullscreen-search-opened mkdf-search-fade-out');
                        mkdf.body.removeClass('mkdf-search-fade-in');
                        searchHolder.removeClass('mkdf-animate');

                        setTimeout(function () {
                            searchHolder.find('.mkdf-search-field').val('');
                            searchHolder.find('.mkdf-search-field').blur();
                        }, 300);

                        mkdf.modules.common.mkdfEnableScroll();
                    } else {
                        mkdf.body.addClass('mkdf-fullscreen-search-opened mkdf-search-fade-in');
                        mkdf.body.removeClass('mkdf-search-fade-out');
                        searchHolder.addClass('mkdf-animate');

                        setTimeout(function () {
                            searchHolder.find('.mkdf-search-field').focus();
                        }, 900);

                        mkdf.modules.common.mkdfDisableScroll();
                    }

                    searchClose.on("click", function (e) {
                        e.preventDefault();
                        mkdf.body.removeClass('mkdf-fullscreen-search-opened mkdf-search-fade-in');
                        mkdf.body.addClass('mkdf-search-fade-out');
                        searchHolder.removeClass('mkdf-animate');

                        setTimeout(function () {
                            searchHolder.find('.mkdf-search-field').val('');
                            searchHolder.find('.mkdf-search-field').blur();
                        }, 300);

                        mkdf.modules.common.mkdfEnableScroll();
                    });

                    //Close on click away
                    $(document).mouseup(function (e) {
                        var container = $(".mkdf-form-holder-inner");

                        if (!container.is(e.target) && container.has(e.target).length === 0) {
                            e.preventDefault();
                            mkdf.body.removeClass('mkdf-fullscreen-search-opened mkdf-search-fade-in');
                            mkdf.body.addClass('mkdf-search-fade-out');
                            searchHolder.removeClass('mkdf-animate');

                            setTimeout(function () {
                                searchHolder.find('.mkdf-search-field').val('');
                                searchHolder.find('.mkdf-search-field').blur();
                            }, 300);

                            mkdf.modules.common.mkdfEnableScroll();
                        }
                    });

                    //Close on escape
                    $(document).keyup(function (e) {
                        if (e.keyCode === 27) { //KeyCode for ESC button is 27
                            mkdf.body.removeClass('mkdf-fullscreen-search-opened mkdf-search-fade-in');
                            mkdf.body.addClass('mkdf-search-fade-out');
                            searchHolder.removeClass('mkdf-animate');

                            setTimeout(function () {
                                searchHolder.find('.mkdf-search-field').val('');
                                searchHolder.find('.mkdf-search-field').blur();
                            }, 300);

                            mkdf.modules.common.mkdfEnableScroll();
                        }
                    });
                });

                //Text input focus change
                var inputSearchField = $('.mkdf-fullscreen-search-holder .mkdf-search-field'),
                    inputSearchLine = $('.mkdf-fullscreen-search-holder .mkdf-field-holder .mkdf-line');

                inputSearchField.focus(function () {
                    inputSearchLine.css('width', '100%');
                });

                inputSearchField.blur(function () {
                    inputSearchLine.css('width', '0');
                });
            }
        }
	}

})(jQuery);

(function($) {
    "use strict";

    var searchSlideFromHB = {};
    mkdf.modules.searchSlideFromHB = searchSlideFromHB;

    searchSlideFromHB.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function mkdfOnDocumentReady() {
	    mkdfSearchSlideFromHB();
    }
	
	/**
	 * Init Search Types
	 */
	function mkdfSearchSlideFromHB() {
        if ( mkdf.body.hasClass( 'mkdf-slide-from-header-bottom' ) ) {

            var searchOpener = $('a.mkdf-search-opener');

            if (searchOpener.length > 0) {
                //Check for type of search
                searchOpener.on("click", function (e) {
                    e.preventDefault();

                    var thisSearchOpener = $(this),
                        searchIconPosition = parseInt(mkdf.windowWidth - thisSearchOpener.offset().left - thisSearchOpener.outerWidth());

                    if (mkdf.body.hasClass('mkdf-boxed') && mkdf.windowWidth > 1024) {
                        searchIconPosition -= parseInt((mkdf.windowWidth - $('.mkdf-boxed .mkdf-wrapper .mkdf-wrapper-inner').outerWidth()) / 2);
                    }

                    var searchFormHeaderHolder = $('.mkdf-page-header'),
                        searchFormTopOffset = '100%',
                        searchFormTopHeaderHolder = $('.mkdf-top-bar'),
                        searchFormFixedHeaderHolder = searchFormHeaderHolder.find('.mkdf-fixed-wrapper.fixed'),
                        searchFormMobileHeaderHolder = $('.mkdf-mobile-header'),
                        searchForm = $('.mkdf-slide-from-header-bottom-holder'),
                        searchFormIsInTopHeader = !!thisSearchOpener.parents('.mkdf-top-bar').length,
                        searchFormIsInFixedHeader = !!thisSearchOpener.parents('.mkdf-fixed-wrapper.fixed').length,
                        searchFormIsInStickyHeader = !!thisSearchOpener.parents('.mkdf-sticky-header').length,
                        searchFormIsInMobileHeader = !!thisSearchOpener.parents('.mkdf-mobile-header').length;

                    searchForm.removeClass('mkdf-is-active');

                    //Find search form position in header and height
                    if (searchFormIsInTopHeader) {
                        searchFormTopHeaderHolder.find('.mkdf-slide-from-header-bottom-holder').addClass('mkdf-is-active');

                    } else if (searchFormIsInFixedHeader) {
                        searchFormTopOffset = searchFormFixedHeaderHolder.outerHeight() + mkdfGlobalVars.vars.mkdfAddForAdminBar;
                        searchFormHeaderHolder.children('.mkdf-slide-from-header-bottom-holder').addClass('mkdf-is-active');

                    } else if (searchFormIsInStickyHeader) {
                        searchFormTopOffset = mkdfGlobalVars.vars.mkdfStickyHeaderHeight + mkdfGlobalVars.vars.mkdfAddForAdminBar;
                        searchFormHeaderHolder.children('.mkdf-slide-from-header-bottom-holder').addClass('mkdf-is-active');

                    } else if (searchFormIsInMobileHeader) {
                        if (searchFormMobileHeaderHolder.hasClass('mobile-header-appear')) {
                            searchFormTopOffset = searchFormMobileHeaderHolder.children('.mkdf-mobile-header-inner').outerHeight() + mkdfGlobalVars.vars.mkdfAddForAdminBar;
                        }
                        searchFormMobileHeaderHolder.find('.mkdf-slide-from-header-bottom-holder').addClass('mkdf-is-active');

                    } else {
                        searchFormHeaderHolder.children('.mkdf-slide-from-header-bottom-holder').addClass('mkdf-is-active');
                    }

                    if (searchForm.hasClass('mkdf-is-active')) {
                        searchForm.css({
                            'right': searchIconPosition,
                            'top': searchFormTopOffset
                        }).stop(true).slideToggle(300, 'easeOutBack');
                    }

                    //Close on escape
                    $(document).keyup(function (e) {
                        if (e.keyCode == 27) { //KeyCode for ESC button is 27
                            searchForm.stop(true).fadeOut(0);
                        }
                    });

                    $(window).scroll(function () {
                        searchForm.stop(true).fadeOut(0);
                    });
                });
            }
        }
	}

})(jQuery);

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
(function($) {
    'use strict';
	
	var accordions = {};
	mkdf.modules.accordions = accordions;
	
	accordions.mkdfInitAccordions = mkdfInitAccordions;
	
	
	accordions.mkdfOnDocumentReady = mkdfOnDocumentReady;
	
	$(document).ready(mkdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
		mkdfInitAccordions();
	}
	
	/**
	 * Init accordions shortcode
	 */
	function mkdfInitAccordions(){
		var accordion = $('.mkdf-accordion-holder');
		
		if(accordion.length){
			accordion.each(function(){
				var thisAccordion = $(this);

				if(thisAccordion.hasClass('mkdf-accordion')){
					thisAccordion.accordion({
						animate: "swing",
						collapsible: true,
						active: 0,
						icons: "",
						heightStyle: "content"
					});
				}

				if(thisAccordion.hasClass('mkdf-toggle')){
					var toggleAccordion = $(this),
						toggleAccordionTitle = toggleAccordion.find('.mkdf-accordion-title'),
						toggleAccordionContent = toggleAccordionTitle.next();

					toggleAccordion.addClass("accordion ui-accordion ui-accordion-icons ui-widget ui-helper-reset");
					toggleAccordionTitle.addClass("ui-accordion-header ui-state-default ui-corner-top ui-corner-bottom");
					toggleAccordionContent.addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom").hide();

					toggleAccordionTitle.each(function(){
						var thisTitle = $(this);
						
						thisTitle.on('mouseenter mouseleave',function(){
							thisTitle.toggleClass("ui-state-hover");
						});

						thisTitle.on('click',function(){
							thisTitle.toggleClass('ui-accordion-header-active ui-state-active ui-state-default ui-corner-bottom');
							thisTitle.next().toggleClass('ui-accordion-content-active').slideToggle(400);
						});
					});
				}
			});
		}
	}

})(jQuery);
(function($) {
	'use strict';
	
	var animationHolder = {};
	mkdf.modules.animationHolder = animationHolder;
	
	animationHolder.mkdfInitAnimationHolder = mkdfInitAnimationHolder;
	
	
	animationHolder.mkdfOnDocumentReady = mkdfOnDocumentReady;
	
	$(document).ready(mkdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
		mkdfInitAnimationHolder();
	}
	
	/*
	 *	Init animation holder shortcode
	 */
	function mkdfInitAnimationHolder(){
		var elements = $('.mkdf-grow-in, .mkdf-fade-in-down, .mkdf-element-from-fade, .mkdf-element-from-left, .mkdf-element-from-right, .mkdf-element-from-top, .mkdf-element-from-bottom, .mkdf-flip-in, .mkdf-x-rotate, .mkdf-z-rotate, .mkdf-y-translate, .mkdf-fade-in, .mkdf-fade-in-left-x-rotate'),
			animationClass,
			animationData,
			animationDelay;
		
		if(elements.length){
			elements.each(function(){
				var thisElement = $(this);
				
				thisElement.appear(function() {
					animationData = thisElement.data('animation');
					animationDelay = parseInt(thisElement.data('animation-delay'));
					
					if(typeof animationData !== 'undefined' && animationData !== '') {
						animationClass = animationData;
						var newClass = animationClass+'-on';
						
						setTimeout(function(){
							thisElement.addClass(newClass);
						},animationDelay);
					}
				},{accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var button = {};
	mkdf.modules.button = button;
	
	button.mkdfButton = mkdfButton;
	
	
	button.mkdfOnDocumentReady = mkdfOnDocumentReady;
	
	$(document).ready(mkdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
		mkdfButton().init();
	}
	
	/**
	 * Button object that initializes whole button functionality
	 * @type {Function}
	 */
	var mkdfButton = function() {
		//all buttons on the page
		var buttons = $('.mkdf-btn');
		
		/**
		 * Initializes button hover color
		 * @param button current button
		 */
		var buttonHoverColor = function(button) {
			if(typeof button.data('hover-color') !== 'undefined') {
				var changeButtonColor = function(event) {
					event.data.button.css('color', event.data.color);
				};
				
				var originalColor = button.css('color');
				var hoverColor = button.data('hover-color');
				
				button.on('mouseenter', { button: button, color: hoverColor }, changeButtonColor);
				button.on('mouseleave', { button: button, color: originalColor }, changeButtonColor);
			}
		};
		
		/**
		 * Initializes button hover background color
		 * @param button current button
		 */
		var buttonHoverBgColor = function(button) {
			if(typeof button.data('hover-bg-color') !== 'undefined') {
				var changeButtonBg = function(event) {
					event.data.button.css('background-color', event.data.color);
				};
				
				var originalBgColor = button.css('background-color');
				var hoverBgColor = button.data('hover-bg-color');
				
				button.on('mouseenter', { button: button, color: hoverBgColor }, changeButtonBg);
				button.on('mouseleave', { button: button, color: originalBgColor }, changeButtonBg);
			}
		};
		
		/**
		 * Initializes button border color
		 * @param button
		 */
		var buttonHoverBorderColor = function(button) {
			if(typeof button.data('hover-border-color') !== 'undefined') {
				var changeBorderColor = function(event) {
					event.data.button.css('border-color', event.data.color);
				};
				
				var originalBorderColor = button.css('borderTopColor'); //take one of the four sides
				var hoverBorderColor = button.data('hover-border-color');
				
				button.on('mouseenter', { button: button, color: hoverBorderColor }, changeBorderColor);
				button.on('mouseleave', { button: button, color: originalBorderColor }, changeBorderColor);
			}
		};
		
		return {
			init: function() {
				if(buttons.length) {
					buttons.each(function() {
						buttonHoverColor($(this));
						buttonHoverBgColor($(this));
						buttonHoverBorderColor($(this));
					});
				}
			}
		};
	};
	
})(jQuery);
(function($) {
	'use strict';
	
	var countdown = {};
	mkdf.modules.countdown = countdown;
	
	countdown.mkdfInitCountdown = mkdfInitCountdown;
	
	
	countdown.mkdfOnDocumentReady = mkdfOnDocumentReady;
	
	$(document).ready(mkdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
		mkdfInitCountdown();
	}
	
	/**
	 * Countdown Shortcode
	 */
	function mkdfInitCountdown() {
		var countdowns = $('.mkdf-countdown'),
			date = new Date(),
			currentMonth = date.getMonth(),
			currentYear = date.getFullYear(),
			year,
			month,
			day,
			hour,
			minute,
			timezone,
			monthLabel,
			dayLabel,
			hourLabel,
			minuteLabel,
			secondLabel;
		
		if (countdowns.length) {
			countdowns.each(function(){
				//Find countdown elements by id-s
				var countdownId = $(this).attr('id'),
					countdown = $('#'+countdownId),
					digitFontSize,
					labelFontSize;
				
				//Get data for countdown
				year = countdown.data('year');
				month = countdown.data('month');
				day = countdown.data('day');
				hour = countdown.data('hour');
				minute = countdown.data('minute');
				timezone = countdown.data('timezone');
				monthLabel = countdown.data('month-label');
				dayLabel = countdown.data('day-label');
				hourLabel = countdown.data('hour-label');
				minuteLabel = countdown.data('minute-label');
				secondLabel = countdown.data('second-label');
				digitFontSize = countdown.data('digit-size');
				labelFontSize = countdown.data('label-size');

				if( currentMonth !== month || currentYear !== year ) {
					month = month - 1;
				}
				
				//Initialize countdown
				countdown.countdown({
					until: new Date(year, month, day, hour, minute, 44),
					labels: ['', monthLabel, '', dayLabel, hourLabel, minuteLabel, secondLabel],
					format: 'ODHMS',
					timezone: timezone,
					padZeroes: true,
					onTick: setCountdownStyle
				});
				
				function setCountdownStyle() {
					countdown.find('.countdown-amount').css({
						'font-size' : digitFontSize+'px',
						'line-height' : digitFontSize+'px'
					});
					countdown.find('.countdown-period').css({
						'font-size' : labelFontSize+'px'
					});
				}
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var counter = {};
	mkdf.modules.counter = counter;
	
	counter.mkdfInitCounter = mkdfInitCounter;
	
	
	counter.mkdfOnDocumentReady = mkdfOnDocumentReady;
	
	$(document).ready(mkdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
		mkdfInitCounter();
	}
	
	/**
	 * Counter Shortcode
	 */
	function mkdfInitCounter() {
		var counterHolder = $('.mkdf-counter-holder');
		
		if (counterHolder.length) {
			counterHolder.each(function() {
				var thisCounterHolder = $(this),
					thisCounter = thisCounterHolder.find('.mkdf-counter');
				
				thisCounterHolder.appear(function() {
					thisCounterHolder.css('opacity', '1');
					
					//Counter zero type
					if (thisCounter.hasClass('mkdf-zero-counter')) {
						var max = parseFloat(thisCounter.text());
						thisCounter.countTo({
							from: 0,
							to: max,
							speed: 1500,
							refreshInterval: 100
						});
					} else {
						thisCounter.absoluteCounter({
							speed: 2000,
							fadeInDelay: 1000
						});
					}
				},{accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
			});
		}
	}
	
})(jQuery);
(function ($) {
	'use strict';
	
	var fullScreenImageSlider = {};
	mkdf.modules.fullScreenImageSlider = fullScreenImageSlider;
	
	
	fullScreenImageSlider.mkdfOnWindowLoad = mkdfOnWindowLoad;
	
	$(window).load(mkdfOnWindowLoad);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnWindowLoad() {
		mkdfInitFullScreenImageSlider();
	}
	
	/**
	 * Init Full Screen Image Slider Shortcode
	 */
	function mkdfInitFullScreenImageSlider() {
		var holder = $('.mkdf-fsis-slider');
		
		if (holder.length) {
			holder.each(function () {
				var sliderHolder = $(this),
					mainHolder = sliderHolder.parent(),
					prevThumbNav = mainHolder.children('.mkdf-fsis-prev-nav'),
					nextThumbNav = mainHolder.children('.mkdf-fsis-next-nav'),
					maskHolder = mainHolder.children('.mkdf-fsis-slider-mask');
				
				mainHolder.addClass('mkdf-fsis-is-init');
				
				mkdfImageBehavior(sliderHolder);
				mkdfPrevNextImageBehavior(sliderHolder, prevThumbNav, nextThumbNav, -1); // -1 is arbitrary value because 0 can be index of item
				
				sliderHolder.on('drag.owl.carousel', function () {
					setTimeout(function () {
						if (!maskHolder.hasClass('mkdf-drag') && !mainHolder.hasClass('mkdf-fsis-active')) {
							maskHolder.addClass('mkdf-drag');
						}
					}, 200);
				});
				
				sliderHolder.on('dragged.owl.carousel', function () {
					setTimeout(function () {
						if (maskHolder.hasClass('mkdf-drag')) {
							maskHolder.removeClass('mkdf-drag');
						}
					}, 300);
				});
				
				sliderHolder.on('translate.owl.carousel', function (e) {
					mkdfPrevNextImageBehavior(sliderHolder, prevThumbNav, nextThumbNav, e.item.index);
				});
				
				sliderHolder.on('translated.owl.carousel', function () {
					mkdfImageBehavior(sliderHolder);
					
					setTimeout(function () {
						maskHolder.removeClass('mkdf-drag');
					}, 300);
				});
			});
		}
	}
	
	function mkdfImageBehavior(sliderHolder) {
		var activeItem = sliderHolder.find('.owl-item.active'),
			imageHolder = sliderHolder.find('.mkdf-fsis-item');
		
		imageHolder.removeClass('mkdf-fsis-content-image-init');
		
		mkdfResetImageBehavior(sliderHolder);
		
		if (activeItem.length) {
			var activeImageHolder = activeItem.find('.mkdf-fsis-item'),
				activeItemImage = activeImageHolder.children('.mkdf-fsis-image');
			
			setTimeout(function () {
				activeImageHolder.addClass('mkdf-fsis-content-image-init');
			}, 100);
			
			activeItemImage.off().on('mouseenter', function () {
				activeImageHolder.addClass('mkdf-fsis-image-hover');
			}).on('mouseleave', function () {
				activeImageHolder.removeClass('mkdf-fsis-image-hover');
			}).on('click', function () {
				if (activeImageHolder.hasClass('mkdf-fsis-active-image')) {
					sliderHolder.trigger('play.owl.autoplay');
					sliderHolder.parent().removeClass('mkdf-fsis-active');
					activeImageHolder.removeClass('mkdf-fsis-active-image');
				} else {
					sliderHolder.trigger('stop.owl.autoplay');
					sliderHolder.parent().addClass('mkdf-fsis-active');
					activeImageHolder.addClass('mkdf-fsis-active-image');
				}
			});
			
			//Close on escape
			$(document).keyup(function (e) {
				if (e.keyCode === 27) { //KeyCode for ESC button is 27
					sliderHolder.trigger('play.owl.autoplay');
					sliderHolder.parent().removeClass('mkdf-fsis-active');
					activeImageHolder.removeClass('mkdf-fsis-active-image');
				}
			});
		}
	}
	
	function mkdfPrevNextImageBehavior(sliderHolder, prevThumbNav, nextThumbNav, itemIndex) {
		var activeItem = itemIndex === -1 ? sliderHolder.find('.owl-item.active') : $(sliderHolder.find('.owl-item')[itemIndex]),
			prevItemImage = activeItem.prev().find('.mkdf-fsis-image').css('background-image'),
			nextItemImage = activeItem.next().find('.mkdf-fsis-image').css('background-image');
		
		if (prevItemImage.length) {
			prevThumbNav.css({'background-image': prevItemImage});
		}
		
		if (nextItemImage.length) {
			nextThumbNav.css({'background-image': nextItemImage});
		}
	}
	
	function mkdfResetImageBehavior(sliderHolder) {
		var imageHolder = sliderHolder.find('.mkdf-fsis-item');
		
		if (imageHolder.length) {
			imageHolder.removeClass('mkdf-fsis-active-image');
		}
	}
	
})(jQuery);
(function ($) {
	'use strict';
	
	var customFont = {};
	mkdf.modules.customFont = customFont;
	
	customFont.mkdfCustomFontResize = mkdfCustomFontResize;
	customFont.mkdfCustomFontTypeOut = mkdfCustomFontTypeOut;
	
	
	customFont.mkdfOnDocumentReady = mkdfOnDocumentReady;
	customFont.mkdfOnWindowLoad = mkdfOnWindowLoad;
	
	$(document).ready(mkdfOnDocumentReady);
	$(window).load(mkdfOnWindowLoad);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
		mkdfCustomFontResize();
	}
	
	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	function mkdfOnWindowLoad() {
		mkdfCustomFontTypeOut();
	}
	
	/*
	 **	Custom Font resizing style
	 */
	function mkdfCustomFontResize() {
		var holder = $('.mkdf-custom-font-holder');
		
		if (holder.length) {
			holder.each(function () {
				var thisItem = $(this),
					itemClass = '',
					smallLaptopStyle = '',
					ipadLandscapeStyle = '',
					ipadPortraitStyle = '',
					mobileLandscapeStyle = '',
					style = '',
					responsiveStyle = '';
				
				if (typeof thisItem.data('item-class') !== 'undefined' && thisItem.data('item-class') !== false) {
					itemClass = thisItem.data('item-class');
				}
				
				if (typeof thisItem.data('font-size-1366') !== 'undefined' && thisItem.data('font-size-1366') !== false) {
					smallLaptopStyle += 'font-size: ' + thisItem.data('font-size-1366') + ' !important;';
				}
				if (typeof thisItem.data('font-size-1024') !== 'undefined' && thisItem.data('font-size-1024') !== false) {
					ipadLandscapeStyle += 'font-size: ' + thisItem.data('font-size-1024') + ' !important;';
				}
				if (typeof thisItem.data('font-size-768') !== 'undefined' && thisItem.data('font-size-768') !== false) {
					ipadPortraitStyle += 'font-size: ' + thisItem.data('font-size-768') + ' !important;';
				}
				if (typeof thisItem.data('font-size-680') !== 'undefined' && thisItem.data('font-size-680') !== false) {
					mobileLandscapeStyle += 'font-size: ' + thisItem.data('font-size-680') + ' !important;';
				}
				
				if (typeof thisItem.data('line-height-1366') !== 'undefined' && thisItem.data('line-height-1366') !== false) {
					smallLaptopStyle += 'line-height: ' + thisItem.data('line-height-1366') + ' !important;';
				}
				if (typeof thisItem.data('line-height-1024') !== 'undefined' && thisItem.data('line-height-1024') !== false) {
					ipadLandscapeStyle += 'line-height: ' + thisItem.data('line-height-1024') + ' !important;';
				}
				if (typeof thisItem.data('line-height-768') !== 'undefined' && thisItem.data('line-height-768') !== false) {
					ipadPortraitStyle += 'line-height: ' + thisItem.data('line-height-768') + ' !important;';
				}
				if (typeof thisItem.data('line-height-680') !== 'undefined' && thisItem.data('line-height-680') !== false) {
					mobileLandscapeStyle += 'line-height: ' + thisItem.data('line-height-680') + ' !important;';
				}
				
				if (smallLaptopStyle.length || ipadLandscapeStyle.length || ipadPortraitStyle.length || mobileLandscapeStyle.length) {
					
					if (smallLaptopStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 1366px) {.mkdf-custom-font-holder." + itemClass + " { " + smallLaptopStyle + " } }";
					}
					if (ipadLandscapeStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 1024px) {.mkdf-custom-font-holder." + itemClass + " { " + ipadLandscapeStyle + " } }";
					}
					if (ipadPortraitStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 768px) {.mkdf-custom-font-holder." + itemClass + " { " + ipadPortraitStyle + " } }";
					}
					if (mobileLandscapeStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 680px) {.mkdf-custom-font-holder." + itemClass + " { " + mobileLandscapeStyle + " } }";
					}
				}
				
				if (responsiveStyle.length) {
					style = '<style type="text/css">' + responsiveStyle + '</style>';
				}
				
				if (style.length) {
					$('head').append(style);
				}
			});
		}
	}
	
	/*
	 * Init Type out functionality for Custom Font shortcode
	 */
	function mkdfCustomFontTypeOut() {
		var mkdfTyped = $('.mkdf-cf-typed');
		
		if (mkdfTyped.length) {
			mkdfTyped.each(function () {
				
				//vars
				var thisTyped = $(this),
					typedWrap = thisTyped.parent('.mkdf-cf-typed-wrap'),
					customFontHolder = typedWrap.parent('.mkdf-custom-font-holder'),
					str = [],
					string_1 = thisTyped.find('.mkdf-cf-typed-1').text(),
					string_2 = thisTyped.find('.mkdf-cf-typed-2').text(),
					string_3 = thisTyped.find('.mkdf-cf-typed-3').text(),
					string_4 = thisTyped.find('.mkdf-cf-typed-4').text();
				
				if (string_1.length) {
					str.push(string_1);
				}
				
				if (string_2.length) {
					str.push(string_2);
				}
				
				if (string_3.length) {
					str.push(string_3);
				}
				
				if (string_4.length) {
					str.push(string_4);
				}
				
				customFontHolder.appear(function () {
					thisTyped.typed({
						strings: str,
						typeSpeed: 90,
						backDelay: 700,
						loop: true,
						contentType: 'text',
						loopCount: false,
						cursorChar: '_'
					});
				}, {accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var elementsHolder = {};
	mkdf.modules.elementsHolder = elementsHolder;
	
	elementsHolder.mkdfInitElementsHolderResponsiveStyle = mkdfInitElementsHolderResponsiveStyle;
	
	
	elementsHolder.mkdfOnDocumentReady = mkdfOnDocumentReady;
	
	$(document).ready(mkdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
		mkdfInitElementsHolderResponsiveStyle();
	}
	
	/*
	 **	Elements Holder responsive style
	 */
	function mkdfInitElementsHolderResponsiveStyle(){
		var elementsHolder = $('.mkdf-elements-holder');
		
		if(elementsHolder.length){
			elementsHolder.each(function() {
				var thisElementsHolder = $(this),
					elementsHolderItem = thisElementsHolder.children('.mkdf-eh-item'),
					style = '',
					responsiveStyle = '';
				
				elementsHolderItem.each(function() {
					var thisItem = $(this),
						itemClass = '',
						largeLaptop = '',
						smallLaptop = '',
						ipadLandscape = '',
						ipadPortrait = '',
						mobileLandscape = '',
						mobilePortrait = '';
					
					if (typeof thisItem.data('item-class') !== 'undefined' && thisItem.data('item-class') !== false) {
						itemClass = thisItem.data('item-class');
					}
					if (typeof thisItem.data('1367-1600') !== 'undefined' && thisItem.data('1367-1600') !== false) {
						largeLaptop = thisItem.data('1367-1600');
					}
					if (typeof thisItem.data('1025-1366') !== 'undefined' && thisItem.data('1025-1366') !== false) {
						smallLaptop = thisItem.data('1025-1366');
					}
					if (typeof thisItem.data('769-1024') !== 'undefined' && thisItem.data('769-1024') !== false) {
						ipadLandscape = thisItem.data('769-1024');
					}
					if (typeof thisItem.data('681-768') !== 'undefined' && thisItem.data('681-768') !== false) {
						ipadPortrait = thisItem.data('681-768');
					}
					if (typeof thisItem.data('680') !== 'undefined' && thisItem.data('680') !== false) {
						mobileLandscape = thisItem.data('680');
					}
					
					if(largeLaptop.length || smallLaptop.length || ipadLandscape.length || ipadPortrait.length || mobileLandscape.length || mobilePortrait.length) {
						
						if(largeLaptop.length) {
							responsiveStyle += "@media only screen and (min-width: 1367px) and (max-width: 1600px) {.mkdf-eh-item-content."+itemClass+" { padding: "+largeLaptop+" !important; } }";
						}
						if(smallLaptop.length) {
							responsiveStyle += "@media only screen and (min-width: 1025px) and (max-width: 1366px) {.mkdf-eh-item-content."+itemClass+" { padding: "+smallLaptop+" !important; } }";
						}
						if(ipadLandscape.length) {
							responsiveStyle += "@media only screen and (min-width: 769px) and (max-width: 1024px) {.mkdf-eh-item-content."+itemClass+" { padding: "+ipadLandscape+" !important; } }";
						}
						if(ipadPortrait.length) {
							responsiveStyle += "@media only screen and (min-width: 681px) and (max-width: 768px) {.mkdf-eh-item-content."+itemClass+" { padding: "+ipadPortrait+" !important; } }";
						}
						if(mobileLandscape.length) {
							responsiveStyle += "@media only screen and (max-width: 680px) {.mkdf-eh-item-content."+itemClass+" { padding: "+mobileLandscape+" !important; } }";
						}
					}
				});
				
				if(responsiveStyle.length) {
					style = '<style type="text/css">'+responsiveStyle+'</style>';
				}
				
				if(style.length) {
					$('head').append(style);
				}
				
				if (typeof mkdf.modules.common.mkdfOwlSlider === "function") {
					//timeout to prevent double immediate loading
					setTimeout(function () {
						mkdf.modules.common.mkdfOwlSlider();
					},200);
				}
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var googleMap = {};
	mkdf.modules.googleMap = googleMap;
	
	googleMap.mkdfShowGoogleMap = mkdfShowGoogleMap;
	
	
	googleMap.mkdfOnDocumentReady = mkdfOnDocumentReady;
	
	$(document).ready(mkdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
		mkdfShowGoogleMap();
	}
	
	/*
	 **	Show Google Map
	 */
	function mkdfShowGoogleMap(){
		var googleMap = $('.mkdf-google-map');
		
		if(googleMap.length){
			googleMap.each(function(){
				var element = $(this);
				
				var snazzyMapStyle = false;
				var snazzyMapCode  = '';
				if(typeof element.data('snazzy-map-style') !== 'undefined' && element.data('snazzy-map-style') === 'yes') {
					snazzyMapStyle = true;
					var snazzyMapHolder = element.parent().find('.mkdf-snazzy-map'),
						snazzyMapCodes  = snazzyMapHolder.val();
					
					if( snazzyMapHolder.length && snazzyMapCodes.length ) {
						snazzyMapCode = JSON.parse( snazzyMapCodes.replace(/`{`/g, '[').replace(/`}`/g, ']').replace(/``/g, '"').replace(/`/g, '') );
					}
				}
				
				var customMapStyle;
				if(typeof element.data('custom-map-style') !== 'undefined') {
					customMapStyle = element.data('custom-map-style');
				}
				
				var colorOverlay;
				if(typeof element.data('color-overlay') !== 'undefined' && element.data('color-overlay') !== false) {
					colorOverlay = element.data('color-overlay');
				}
				
				var saturation;
				if(typeof element.data('saturation') !== 'undefined' && element.data('saturation') !== false) {
					saturation = element.data('saturation');
				}
				
				var lightness;
				if(typeof element.data('lightness') !== 'undefined' && element.data('lightness') !== false) {
					lightness = element.data('lightness');
				}
				
				var zoom;
				if(typeof element.data('zoom') !== 'undefined' && element.data('zoom') !== false) {
					zoom = element.data('zoom');
				}
				
				var pin;
				if(typeof element.data('pin') !== 'undefined' && element.data('pin') !== false) {
					pin = element.data('pin');
				}
				
				var mapHeight;
				if(typeof element.data('height') !== 'undefined' && element.data('height') !== false) {
					mapHeight = element.data('height');
				}
				
				var uniqueId;
				if(typeof element.data('unique-id') !== 'undefined' && element.data('unique-id') !== false) {
					uniqueId = element.data('unique-id');
				}
				
				var scrollWheel;
				if(typeof element.data('scroll-wheel') !== 'undefined') {
					scrollWheel = element.data('scroll-wheel');
				}
				var addresses;
				if(typeof element.data('addresses') !== 'undefined' && element.data('addresses') !== false) {
					addresses = element.data('addresses');
				}
				
				var map = "map_"+ uniqueId;
				var geocoder = "geocoder_"+ uniqueId;
				var holderId = "mkdf-map-"+ uniqueId;
				
				mkdfInitializeGoogleMap(snazzyMapStyle, snazzyMapCode, customMapStyle, colorOverlay, saturation, lightness, scrollWheel, zoom, holderId, mapHeight, pin,  map, geocoder, addresses);
			});
		}
	}
	
	/*
	 **	Init Google Map
	 */
	function mkdfInitializeGoogleMap(snazzyMapStyle, snazzyMapCode, customMapStyle, color, saturation, lightness, wheel, zoom, holderId, height, pin,  map, geocoder, data){
		
		if(typeof google !== 'object') {
			return;
		}
		
		var mapStyles = [];
		if(snazzyMapStyle && snazzyMapCode.length) {
			mapStyles = snazzyMapCode;
		} else {
			mapStyles = [
				{
					stylers: [
						{hue: color },
						{saturation: saturation},
						{lightness: lightness},
						{gamma: 1}
					]
				}
			];
		}
		
		var googleMapStyleId;
		
		if(snazzyMapStyle || customMapStyle === 'yes'){
			googleMapStyleId = 'mkdf-style';
		} else {
			googleMapStyleId = google.maps.MapTypeId.ROADMAP;
		}
		
		wheel = wheel === 'yes';
		
		var qoogleMapType = new google.maps.StyledMapType(mapStyles, {name: "Mikado Google Map"});
		
		geocoder = new google.maps.Geocoder();
		var latlng = new google.maps.LatLng(-34.397, 150.644);
		
		if (!isNaN(height)){
			height = height + 'px';
		}
		
		var myOptions = {
			zoom: zoom,
			scrollwheel: wheel,
			center: latlng,
			zoomControl: true,
			zoomControlOptions: {
				style: google.maps.ZoomControlStyle.SMALL,
				position: google.maps.ControlPosition.RIGHT_CENTER
			},
			scaleControl: false,
			scaleControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			streetViewControl: false,
			streetViewControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			panControl: false,
			panControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			mapTypeControl: false,
			mapTypeControlOptions: {
				mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'mkdf-style'],
				style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			mapTypeId: googleMapStyleId
		};
		
		map = new google.maps.Map(document.getElementById(holderId), myOptions);
		map.mapTypes.set('mkdf-style', qoogleMapType);
		
		var index;
		
		for (index = 0; index < data.length; ++index) {
			mkdfInitializeGoogleAddress(data[index], pin, map, geocoder);
		}
		
		var holderElement = document.getElementById(holderId);
		holderElement.style.height = height;
	}
	
	/*
	 **	Init Google Map Addresses
	 */
	function mkdfInitializeGoogleAddress(data, pin, map, geocoder){
		if (data === '') {
			return;
		}
		
		var contentString = '<div id="content">'+
			'<div id="siteNotice">'+
			'</div>'+
			'<div id="bodyContent">'+
			'<p>'+data+'</p>'+
			'</div>'+
			'</div>';
		
		var infowindow = new google.maps.InfoWindow({
			content: contentString
		});
		
		geocoder.geocode( { 'address': data}, function(results, status) {
			if (status === google.maps.GeocoderStatus.OK) {
				map.setCenter(results[0].geometry.location);
				var marker = new google.maps.Marker({
					map: map,
					position: results[0].geometry.location,
					icon:  pin,
					title: data.store_title
				});
				google.maps.event.addListener(marker, 'click', function() {
					infowindow.open(map,marker);
				});
				
				google.maps.event.addDomListener(window, 'resize', function() {
					map.setCenter(results[0].geometry.location);
				});
			}
		});
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var fullScreenSections = {};
	mkdf.modules.fullScreenSections = fullScreenSections;
	
	fullScreenSections.mkdfInitFullScreenSections = mkdfInitFullScreenSections;
	
	
	fullScreenSections.mkdfOnDocumentReady = mkdfOnDocumentReady;
	
	$(document).ready(mkdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
		mkdfInitFullScreenSections();
	}
	
	/*
	 **	Init full screen sections shortcode
	 */
	function mkdfInitFullScreenSections(){
		var fullScreenSections = $('.mkdf-full-screen-sections');
		
		if(fullScreenSections.length){
			fullScreenSections.each(function() {
				var thisFullScreenSections = $(this),
					fullScreenSectionsWrapper = thisFullScreenSections.children('.mkdf-fss-wrapper'),
					fullScreenSectionsItems = fullScreenSectionsWrapper.children('.mkdf-fss-item'),
					fullScreenSectionsItemsNumber = fullScreenSectionsItems.length,
					fullScreenSectionsItemsHasHeaderStyle = fullScreenSectionsItems.hasClass('mkdf-fss-item-has-style'),
					enableContinuousVertical = false,
					enableNavigationData = '',
					enablePaginationData = '';
				
				var defaultHeaderStyle = '';
				if (mkdf.body.hasClass('mkdf-light-header')) {
					defaultHeaderStyle = 'light';
				} else if (mkdf.body.hasClass('mkdf-dark-header')) {
					defaultHeaderStyle = 'dark';
				}
				
				if (typeof thisFullScreenSections.data('enable-continuous-vertical') !== 'undefined' && thisFullScreenSections.data('enable-continuous-vertical') !== false && thisFullScreenSections.data('enable-continuous-vertical') === 'yes') {
					enableContinuousVertical = true;
				}
				if (typeof thisFullScreenSections.data('enable-navigation') !== 'undefined' && thisFullScreenSections.data('enable-navigation') !== false) {
					enableNavigationData = thisFullScreenSections.data('enable-navigation');
				}
				if (typeof thisFullScreenSections.data('enable-pagination') !== 'undefined' && thisFullScreenSections.data('enable-pagination') !== false) {
					enablePaginationData = thisFullScreenSections.data('enable-pagination');
				}
				
				var enableNavigation = enableNavigationData !== 'no',
					enablePagination = enablePaginationData !== 'no';
				
				fullScreenSectionsWrapper.fullpage({
					sectionSelector: '.mkdf-fss-item',
					scrollingSpeed: 1200,
					verticalCentered: false,
					continuousVertical: enableContinuousVertical,
					navigation: enablePagination,
					onLeave: function(index, nextIndex, direction){
						if(fullScreenSectionsItemsHasHeaderStyle) {
							checkFullScreenSectionsItemForHeaderStyle($(fullScreenSectionsItems[nextIndex - 1]).data('header-style'), defaultHeaderStyle);
						}
						
						if(enableNavigation) {
							checkActiveArrowsOnFullScrrenTemplate(thisFullScreenSections, fullScreenSectionsItemsNumber, nextIndex);
						}
					},
					afterRender: function(){
						if(fullScreenSectionsItemsHasHeaderStyle) {
							checkFullScreenSectionsItemForHeaderStyle(fullScreenSectionsItems.first().data('header-style'), defaultHeaderStyle);
						}
						
						if(enableNavigation) {
							checkActiveArrowsOnFullScrrenTemplate(thisFullScreenSections, fullScreenSectionsItemsNumber, 1);
							thisFullScreenSections.children('.mkdf-fss-nav-holder').css('visibility','visible');
						}
						
						fullScreenSectionsWrapper.css('visibility','visible');
					}
				});
				
				setResposniveData(thisFullScreenSections);
				
				if(enableNavigation) {
					thisFullScreenSections.find('#mkdf-fss-nav-up').on('click', function() {
						$.fn.fullpage.moveSectionUp();
						return false;
					});
					
					thisFullScreenSections.find('#mkdf-fss-nav-down').on('click', function() {
						$.fn.fullpage.moveSectionDown();
						return false;
					});
				}
			});
		}
	}
	
	function checkFullScreenSectionsItemForHeaderStyle(section_header_style, default_header_style) {
		if (section_header_style !== undefined && section_header_style !== '') {
			mkdf.body.removeClass('mkdf-light-header mkdf-dark-header').addClass('mkdf-' + section_header_style + '-header');
		} else if (default_header_style !== '') {
			mkdf.body.removeClass('mkdf-light-header mkdf-dark-header').addClass('mkdf-' + default_header_style + '-header');
		} else {
			mkdf.body.removeClass('mkdf-light-header mkdf-dark-header');
		}
	}
	
	function checkActiveArrowsOnFullScrrenTemplate(thisFullScreenSections, fullScreenSectionsItemsNumber, index){
		var thisHolder = thisFullScreenSections,
			thisHolderArrowsUp = thisHolder.find('#mkdf-fss-nav-up'),
			thisHolderArrowsDown = thisHolder.find('#mkdf-fss-nav-down'),
			enableContinuousVertical = false;
		
		if (typeof thisFullScreenSections.data('enable-continuous-vertical') !== 'undefined' && thisFullScreenSections.data('enable-continuous-vertical') !== false && thisFullScreenSections.data('enable-continuous-vertical') === 'yes') {
			enableContinuousVertical = true;
		}
		
		if (index === 1 && !enableContinuousVertical) {
			thisHolderArrowsUp.css({'opacity': '0', 'height': '0', 'visibility': 'hidden'});
			thisHolderArrowsDown.css({'opacity': '0', 'height': '0', 'visibility': 'hidden'});
			
			if(index !== fullScreenSectionsItemsNumber){
				thisHolderArrowsDown.css({'opacity': '1', 'height': 'auto', 'visibility': 'visible'});
			}
		} else if (index === fullScreenSectionsItemsNumber && !enableContinuousVertical) {
			thisHolderArrowsDown.css({'opacity': '0', 'height': '0', 'visibility': 'hidden'});
			
			if(fullScreenSectionsItemsNumber === 2){
				thisHolderArrowsUp.css({'opacity': '1', 'height': 'auto', 'visibility': 'visible'});
			}
		} else {
			thisHolderArrowsUp.css({'opacity': '1', 'height': 'auto', 'visibility': 'visible'});
			thisHolderArrowsDown.css({'opacity': '1', 'height': 'auto', 'visibility': 'visible'});
		}
	}
	
	function setResposniveData(thisFullScreenSections) {
		var fullScreenSections = thisFullScreenSections.find('.mkdf-fss-item'),
			responsiveStyle = '',
			style = '';
		
		fullScreenSections.each(function(){
			var thisSection = $(this),
				itemClass = '',
				imageLaptop = '',
				imageTablet = '',
				imagePortraitTablet = '',
				imageMobile = '';
			
			if (typeof thisSection.data('item-class') !== 'undefined' && thisSection.data('item-class') !== false) {
				itemClass = thisSection.data('item-class');
			}
			if (typeof thisSection.data('laptop-image') !== 'undefined' && thisSection.data('laptop-image') !== false) {
				imageLaptop = thisSection.data('laptop-image');
			}
			if (typeof thisSection.data('tablet-image') !== 'undefined' && thisSection.data('tablet-image') !== false) {
				imageTablet = thisSection.data('tablet-image');
			}
			if (typeof thisSection.data('tablet-portrait-image') !== 'undefined' && thisSection.data('tablet-portrait-image') !== false) {
				imagePortraitTablet = thisSection.data('tablet-portrait-image');
			}
			if (typeof thisSection.data('mobile-image') !== 'undefined' && thisSection.data('mobile-image') !== false) {
				imageMobile = thisSection.data('mobile-image');
			}
			
			if (imageLaptop.length || imageTablet.length || imagePortraitTablet.length || imageMobile.length) {
				
				if (imageLaptop.length) {
					responsiveStyle += "@media only screen and (max-width: 1366px) {.mkdf-fss-item." + itemClass + " { background-image: url(" + imageLaptop + ") !important; } }";
				}
				if (imageTablet.length) {
					responsiveStyle += "@media only screen and (max-width: 1024px) {.mkdf-fss-item." + itemClass + " { background-image: url( " + imageTablet + ") !important; } }";
				}
				if (imagePortraitTablet.length) {
					responsiveStyle += "@media only screen and (max-width: 800px) {.mkdf-fss-item." + itemClass + " { background-image: url( " + imagePortraitTablet + ") !important; } }";
				}
				if (imageMobile.length) {
					responsiveStyle += "@media only screen and (max-width: 680px) {.mkdf-fss-item." + itemClass + " { background-image: url( " + imageMobile + ") !important; } }";
				}
			}
		});
		
		if (responsiveStyle.length) {
			style = '<style type="text/css">' + responsiveStyle + '</style>';
		}
		
		if (style.length) {
			$('head').append(style);
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var iconListItem = {};
	mkdf.modules.iconListItem = iconListItem;
	
	iconListItem.mkdfInitIconList = mkdfInitIconList;
	
	
	iconListItem.mkdfOnDocumentReady = mkdfOnDocumentReady;
	
	$(document).ready(mkdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
		mkdfInitIconList().init();
	}
	
	/**
	 * Button object that initializes icon list with animation
	 * @type {Function}
	 */
	var mkdfInitIconList = function() {
		var iconList = $('.mkdf-icon-list-appear');
		
		/**
		 * Initializes icon list animation
		 * @param list current slider
		 */
		 
		var iconListInit = function(list) {
			setTimeout(function(){
				list.appear(function(){
					list.addClass('mkdf-appeared');
				},{accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
			},30);
		};
		
		return {
			init: function() {
				if(iconList.length) {
					iconList.each(function() {
						iconListInit($(this));
					});
				}
			}
		};
	};
	
})(jQuery);
(function($) {
	'use strict';
	
	var iconWithText = {};
	mkdf.modules.iconWithText = iconWithText;

	iconWithText.mkdfIconWithText = mkdfIconWithText;


	iconWithText.mkdfOnDocumentReady = mkdfOnDocumentReady;
	
	$(document).ready(mkdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
		mkdfIconWithText();
	}
	
	/**
	 * Object that represents icon shortcode
	 * @returns {{init: Function}} function that initializes icon's functionality
	 */
	function mkdfIconWithText() {
		var icons = $('.mkdf-iwt .mkdf-iwt-custom-icon');

		if(icons.length) {
			icons.each(function() {
				var thisIcon = $(this);

				if (thisIcon.parents('.mkdf-iwt').hasClass('mkdf-custom-icon-animated')) {
					thisIcon.appear(function () {
						thisIcon.addClass('mkdf-icon-animation-show');
					}, {accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
				}
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var icon = {};
	mkdf.modules.icon = icon;
	
	icon.mkdfIcon = mkdfIcon;
	
	
	icon.mkdfOnDocumentReady = mkdfOnDocumentReady;
	
	$(document).ready(mkdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
		mkdfIcon().init();
	}
	
	/**
	 * Object that represents icon shortcode
	 * @returns {{init: Function}} function that initializes icon's functionality
	 */
	var mkdfIcon = function() {
		var icons = $('.mkdf-icon-shortcode');
		
		/**
		 * Function that triggers icon animation and icon animation delay
		 */
		var iconAnimation = function(icon) {
			if(icon.hasClass('mkdf-icon-animation')) {
				icon.appear(function() {
					icon.parent('.mkdf-icon-animation-holder').addClass('mkdf-icon-animation-show');
				}, {accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
			}
		};
		
		/**
		 * Function that triggers icon hover color functionality
		 */
		var iconHoverColor = function(icon) {
			if(typeof icon.data('hover-color') !== 'undefined') {
				var changeIconColor = function(event) {
					event.data.icon.css('color', event.data.color);
				};
				
				var iconElement = icon.find('.mkdf-icon-element');
				var hoverColor = icon.data('hover-color');
				var originalColor = iconElement.css('color');
				
				if(hoverColor !== '') {
					icon.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
					icon.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
				}
			}
		};
		
		/**
		 * Function that triggers icon holder background color hover functionality
		 */
		var iconHolderBackgroundHover = function(icon) {
			if(typeof icon.data('hover-background-color') !== 'undefined') {
				var changeIconBgColor = function(event) {
					event.data.icon.css('background-color', event.data.color);
				};
				
				var iconBackgroundHolder = icon.find('.mkdf-icon-bckg-holder');
				var hoverBackgroundColor = icon.data('hover-background-color');
				var originalBackgroundColor = iconBackgroundHolder.css('background-color');
				
				if(hoverBackgroundColor !== '') {
					icon.on('mouseenter', {icon: iconBackgroundHolder, color: hoverBackgroundColor}, changeIconBgColor);
					icon.on('mouseleave', {icon: iconBackgroundHolder, color: originalBackgroundColor}, changeIconBgColor);
				}
			}
		};
		
		/**
		 * Function that initializes icon holder border hover functionality
		 */
		var iconHolderBorderHover = function(icon) {
			if(typeof icon.data('hover-border-color') !== 'undefined') {
				var changeIconBorder = function(event) {
					event.data.icon.css('border-color', event.data.color);
				};
				
				var iconBackgroundHolder = icon.find('.mkdf-icon-bckg-holder');
				var hoverBorderColor = icon.data('hover-border-color');
				var originalBorderColor = iconBackgroundHolder.css('borderTopColor');
				
				if(hoverBorderColor !== '') {
					icon.on('mouseenter', {icon: iconBackgroundHolder, color: hoverBorderColor}, changeIconBorder);
					icon.on('mouseleave', {icon: iconBackgroundHolder, color: originalBorderColor}, changeIconBorder);
				}
			}
		};
		
		return {
			init: function() {
				if(icons.length) {
					icons.each(function() {
						iconAnimation($(this));
						iconHoverColor($(this));
						iconHolderBackgroundHover($(this));
						iconHolderBorderHover($(this));
					});
				}
			}
		};
	};
	
})(jQuery);
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
(function($) {
	'use strict';
	
	var pieChart = {};
	mkdf.modules.pieChart = pieChart;
	
	pieChart.mkdfInitPieChart = mkdfInitPieChart;
	
	
	pieChart.mkdfOnDocumentReady = mkdfOnDocumentReady;
	
	$(document).ready(mkdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
		mkdfInitPieChart();
	}
	
	/**
	 * Init Pie Chart shortcode
	 */
	function mkdfInitPieChart() {
		var pieChartHolder = $('.mkdf-pie-chart-holder');
		
		if (pieChartHolder.length) {
			pieChartHolder.each(function () {
				var thisPieChartHolder = $(this),
					pieChart = thisPieChartHolder.children('.mkdf-pc-percentage'),
					barColor = '#ff6f96',
					trackColor = '#f7f7f7',
					lineWidth = 6,
					size = 176;
				
				if(typeof pieChart.data('size') !== 'undefined' && pieChart.data('size') !== '') {
					size = pieChart.data('size');
				}
				
				if(typeof pieChart.data('bar-color') !== 'undefined' && pieChart.data('bar-color') !== '') {
					barColor = pieChart.data('bar-color');
				}
				
				if(typeof pieChart.data('track-color') !== 'undefined' && pieChart.data('track-color') !== '') {
					trackColor = pieChart.data('track-color');
				}
				
				pieChart.appear(function() {
					initToCounterPieChart(pieChart);
					thisPieChartHolder.css('opacity', '1');
					
					pieChart.easyPieChart({
						barColor: barColor,
						trackColor: trackColor,
						scaleColor: false,
						lineCap: 'butt',
						lineWidth: lineWidth,
						animate: 1500,
						size: size
					});
				},{accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
			});
		}
	}
	
	/*
	 **	Counter for pie chart number from zero to defined number
	 */
	function initToCounterPieChart(pieChart){
		var counter = pieChart.find('.mkdf-pc-percent'),
			max = parseFloat(counter.text());
		
		counter.countTo({
			from: 0,
			to: max,
			speed: 1500,
			refreshInterval: 50
		});
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var process = {};
	mkdf.modules.process = process;
	
	process.mkdfInitProcess = mkdfInitProcess;
	
	
	process.mkdfOnDocumentReady = mkdfOnDocumentReady;
	
	$(document).ready(mkdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
		mkdfInitProcess()
	}
	
	/**
	 * Inti process shortcode on appear
	 */
	function mkdfInitProcess() {
		var holder = $('.mkdf-process-holder');
		
		if(holder.length) {
			holder.each(function(){
				var thisHolder = $(this);
				
				thisHolder.appear(function(){
					thisHolder.addClass('mkdf-process-appeared');
				},{accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var progressBar = {};
	mkdf.modules.progressBar = progressBar;
	
	progressBar.mkdfInitProgressBars = mkdfInitProgressBars;
	
	
	progressBar.mkdfOnDocumentReady = mkdfOnDocumentReady;
	
	$(document).ready(mkdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
		mkdfInitProgressBars();
	}
	
	/*
	 **	Horizontal progress bars shortcode
	 */
	function mkdfInitProgressBars() {
		var progressBar = $('.mkdf-progress-bar');

		if (progressBar.length) {
			progressBar.each(function () {
				var thisBar = $(this),
					thisBarContent = thisBar.find('.mkdf-pb-content'),
					progressBar = thisBar.find('.mkdf-pb-percent'),
					percentage = thisBarContent.data('percentage');

				thisBar.appear(function () {
					mkdfInitToCounterProgressBar(progressBar, percentage);

					thisBarContent.css('width', '0%').animate({'width': percentage + '%'}, 2000);

					if (thisBar.hasClass('mkdf-pb-percent-floating')) {
						progressBar.css('left', '0%').animate({'left': percentage + '%'}, 2000);
					}
				});
			});
		}
	}

	/*
	 **	Counter for horizontal progress bars percent from zero to defined percent
	 */
	function mkdfInitToCounterProgressBar(progressBar, percentageValue){
		var percentage = parseFloat(percentageValue);

		if(progressBar.length) {
			progressBar.each(function() {
				var thisPercent = $(this);
				thisPercent.css('opacity', '1');

				thisPercent.countTo({
					from: 0,
					to: percentage,
					speed: 2000,
					refreshInterval: 50
				});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var tabs = {};
	mkdf.modules.tabs = tabs;
	
	tabs.mkdfInitTabs = mkdfInitTabs;
	
	
	tabs.mkdfOnDocumentReady = mkdfOnDocumentReady;
	
	$(document).ready(mkdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
		mkdfInitTabs();
	}
	
	/*
	 **	Init tabs shortcode
	 */
	function mkdfInitTabs(){
		var tabs = $('.mkdf-tabs');
		
		if(tabs.length){
			tabs.each(function(){
				var thisTabs = $(this);
				
				thisTabs.children('.mkdf-tab-container').each(function(index){
					index = index + 1;
					var that = $(this),
						link = that.attr('id'),
						navItem = that.parent().find('.mkdf-tabs-nav li:nth-child('+index+') a'),
						navLink = navItem.attr('href');
					
					link = '#'+link;

					if(link.indexOf(navLink) > -1) {
						navItem.attr('href',link);
					}
				});
				
				thisTabs.tabs();

                $('.mkdf-tabs a.mkdf-external-link').off('click');
			});
		}
	}
	
})(jQuery);
(function($) {
    'use strict';
    
    var textMarquee = {};
    mkdf.modules.textMarquee = textMarquee;
    
    textMarquee.mkdfInitTextMarquee = mkdfInitTextMarquee;
	textMarquee.mkdfTextMarqueeResize = mkdfTextMarqueeResize;
    
    textMarquee.mkdfOnDocumentReady = mkdfOnDocumentReady;
    
    $(document).ready(mkdfOnDocumentReady);
    
    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfTextMarqueeResize();
        mkdfInitTextMarquee();
    }
    
    /**
     * Init Text Marquee effect
     */
    function mkdfInitTextMarquee() {
        var textMarqueeShortcodes = $('.mkdf-text-marquee');

        if (textMarqueeShortcodes.length) {
            textMarqueeShortcodes.each(function(){
                var textMarqueeShortcode = $(this),
                    marqueeElements = textMarqueeShortcode.find('.mkdf-marquee-element'),
                    originalText = marqueeElements.filter('.mkdf-original-text'),
                    auxText = marqueeElements.filter('.mkdf-aux-text');

                var calcWidth = function(element) {
                    var width;

                    if (textMarqueeShortcode.outerWidth() > element.outerWidth()) {
                        width = textMarqueeShortcode.outerWidth();
                    } else {
                        width = element.outerWidth();
                    }

                    return width;
                };

                var marqueeEffect = function () {
	                mkdfRequestAnimationFrame();
	                
                    var delta = 1, //pixel movement
                        speedCoeff = 0.8, // below 1 to slow down, above 1 to speed up
                        marqueeWidth = calcWidth(originalText);
                    marqueeElements.css({'width':marqueeWidth}); // set the same width to both elements
                    auxText.css('left', marqueeWidth); //set to the right of the initial marquee element

                    //movement loop
                    marqueeElements.each(function(i){
                        var marqueeElement = $(this),
                            currentPos = 0;

                        var mkdfInfiniteScrollEffect = function() {
                            currentPos -= delta;

                            //move marquee element
                            if (marqueeElement.position().left <= -marqueeWidth) {
                                marqueeElement.css('left', parseInt(marqueeWidth - delta));
                                currentPos = 0;
                            }

                            marqueeElement.css('transform','translate3d('+speedCoeff*currentPos+'px,0,0)');
	
	                        requestNextAnimationFrame(mkdfInfiniteScrollEffect);

                            $(window).resize(function(){
                                marqueeWidth = calcWidth(originalText);
                                currentPos = 0;
                                originalText.css('left',0);
                                auxText.css('left', marqueeWidth); //set to the right of the inital marquee element
                            });
                        }; 
                            
                        mkdfInfiniteScrollEffect();
                    });
                };

                marqueeEffect();
            });
        }
    }
    
    /*
     * Request Animation Frame shim
     */
	function mkdfRequestAnimationFrame() {
		window.requestNextAnimationFrame =
			(function () {
				var originalWebkitRequestAnimationFrame = undefined,
					wrapper = undefined,
					callback = undefined,
					geckoVersion = 0,
					userAgent = navigator.userAgent,
					index = 0,
					self = this;
				
				// Workaround for Chrome 10 bug where Chrome
				// does not pass the time to the animation function
				
				if (window.webkitRequestAnimationFrame) {
					// Define the wrapper
					
					wrapper = function (time) {
						if (time === undefined) {
							time = +new Date();
						}
						
						self.callback(time);
					};
					
					// Make the switch
					
					originalWebkitRequestAnimationFrame = window.webkitRequestAnimationFrame;
					
					window.webkitRequestAnimationFrame = function (callback, element) {
						self.callback = callback;
						
						// Browser calls the wrapper and wrapper calls the callback
						originalWebkitRequestAnimationFrame(wrapper, element);
					};
				}
				
				// Workaround for Gecko 2.0, which has a bug in
				// mozRequestAnimationFrame() that restricts animations
				// to 30-40 fps.
				
				if (window.mozRequestAnimationFrame) {
					// Check the Gecko version. Gecko is used by browsers
					// other than Firefox. Gecko 2.0 corresponds to
					// Firefox 4.0.
					
					index = userAgent.indexOf('rv:');
					
					if (userAgent.indexOf('Gecko') != -1) {
						geckoVersion = userAgent.substr(index + 3, 3);
						
						if (geckoVersion === '2.0') {
							// Forces the return statement to fall through
							// to the setTimeout() function.
							
							window.mozRequestAnimationFrame = undefined;
						}
					}
				}
				
				return window.requestAnimationFrame   ||
					window.webkitRequestAnimationFrame ||
					window.mozRequestAnimationFrame    ||
					window.oRequestAnimationFrame      ||
					window.msRequestAnimationFrame     ||
					
					function (callback, element) {
						var start,
							finish;
						
						window.setTimeout( function () {
							start = +new Date();
							callback(start);
							finish = +new Date();
							
							self.timeout = 1000 / 60 - (finish - start);
							
						}, self.timeout);
					};
				}
			)();
	}

	/*
	 **	Text Marquee resizing style
	 */
	function mkdfTextMarqueeResize() {
		var holder = $('.mkdf-text-marquee');

		if (holder.length) {
			holder.each(function () {
				var thisItem = $(this),
					itemClass = '',
					smallLaptopStyle = '',
					ipadLandscapeStyle = '',
					ipadPortraitStyle = '',
					mobileLandscapeStyle = '',
					style = '',
					responsiveStyle = '';

				if (typeof thisItem.data('item-class') !== 'undefined' && thisItem.data('item-class') !== false) {
					itemClass = thisItem.data('item-class');
				}

				if (typeof thisItem.data('font-size-1366') !== 'undefined' && thisItem.data('font-size-1366') !== false) {
					smallLaptopStyle += 'font-size: ' + thisItem.data('font-size-1366') + ' !important;';
				}
				if (typeof thisItem.data('font-size-1024') !== 'undefined' && thisItem.data('font-size-1024') !== false) {
					ipadLandscapeStyle += 'font-size: ' + thisItem.data('font-size-1024') + ' !important;';
				}
				if (typeof thisItem.data('font-size-768') !== 'undefined' && thisItem.data('font-size-768') !== false) {
					ipadPortraitStyle += 'font-size: ' + thisItem.data('font-size-768') + ' !important;';
				}
				if (typeof thisItem.data('font-size-680') !== 'undefined' && thisItem.data('font-size-680') !== false) {
					mobileLandscapeStyle += 'font-size: ' + thisItem.data('font-size-680') + ' !important;';
				}

				if (typeof thisItem.data('line-height-1366') !== 'undefined' && thisItem.data('line-height-1366') !== false) {
					smallLaptopStyle += 'line-height: ' + thisItem.data('line-height-1366') + ' !important;';
				}
				if (typeof thisItem.data('line-height-1024') !== 'undefined' && thisItem.data('line-height-1024') !== false) {
					ipadLandscapeStyle += 'line-height: ' + thisItem.data('line-height-1024') + ' !important;';
				}
				if (typeof thisItem.data('line-height-768') !== 'undefined' && thisItem.data('line-height-768') !== false) {
					ipadPortraitStyle += 'line-height: ' + thisItem.data('line-height-768') + ' !important;';
				}
				if (typeof thisItem.data('line-height-680') !== 'undefined' && thisItem.data('line-height-680') !== false) {
					mobileLandscapeStyle += 'line-height: ' + thisItem.data('line-height-680') + ' !important;';
				}

				if (smallLaptopStyle.length || ipadLandscapeStyle.length || ipadPortraitStyle.length || mobileLandscapeStyle.length) {

					if (smallLaptopStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 1366px) {.mkdf-text-marquee." + itemClass + " { " + smallLaptopStyle + " } }";
					}
					if (ipadLandscapeStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 1024px) {.mkdf-text-marquee." + itemClass + " { " + ipadLandscapeStyle + " } }";
					}
					if (ipadPortraitStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 768px) {.mkdf-text-marquee." + itemClass + " { " + ipadPortraitStyle + " } }";
					}
					if (mobileLandscapeStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 680px) {.mkdf-text-marquee." + itemClass + " { " + mobileLandscapeStyle + " } }";
					}
				}

				if (responsiveStyle.length) {
					style = '<style type="text/css">' + responsiveStyle + '</style>';
				}

				if (style.length) {
					$('head').append(style);
				}
			});
		}
	}

})(jQuery);
(function($) {
	'use strict';
	
	var verticalSplitSlider = {};
	mkdf.modules.verticalSplitSlider = verticalSplitSlider;
	
	verticalSplitSlider.mkdfInitVerticalSplitSlider = mkdfInitVerticalSplitSlider;
	
	
	verticalSplitSlider.mkdfOnDocumentReady = mkdfOnDocumentReady;
	
	$(document).ready(mkdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
		mkdfInitVerticalSplitSlider();
	}
	
	/*
	 **	Vertical Split Slider
	 */
	function mkdfInitVerticalSplitSlider() {
		var slider = $('.mkdf-vertical-split-slider');
		
		if (slider.length) {
			if (mkdf.body.hasClass('mkdf-vss-initialized')) {
				mkdf.body.removeClass('mkdf-vss-initialized');
				$.fn.multiscroll.destroy();
			}
			
			slider.height(mkdf.windowHeight).animate({opacity: 1}, 300);
			
			var defaultHeaderStyle = '';
			if (mkdf.body.hasClass('mkdf-light-header')) {
				defaultHeaderStyle = 'light';
			} else if (mkdf.body.hasClass('mkdf-dark-header')) {
				defaultHeaderStyle = 'dark';
			}
			
			slider.multiscroll({
				scrollingSpeed: 700,
				easing: 'easeInOutQuart',
				navigation: true,
				useAnchorsOnLoad: false,
				sectionSelector: '.mkdf-vss-ms-section',
				leftSelector: '.mkdf-vss-ms-left',
				rightSelector: '.mkdf-vss-ms-right',
				afterRender: function () {
					mkdfCheckVerticalSplitSectionsForHeaderStyle($('.mkdf-vss-ms-left .mkdf-vss-ms-section:first-child').data('header-style'), defaultHeaderStyle);
					mkdf.body.addClass('mkdf-vss-initialized');
					
					var contactForm7 = $('div.wpcf7 > form');
					if (contactForm7.length) {
						contactForm7.each(function(){
							var thisForm = $(this);
							
							thisForm.find('.wpcf7-submit').off().on('click', function(e){
								e.preventDefault();
								wpcf7.submit(thisForm);
							});
						});
					}
					
					//prepare html for smaller screens - start //
					var verticalSplitSliderResponsive = $('<div class="mkdf-vss-responsive"></div>'),
						leftSide = slider.find('.mkdf-vss-ms-left > div'),
						rightSide = slider.find('.mkdf-vss-ms-right > div');
					
					slider.after(verticalSplitSliderResponsive);
					
					for (var i = 0; i < leftSide.length; i++) {
						verticalSplitSliderResponsive.append($(leftSide[i]).clone(true));
						verticalSplitSliderResponsive.append($(rightSide[leftSide.length - 1 - i]).clone(true));
					}
					
					//prepare google maps clones
					var googleMapHolder = $('.mkdf-vss-responsive .mkdf-google-map');
					if (googleMapHolder.length) {
						googleMapHolder.each(function () {
							var map = $(this);
							map.empty();
							var num = Math.floor((Math.random() * 100000) + 1);
							map.attr('id', 'mkdf-map-' + num);
							map.data('unique-id', num);
						});
					}
					
					if (typeof mkdf.modules.animationHolder.mkdfInitAnimationHolder === "function") {
						mkdf.modules.animationHolder.mkdfInitAnimationHolder();
					}
					
					if (typeof mkdf.modules.button.mkdfButton === "function") {
						mkdf.modules.button.mkdfButton().init();
					}
					
					if (typeof mkdf.modules.elementsHolder.mkdfInitElementsHolderResponsiveStyle === "function") {
						mkdf.modules.elementsHolder.mkdfInitElementsHolderResponsiveStyle();
					}
					
					if (typeof mkdf.modules.googleMap.mkdfShowGoogleMap === "function") {
						mkdf.modules.googleMap.mkdfShowGoogleMap();
					}
					
					if (typeof mkdf.modules.icon.mkdfIcon === "function") {
						mkdf.modules.icon.mkdfIcon().init();
					}
					
					if (typeof mkdf.modules.progressBar.mkdfInitProgressBars === "function") {
						mkdf.modules.progressBar.mkdfInitProgressBars();
					}
				},
				onLeave: function (index, nextIndex) {
					mkdfIntiScrollAnimation(slider, nextIndex);
					mkdfCheckVerticalSplitSectionsForHeaderStyle($($('.mkdf-vss-ms-left .mkdf-vss-ms-section')[nextIndex - 1]).data('header-style'), defaultHeaderStyle);
				}
			});
			
			if (mkdf.windowWidth <= 1024) {
				$.fn.multiscroll.destroy();
			} else {
				$.fn.multiscroll.build();
			}
			
			$(window).resize(function () {
				if (mkdf.windowWidth <= 1024) {
					$.fn.multiscroll.destroy();
				} else {
					$.fn.multiscroll.build();
				}
			});
		}
	}
	
	function mkdfIntiScrollAnimation(slider, nextIndex) {
		
		if (slider.hasClass('mkdf-vss-scrolling-animation')) {
			
			if (nextIndex > 1 && !slider.hasClass('mkdf-vss-scrolled')) {
				slider.addClass('mkdf-vss-scrolled');
			} else if (nextIndex === 1 && slider.hasClass('mkdf-vss-scrolled')) {
				slider.removeClass('mkdf-vss-scrolled');
			}
		}
	}
	
	/*
	 **	Check slides on load and slide change for header style changing
	 */
	function mkdfCheckVerticalSplitSectionsForHeaderStyle(section_header_style, default_header_style) {
		if (section_header_style !== undefined && section_header_style !== '') {
			mkdf.body.removeClass('mkdf-light-header mkdf-dark-header').addClass('mkdf-' + section_header_style + '-header');
		} else if (default_header_style !== '') {
			mkdf.body.removeClass('mkdf-light-header mkdf-dark-header').addClass('mkdf-' + default_header_style + '-header');
		} else {
			mkdf.body.removeClass('mkdf-light-header mkdf-dark-header');
		}
	}
	
})(jQuery);
(function($) {
    'use strict';

    var uncoveringSections = {};
    mkdf.modules.uncoveringSections = uncoveringSections;

    uncoveringSections.mkdfInitUncoveringSections = mkdfInitUncoveringSections;


    uncoveringSections.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitUncoveringSections();
    }

    /*
     **	Init full screen sections shortcode
     */
    function mkdfInitUncoveringSections(){
        var uncoveringSections = $('.mkdf-uncovering-sections');

        if(uncoveringSections.length){
            uncoveringSections.each(function() {
                var thisUS = $(this),
                    thisCurtain = uncoveringSections.find('.curtains'),
                    curtainItems = thisCurtain.find('.mkdf-uss-item'),
                    curtainShadow = uncoveringSections.find('.mkdf-fss-shadow');
                var body = mkdf.body;
                var defaultHeaderStyle = '';
                if (body.hasClass('mkdf-light-header')) {
                    defaultHeaderStyle = 'light';
                } else if (body.hasClass('mkdf-dark-header')) {
                    defaultHeaderStyle = 'dark';
                }

                body.addClass('mkdf-uncovering-section-on-page');
                if(mkdfPerPageVars.vars.mkdfHeaderVerticalWidth > 0 && mkdf.windowWidth > 1024) {
                    curtainItems.css({
                        left : mkdfPerPageVars.vars.mkdfHeaderVerticalWidth,
                        width: 'calc(100% - ' + mkdfPerPageVars.vars.mkdfHeaderVerticalWidth + 'px)'
                    });

                    curtainShadow.css({
                        left : mkdfPerPageVars.vars.mkdfHeaderVerticalWidth,
                        width: 'calc(100% - ' + mkdfPerPageVars.vars.mkdfHeaderVerticalWidth + 'px)'
                    });
                }

                thisCurtain.curtain({
                    scrollSpeed: 400,
                    nextSlide: function() { checkFullScreenSectionsItemForHeaderStyle(thisCurtain, defaultHeaderStyle); },
                    prevSlide: function() { checkFullScreenSectionsItemForHeaderStyle(thisCurtain, defaultHeaderStyle);}
                });

                checkFullScreenSectionsItemForHeaderStyle(thisCurtain, defaultHeaderStyle);
                setResposniveData(thisCurtain);

                thisUS.addClass('mkdf-loaded');
            });
        }
    }

    function checkFullScreenSectionsItemForHeaderStyle(thisUncoveringSections, default_header_style) {
        var section_header_style = thisUncoveringSections.find('.current').data('header-style');
        if (section_header_style !== undefined && section_header_style !== '') {
            mkdf.body.removeClass('mkdf-light-header mkdf-dark-header').addClass('mkdf-' + section_header_style + '-header');
        } else if (default_header_style !== '') {
            mkdf.body.removeClass('mkdf-light-header mkdf-dark-header').addClass('mkdf-' + default_header_style + '-header');
        } else {
            mkdf.body.removeClass('mkdf-light-header mkdf-dark-header');
        }
    }

    function setResposniveData(thisUncoveringSections) {
        var uncoveringSections = thisUncoveringSections.find('.mkdf-uss-item'),
            responsiveStyle = '',
            style = '';

        uncoveringSections.each(function(){
            var thisSection = $(this),
                thisSectionImage = thisSection.find('.mkdf-uss-image-holder'),
                itemClass = '',
                imageLaptop = '',
                imageTablet = '',
                imagePortraitTablet = '',
                imageMobile = '';

            if (typeof thisSection.data('item-class') !== 'undefined' && thisSection.data('item-class') !== false) {
                itemClass = thisSection.data('item-class');
            }

            if (typeof thisSectionImage.data('laptop-image') !== 'undefined' && thisSectionImage.data('laptop-image') !== false) {
                imageLaptop = thisSectionImage.data('laptop-image');
            }
            if (typeof thisSectionImage.data('tablet-image') !== 'undefined' && thisSectionImage.data('tablet-image') !== false) {
                imageTablet = thisSectionImage.data('tablet-image');
            }
            if (typeof thisSectionImage.data('tablet-portrait-image') !== 'undefined' && thisSectionImage.data('tablet-portrait-image') !== false) {
                imagePortraitTablet = thisSectionImage.data('tablet-portrait-image');
            }
            if (typeof thisSectionImage.data('mobile-image') !== 'undefined' && thisSectionImage.data('mobile-image') !== false) {
                imageMobile = thisSectionImage.data('mobile-image');
            }


            if (imageLaptop.length || imageTablet.length || imagePortraitTablet.length || imageMobile.length) {

                if (imageLaptop.length) {
                    responsiveStyle += "@media only screen and (max-width: 1366px) {.mkdf-uss-item." + itemClass + " .mkdf-uss-image-holder { background-image: url(" + imageLaptop + ") !important; } }";
                }
                if (imageTablet.length) {
                    responsiveStyle += "@media only screen and (max-width: 1024px) {.mkdf-uss-item." + itemClass + " .mkdf-uss-image-holder { background-image: url( " + imageTablet + ") !important; } }";
                }
                if (imagePortraitTablet.length) {
                    responsiveStyle += "@media only screen and (max-width: 800px) {.mkdf-uss-item." + itemClass + " .mkdf-uss-image-holder { background-image: url( " + imagePortraitTablet + ") !important; } }";
                }
                if (imageMobile.length) {
                    responsiveStyle += "@media only screen and (max-width: 680px) {.mkdf-uss-item." + itemClass + " .mkdf-uss-image-holder { background-image: url( " + imageMobile + ") !important; } }";
                }
            }
        });

        if (responsiveStyle.length) {
            style = '<style type="text/css">' + responsiveStyle + '</style>';
        }

        if (style.length) {
            $('head').append(style);
        }
    }

})(jQuery);