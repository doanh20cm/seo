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