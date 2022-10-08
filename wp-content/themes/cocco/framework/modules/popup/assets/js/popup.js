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