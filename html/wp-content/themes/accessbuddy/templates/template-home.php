<?php
/**
 * Template Name: Home Page
 * The template for displaying Homepage content.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package AccessPress Themes
 * @subpackage AccessBuddy
 * @since 1.0.0
 */

get_header(); ?>

	<div class="homepage-top-fullwidth">
		<?php
        	if( is_active_sidebar( 'accessbuddy_home_top_fullwidth' ) ) {
            	if ( !dynamic_sidebar( 'accessbuddy_home_top_fullwidth' ) ):
            	endif;
         	}
        ?>
	</div> <!-- .end of homepage top fullwidth -->

	<div class="home-main-section clearfix">
		<div class="ab-container">
			<div id="home-primary">
				<?php
		        	if( is_active_sidebar( 'accessbuddy_home_main' ) ) {
		            	if ( !dynamic_sidebar( 'accessbuddy_home_main' ) ):
		            	endif;
		         	}
		        ?>
			</div><!-- #home-primary -->
			<div id="home-aside">
				<?php
		        	if( is_active_sidebar( 'accessbuddy_home_main_aside' ) ) {
		            	if ( !dynamic_sidebar( 'accessbuddy_home_main_aside' ) ):
		            	endif;
		         	}
		        ?>
			</div><!-- #home-aside -->
		</div><!-- .ab-container -->
	</div><!-- .home-main-section -->

	<div class="homepage-bottom-fullwidth clearfix">
		<div class="ab-container">
			<?php
	        	if( is_active_sidebar( 'accessbuddy_bottom_home_fullwidth' ) ) {
	            	if ( !dynamic_sidebar( 'accessbuddy_bottom_home_fullwidth' ) ):
	            	endif;
	         	}
	        ?>
        </div><!-- .ab-container -->
	</div> <!-- .end of homepage top fullwidth -->

<?php
get_footer();
