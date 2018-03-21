<?php
/**
 * The Sidebar containing the footer widget areas.
 * 
 * @package AccessPress Themes
 * @subpackage AccessBuddy
 * @since 1.0.0
 */

/**
 * If none of the sidebars have widgets, then let's bail early.
 */
if ( !is_active_sidebar( 'accessbuddy_footer_sidebar' ) &&
        !is_active_sidebar( 'accessbuddy_footer_sidebar-2' ) &&
        !is_active_sidebar( 'accessbuddy_footer_sidebar-3' ) &&
        !is_active_sidebar( 'accessbuddy_footer_sidebar-4' ) ) {
    return;
}

$accessbuddy_footer_layout = get_theme_mod( 'footer_widget_layout', 'column_three' );

?>
<div class="ab-top-footer footer_<?php echo esc_attr( $accessbuddy_footer_layout ); ?> clearfix">
	<div class="ab-section-container clearfix">
		<div class="ab-footer-widget-wrapper">
			<div class="ab-footer-widget column-first">
				<?php if( is_active_sidebar( 'accessbuddy_footer_sidebar' ) ):
					dynamic_sidebar( 'accessbuddy_footer_sidebar' );
				endif;
				?>
			</div>

			<div class="ab-footer-widget column-second" style="display: <?php if( $accessbuddy_footer_layout == 'column_one' ){ echo 'none'; } else { echo 'block'; }?>;">
				<?php if( is_active_sidebar( 'accessbuddy_footer_sidebar-2' ) ):
					dynamic_sidebar( 'accessbuddy_footer_sidebar-2' );
				endif;
				?>
			</div>

			<div class="ab-footer-widget column-third" style="display: <?php if( $accessbuddy_footer_layout == 'column_one' || $accessbuddy_footer_layout == 'column_two'){ echo 'none'; } else { echo 'block'; }?>;">
				<?php if( is_active_sidebar( 'accessbuddy_footer_sidebar-3' ) ):
					dynamic_sidebar( 'accessbuddy_footer_sidebar-3' );
				endif;
				?>
			</div>

			<div class="ab-footer-widget column-forth" style="display: <?php if( $accessbuddy_footer_layout != 'column_four' ){ echo 'none'; } else { echo 'block'; }?>;">
				<?php if( is_active_sidebar( 'accessbuddy_footer_sidebar-4' ) ):
					dynamic_sidebar( 'accessbuddy_footer_sidebar-4' );
				endif;
				?>
			</div>
		</div><!-- .ab-footer-widget-wrapper -->
	</div><!-- ab-section-container -->
</div><!-- .ab-top-footer -->