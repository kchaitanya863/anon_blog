<?php
/**
 * The Sidebar containing the footer widget areas.
 * 
 * @package Vmag
 */
/**
 * If none of the sidebars have widgets, then let's bail early.
 */
if ( !is_active_sidebar( 'vmag_footer_widget_column_first' ) &&
        !is_active_sidebar( 'vmag_footer_widget_column_second' ) &&
        !is_active_sidebar( 'vmag_footer_widget_column_third' ) &&
        !is_active_sidebar( 'vmag_footer_widget_column_forth' ) ) {
    return;
}

$vmag_footer_layout = get_theme_mod( 'vmag_footer_widget_layout', 'column_three' );

?>
<div class="vmag-top-footer footer_<?php echo esc_attr( $vmag_footer_layout ); ?> clearfix">
	<div class="vmag-footer-widget-wrapper">
		<div class="vmag-footer-widget column-first">
			<?php if( is_active_sidebar( 'vmag_footer_widget_column_first' ) ):
				dynamic_sidebar( 'vmag_footer_widget_column_first' );
			endif;
			?>
		</div>

		<div class="vmag-footer-widget column-second" style="display: <?php if( $vmag_footer_layout == 'column_one' ){ echo 'none'; } else { echo 'block'; }?>;">
			<?php if( is_active_sidebar( 'vmag_footer_widget_column_second' ) ):
				dynamic_sidebar( 'vmag_footer_widget_column_second' );
			endif;
			?>
		</div>

		<div class="vmag-footer-widget column-third" style="display: <?php if( $vmag_footer_layout == 'column_one' || $vmag_footer_layout == 'column_two'){ echo 'none'; } else { echo 'block'; }?>;">
			<?php if( is_active_sidebar( 'vmag_footer_widget_column_third' ) ):
				dynamic_sidebar( 'vmag_footer_widget_column_third' );
			endif;
			?>
		</div>

		<div class="vmag-footer-widget column-forth" style="display: <?php if( $vmag_footer_layout != 'column_four' ){ echo 'none'; } else { echo 'block'; }?>;">
			<?php if( is_active_sidebar( 'vmag_footer_widget_column_forth' ) ):
				dynamic_sidebar( 'vmag_footer_widget_column_forth' );
			endif;
			?>
		</div>
	</div><!-- .vmag-footer-widget-wrapper -->
</div><!-- .vmag-top-footer -->
