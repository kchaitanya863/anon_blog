jQuery(document).ready(function($) {
	'use strict';

	/**
	 * News ticker
	 */
	$('#ab-ticker').lightSlider({
		loop:true,
		vertical: true,
		pager:false,
		auto:true,
		speed: 600,
		pause: 3000,
		enableDrag:false,
		verticalHeight:80,
		onSliderLoad: function() {
           $('#ab-ticker').removeClass( 'cS-hidden' );
       }
	});

	/**
	 * Front slider
	 */
	$('#ab-front-slider').lightSlider({
		adaptiveHeight:true,
		item:1,
		mode:'fade',
		slideMargin:0,
		enableDrag:false,
		loop:true,
		pager:false,
		auto:true,
		speed: 2200,
		pause: 4200,
		onSliderLoad: function() {
           $('#ab-front-slider').removeClass( 'cS-hidden' );
       }
	});

	/**
	 * Widget tabbed
	 */
	$('.accessbuddy-cat-tabs').each(function(){
        $(this).find('.cat-tab:first').addClass('active');
    });

    $('.accessbuddy-tabbed-wrapper').each(function(){
        $(this).find('.accessbuddy-tabbed-section:first').show();
    });

    $('#accessbuddy-widget-tabbed li a').click(function(event) {
		var tabId = $(this).attr('id');
		$('.accessbuddy-tabbed-section').hide();
		$('#section-'+tabId).show();
		$('.cat-tab').removeClass('active');
		$(this).parent('li').addClass('active');
	});

	/**
	 * Statistics Counter
	 */
    $('.counter').counterUp({
        delay: 20,
        time: 2000
    });

    $('.ab-menu-toggle').click(function(event) {
    	$('.ab-primary-menu').fadeToggle();
    });

});