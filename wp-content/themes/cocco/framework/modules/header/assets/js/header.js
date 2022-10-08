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