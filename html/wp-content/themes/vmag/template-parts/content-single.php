<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package VMag
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-thumb">
		<?php 
			$image_id = get_post_thumbnail_id();
            $image_path = wp_get_attachment_image_src( $image_id, 'vmag-single-large', true );
            $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
			if( has_post_thumbnail() ) { 
		?>
			<img src="<?php echo esc_url( $image_path[0] ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" />
		<?php } ?>
	</div>

	<?php if ( 'post' === get_post_type() ) { ?>
		<div class="entry-meta clearfix">
			<?php vmag_posted_on(); ?>
			<?php vmag_post_cat_lists(); ?>
			<?php vmag_post_comments(); ?>
		</div><!-- .entry-meta -->
	<?php } ?>

	<div class="entry-content">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'vmag' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'vmag' ),
				'after'  => '</div>',
			) );
		?>
		<?php vmag_single_post_tags_list(); ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php vmag_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->