jQuery(document).ready(function($) {
	'use strict';

	/**
     * Radio Image control in customizer
     */
    // Use buttonset() for radio images.
    $( '.ab-meta-options-wrap .buttonset' ).buttonset();


    /**
     * Meta tabs and its content
     */
    $('.ab-meta-menu-wrapper li').click(function() {
        var tabIdRaw = $(this).attr('id');
        var tabId = tabIdRaw.split('-');
        $('.ab-single-meta').hide();
        $('#ab-'+tabId[1]+'-content').fadeIn();
    });
});