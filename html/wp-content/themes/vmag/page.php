<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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

					get_template_part( 'template-parts/content', 'page' );

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
