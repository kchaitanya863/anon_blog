<?php
/**
 * The template for displaying archive pages.
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
			if ( have_posts() ) : ?>

				<header class="page-header">
					<?php
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						the_archive_description( '<div class="taxonomy-description">', '</div>' );
					?>
				</header><!-- .page-header -->

				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', 'archive' );

				endwhile;

				the_posts_pagination();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif; ?>

			</main><!-- #main -->
		</div><!-- #primary -->
		<?php vmag_get_sidebar(); ?>
		<?php do_action( 'vmag_after_body_content' ); ?>
	</div><!-- .vmag-container -->

<?php
get_footer();
