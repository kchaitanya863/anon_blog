<?php
/**
 * Define the hook for footer section
 *
 * @package AccessPress Themes
 * @subpackage AccessBuddy
 * @since 1.0.0
 */

/**
 * Footer section start
 */
if( ! function_exists( 'accessbuddy_footer_start' ) ):
	function accessbuddy_footer_start() {
		echo '<footer id="colophon" class="site-footer" role="contentinfo">';
	}
endif;

/**
 * Footer Widget area
 */
if( ! function_exists( 'accessbuddy_footer_widgets_area' ) ):
	function accessbuddy_footer_widgets_area() {
		get_sidebar( 'footer' );
	}
endif;

/**
 * Footer site info before
 */
if( ! function_exists( 'accessbuddy_footer_site_info_before' ) ):
	function accessbuddy_footer_site_info_before() {
		echo '<div class="site-footer-wrapper">';
		echo '<div class="ab-container">';
	}
endif;

/**
 * Footer site info
 */
if( ! function_exists( 'accessbuddy_footer_site_info' ) ):
	function accessbuddy_footer_site_info() {
?>
		<div class="site-info">
			<span class="ab-site-copyright"><?php echo wp_kses_post( get_theme_mod( 'ab_copyright_text', __( '2016 AccessBuddy', 'accessbuddy' ) ) );?></span>
			<span class="sep"> | </span>
			<?php 
				$theme_author_url = esc_url( 'https://accesspressthemes.com/' );
				printf( esc_html__( 'AccessBuddy by %1$s.', 'accessbuddy' ), '<a href="'.$theme_author_url.'" rel="designer">AccessPress Themes</a>' ); ?>
		</div><!-- .site-info -->
<?php
	}
endif;

/**
 * Footer nav section
 */
if( ! function_exists( 'accessbuddy_footer_nav' ) ):
	function accessbuddy_footer_nav(){
?>
		<nav id="footer-site-navigation" class="footer-navigation" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'accessbuddy_foot_menu', 'menu_id' => 'footer-menu', 'fallback_cb' => false  ) ); ?>
		</nav><!-- #site-navigation -->
<?php
	}
endif;

/**
 * Footer site info after
 */
if( ! function_exists( 'accessbuddy_footer_site_info_after' ) ):
	function accessbuddy_footer_site_info_after() {
		echo '</div><!-- .ab-container -->';
		echo '</div><!-- .site-footer-wrapper -->';
	}
endif;

/**
 * End footer section
 */
if( ! function_exists( 'accessbuddy_footer_end' ) ):
	function accessbuddy_footer_end() {
		echo '</footer><!-- #colophon -->';
	}
endif;

add_action( 'accessbuddy_footer', 'accessbuddy_footer_start', 5 );
add_action( 'accessbuddy_footer', 'accessbuddy_footer_widgets_area', 10 );
add_action( 'accessbuddy_footer', 'accessbuddy_footer_site_info_before', 15 );
add_action( 'accessbuddy_footer', 'accessbuddy_footer_site_info', 20 );
add_action( 'accessbuddy_footer', 'accessbuddy_footer_nav', 25 );
add_action( 'accessbuddy_footer', 'accessbuddy_footer_site_info_after', 30 );
add_action( 'accessbuddy_footer', 'accessbuddy_footer_end', 35 );
