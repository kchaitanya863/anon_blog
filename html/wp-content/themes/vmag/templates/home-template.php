<?php
/**
 * Template Name: Home Page
 *
 * Display all widget content related to front page / home page.
 *
 * @package VMag
 */

get_header(); ?>

		<main id="main" class="site-main" role="main">

			<div class="vmag-newsticker-wrapper">
				<div class="vmag-container">
					<?php do_action( 'vmag_news_ticker' ); ?>
				</div>	
			</div><!-- .vmag-newsticker-wrapper -->
			
			<div class="homepage-slider-section">
				<div class="vmag-container">
					<?php
			        	if( is_active_sidebar( 'vmag_featured_slider_area' ) ) {
			            	if ( !dynamic_sidebar( 'vmag_featured_slider_area' ) ):
			            	endif;
			         	}
			        ?>
		        </div>
			</div> <!-- .end of home slider -->

			<div class="homepage-content-wrapper clearfix">
				<div class="vmag-container">
					<div class="vmag-main-content">
						<?php
				        	if( is_active_sidebar( 'vmag_homepage_blocks_area' ) ) {
				            	if ( !dynamic_sidebar( 'vmag_homepage_blocks_area' ) ):
				            	endif;
				         	}
				        ?>
			        </div><!-- .vmag-main-content -->
			        <div class="vmag-home-aside">
			        	<?php
				        	if( is_active_sidebar( 'vmag_homepage_sidebar_area' ) ) {
				            	if ( !dynamic_sidebar( 'vmag_homepage_sidebar_area' ) ):
				            	endif;
				         	}
				        ?>
			        </div><!-- .vmag-home-aside -->
		        </div>
			</div><!-- .homepage-content-wrapper -->
				
			<div class="homepage-fullwidth-wrapper clearfix">
				<div class="vmag-container">
					<?php
			        	if( is_active_sidebar( 'vmag_homepage_fullwidth_area_one' ) ) {
			            	if ( !dynamic_sidebar( 'vmag_homepage_fullwidth_area_one' ) ):
			            	endif;
			         	}
			        ?>
		        </div>
			</div><!-- .homepage-fullwidth-wrapper -->
			<?php $widget_column = vmag_widgets_count( 'vmag_homepage_fullwidth_area_two' ); ?>
			<div class="homepage-second-fullwidth-wrapper <?php echo esc_attr( $widget_column ); ?> clearfix">
				<div class="vmag-container">
					<?php
			        	if( is_active_sidebar( 'vmag_homepage_fullwidth_area_two' ) ) {
			            	if ( !dynamic_sidebar( 'vmag_homepage_fullwidth_area_two' ) ):
			            	endif;
			         	}
			        ?>
			    </div>    
			</div><!-- .homepage-widget-column-wrapper -->

		</main><!-- #main -->

<?php
get_footer();