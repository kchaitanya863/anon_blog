<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package VMag
 */

get_header(); ?>
	
	<div class="vmag-container">
		<?php do_action( 'vmag_before_body_content' ); ?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
			<?php vmag_breadcrumbs(); ?>
			<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', 'single' );
					
					the_post_navigation();

					/*Post author info*/
					do_action( 'vmag_author_info' );

					/*Related posts*/
					do_action( 'vmag_related_posts' );
					
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
			?>
			</main><!-- #main -->
		</div><!-- #primary -->
		<?php vmag_get_sidebar(); ?>
		<?php do_action( 'vmag_after_body_content' ); ?>
	</div><!-- .vmag-container -->

<?php
get_footer();
