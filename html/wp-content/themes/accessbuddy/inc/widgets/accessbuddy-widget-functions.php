<?php
/**
 * Custom functions about widgets
 *
 * @package AccessPress Themes
 * @subpackage AccessBuddy
 * @since 1.0.0
 *
 */

/**
 * Load widget files
 */
require ( trailingslashit ( get_template_directory() ) . '/inc/widgets/accessbuddy-widget-fields.php' );
if ( accessbuddy_is_bp_active() ) {
	require ( trailingslashit ( get_template_directory() ) . '/inc/widgets/accessbuddy-statistics.php' );
	require ( trailingslashit ( get_template_directory() ) . '/inc/widgets/accessbuddy-activities-feed.php' );
}
require ( trailingslashit ( get_template_directory() ) . '/inc/widgets/accessbuddy-call-to-action.php' );
require ( trailingslashit ( get_template_directory() ) . '/inc/widgets/accessbuddy-block-column.php' );
require ( trailingslashit ( get_template_directory() ) . '/inc/widgets/accessbuddy-block-layout.php' );
require ( trailingslashit ( get_template_directory() ) . '/inc/widgets/accessbuddy-categories-tabbed.php' );
require ( trailingslashit ( get_template_directory() ) . '/inc/widgets/accessbuddy-three-columns.php' );
require ( trailingslashit ( get_template_directory() ) . '/inc/widgets/accessbuddy-ads-banner.php' );
require ( trailingslashit ( get_template_directory() ) . '/inc/widgets/accessbuddy-block-list.php' );


/*--------------------------------------------------------------------------------------------------------*/
/**
 * Title for tab in Tabbed Widget
 * 
 * @param $tabbed_title string
 * @param $vmag_cat_id intiger
 *
 * @return $tabbed_title or $category_title if parameter is empty
 * @since 1.0.0
 *
 */
if( ! function_exists( 'accessbuddy_tabbed_title' ) ):
	function accessbuddy_tabbed_title( $tabbed_title, $vmag_cat_id ) {
		if( !empty( $tabbed_title ) ) {
			echo $tabbed_title;
		} else {
			echo get_cat_name( $vmag_cat_id );
		}
	}
endif;