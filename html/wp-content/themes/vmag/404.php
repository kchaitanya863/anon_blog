<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package VMag
 */

get_header(); ?>

	<div class="vmag-container">
		<?php do_action( 'vmag_before_body_content' ); ?>
		
		<main id="main" class="site-main" role="main">
		<?php vmag_breadcrumbs(); ?>

			<section class="error-404 not-found">
				<div class="vmag-404">
					<span><?php _e( '4', 'vmag' );?></span>
					<span class="zero"><?php _e( '0', 'vmag' );?></span>
					<span><?php _e( '4', 'vmag' );?></span>
				</div>
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'vmag' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'vmag' ); ?></p>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->
			<?php do_action( 'vmag_related_posts' ); ?>

		</main><!-- #main -->
		
		<?php do_action( 'vmag_after_body_content' ); ?>
	</div><!-- .vmag-container -->

<?php
get_footer();
