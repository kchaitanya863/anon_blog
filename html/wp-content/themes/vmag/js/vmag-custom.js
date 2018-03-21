/**
 * Vmag Custom JS
 *
 * @package VMag
 *
 * Distributed under the MIT license - http://opensource.org/licenses/MIT
 */

jQuery(document).ready(function($) {
	"use strict";
	
	$('.featuredSlider').lightSlider({
		adaptiveHeight:true,
		item:1,
		slideMargin:0,
		enableDrag:false,
		loop:true,
		pager:false,
		auto:true,
		speed: 700,
		pause: 4200,
		onSliderLoad: function() {
           $('.featuredSlider').removeClass( 'cS-hidden' );
       }
	});

	$('#vmag-news-ticker').lightSlider({
		loop:true,
		vertical: true,
		pager:false,
		auto:true,
		speed: 600,
		pause: 3000,
		enableDrag:false,
		verticalHeight:80,
		onSliderLoad: function() {
           $('#vmag-news-ticker').removeClass( 'cS-hidden' );
       }
	});

	$('.block-carousel').lightSlider({
		pager:false,
		speed:650,
		enableDrag:false,
		responsive : [
            {
                breakpoint:840,
                settings: {
                    item:2,
                    slideMove:1,
                    slideMargin:6,
                  }
            },
            {
                breakpoint:480,
                settings: {
                    item:1,
                    slideMove:1
                  }
            }
        ],
        onSliderLoad: function() {
           $('.block-carousel').removeClass( 'cS-hidden' );
       }
	});

	$('.widget-cat-slider').lightSlider({
	    adaptiveHeight:true,
		item:1,
		slideMargin:0,
		loop:true,
		controls:false,
		enableDrag:false,
		speed: 700,
		onSliderLoad: function() {
           $('.widget-cat-slider').removeClass( 'cS-hidden' );
       }
	});

	$('.vmag-search-in-primary').click(function(event) {
		$('.vmag-search-form-primary').toggleClass( 'search-in' );
	});

	//Vmag navigation
	$('.nav-toggle').click(function() {
	    $('.nav-wrapper .menu').slideToggle('slow');
	    $(this).parent('.nav-wrapper').toggleClass('active');
	});

	$('.nav-wrapper .menu-item-has-children').append('<span class="sub-toggle"> <i class="fa fa-angle-right"></i> </span>');
	$('.nav-wrapper .page_item_has_children').append('<span class="sub-toggle-children"> <i class="fa fa-angle-right"></i> </span>');

	$('.nav-wrapper .sub-toggle').click(function() {
	    $(this).parent('.menu-item-has-children').children('ul.sub-menu').first().slideToggle('1000');
	    $(this).children('.fa-angle-right').first().toggleClass('fa-angle-down');
	});

	$('.nav-wrapper .sub-toggle-children').click(function() {
	    $(this).parent('.page_item_has_children').children('ul.children').first().slideToggle('1000');
	    $(this).children('.fa-angle-right').first().toggleClass('fa-angle-down');
	});

	// Widget tabbed
	$('.vmag-cat-tabs').each(function(){
        $(this).find('.cat-tab:first').addClass('active');
    });

    $('.vmag-tabbed-wrapper').each(function(){
        $(this).find('.vmag-tabbed-section:first').show();
    });

    $('#vmag-widget-tabbed li a').click(function(event) {
		var tabId = $(this).attr('id');
		$('.vmag-tabbed-section').hide();
		$('#section-'+tabId).show();
		$('.cat-tab').removeClass('active');
		$(this).parent('li').addClass('active');
	});

	var WowOptionVal = WowOption.mode;
	if( WowOption.mode == 'enable' && $('body').hasClass('home') ) {
		new WOW().init();	
	}

	//Top up arrow
    $("#scroll-up").hide();
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 1000) {
				$('#scroll-up').fadeIn();
			} else {
				$('#scroll-up').fadeOut();
			}
		});
		$('a#scroll-up').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});
    
	
});