<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package AccessPress Themes
 * @subpackage AccessBuddy
 * @since 1.0.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<?php do_action( 'accessbuddy_before_header' ); ?>
	<?php
		/**
		 * accessbuddy top header section
		 *
		 * @hooked accessbuddy_top_header_before - 5 
		 * @hooked accessbuddy_current_date - 10
		 * @hooked accessbuddy_top_nav - 15
		 * @hooked accessbuddy_top_header_after - 20
		 *
		 * @since 1.0.0
		 */
		$ab_top_header_option = get_theme_mod( 'top_header_option', 'show' );
		if( $ab_top_header_option != 'hide' ) {
			do_action( 'accessbuddy_top_header' );
		}
	?>
	
	<?php 
		/**
		 * accessbuddy main header
		 *
		 * @hooked accessbuddy_main_header_before
		 * @hooked accessbuddy_site_logo_ads_before
		 * @hooked accessbuddy_site_logo
		 * @hooked accessbuddy_header_ads
		 * @hooked accessbuddy_site_logo_ads_after
		 * @hooked accessbuddy_primary_menu
		 * @hooked accessbuddy_main_header_after
		 * 
		 * @since 1.0.0
		 */
		do_action( 'accessbuddy_main_header' );
	?>
 
	<?php do_action( 'accessbuddy_after_header' ); ?>
	<?php do_action( 'accessbuddy_before_main' ); ?>

	<div id="content" class="site-content">
		<?php 
			if( is_front_page() && !is_home() ) {
				do_action( 'accessbuddy_news_ticker' );
				get_template_part( 'template-parts/section', 'banner' );
			}
			if( !is_front_page() || is_home() ) {
				echo '<div class="ab-container clearfix">';
			}
		?>
