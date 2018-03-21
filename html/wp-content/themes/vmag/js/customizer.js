/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );

	//Archive read more button text
    wp.customize( 'vmag_archive_read_more_text', function( value ) {
		value.bind( function( to ) {
			$( '.vmag-archive-more' ).text( to ) ;
		});
	});

	//Related article title
	wp.customize( 'vmag_related_posts_title', function( value ) {
		value.bind( function( to ) {
			$( '.related-title' ).text( to ) ;
		});
	});

	//breadcrumbs home text
	wp.customize( 'vmag_bread_home_txt', function( value ) {
		value.bind( function( to ) {
			$( '#vmag-breadcrumbs' ).find('span:first').text( to ) ;
		});
	});

	//News ticker title
	wp.customize( 'vmag_ticker_caption', function( value ) {
		value.bind( function( to ) {
			$( '.vmag-ticker-caption span' ).text( to ) ;
		});
	});

} )( jQuery );
