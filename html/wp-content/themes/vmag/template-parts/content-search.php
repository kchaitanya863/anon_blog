<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package VMag
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-thumb">
		<?php 
			$image_id = get_post_thumbnail_id();
            $image_path = wp_get_attachment_image_src( $image_id, 'vmag-single-thumb', true );
            $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
			if( has_post_thumbnail() ) { 
		?>
			<a class="thumb-zoom" href="<?php the_permalink(); ?>">
				<img src="<?php echo esc_url( $image_path[0] ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" />
				<div class="image-overlay"></div>
			</a>
		<?php } ?>
		<?php do_action( 'vmag_post_format_icon' ); ?>
	</div>

	<div class="entry-content">
		<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<?php 
			if ( 'post' === get_post_type() ) {
		?>
				<div class="entry-meta">
					<?php vmag_posted_on(); ?>
					<?php vmag_post_cat_lists(); ?>
					<?php vmag_post_comments(); ?>
				</div><!-- .entry-meta -->
		<?php
			}
			$vmag_post_content = get_the_content();
			$vmag_excerpt_length = get_theme_mod( 'vmag_archive_excerpt_lenght', '50' );
			echo '<p>'. vmag_archive_excerpt( $vmag_post_content, $vmag_excerpt_length ) .'</p>';
		?>
		<?php vmag_single_post_tags_list(); ?>
		<?php $vmag_read_more_txt = get_theme_mod( 'vmag_archive_read_more_text', __( 'Read More', 'vmag' ) ); ?>
		<a class="vmag-archive-more" href="<?php the_permalink(); ?>"><?php echo esc_html( $vmag_read_more_txt ); ?></a>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php vmag_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->