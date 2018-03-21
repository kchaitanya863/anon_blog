<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package VMag
 */

if ( ! is_active_sidebar( 'vmag_left_sidebar' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area" role="complementary">
	<?php do_action( 'vmag_before_sidebar' ); ?>
	<?php dynamic_sidebar( 'vmag_left_sidebar' ); ?>
	<?php do_action( 'vmag_after_sidebar' ); ?>
</aside><!-- #secondary -->
