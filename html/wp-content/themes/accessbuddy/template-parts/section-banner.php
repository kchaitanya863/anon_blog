<?php
/**
 * Display the content of banner section
 *
 * @package AccessPress Themes
 * @subpackage AccessBuddy
 * @since 1.0.0
 *
 */
$ab_banner_option = get_theme_mod( 'front_banner_option', 'show' );
if( $ab_banner_option != 'hide' ) {

	$ab_banner_layout = get_theme_mod( 'front_banner_layout', 'static_banner' );
	if( $ab_banner_layout == 'slider_banner' || $ab_banner_layout == 'slider_featured_banner' ) {

		$ab_slider_cat_id = get_theme_mod( 'slider_cat_id', '0' );
		$ab_featured_posts_cat_id = get_theme_mod( 'featured_posts_cat_id', '0' );

		if( $ab_banner_layout == 'slider_featured_banner' && !empty( $ab_featured_posts_cat_id ) ) {
			echo '<div class="section-slider-wrapper"><div class="ab-container">';
		}

		if( !empty( $ab_slider_cat_id ) ) {
			if( $ab_banner_layout != 'slider_featured_banner' ) {
				$slider_class = 'slider-full';
			} else {
				$slider_class = 'slider-with-featured';
			}
		?>
			<div class="ab-front-slider-wrapper <?php echo esc_attr( $slider_class ); ?>">
			<?php
				$ab_slider_args = array(
									'category__in' => $ab_slider_cat_id
								);
				$ab_slider_query = new WP_Query( $ab_slider_args );
				if( $ab_slider_query->have_posts() ) {
					echo '<ul id="ab-front-slider" class="cS-hidden">';
					while ( $ab_slider_query->have_posts() ) {
						$ab_slider_query->the_post();
						if( has_post_thumbnail() ) {
					?>
							<li>
								<div class="slider-image-wrap">		
									<figure>
										<?php 
											if( $ab_banner_layout == 'slider_featured_banner' && !empty( $ab_featured_posts_cat_id ) ) {
												the_post_thumbnail( 'accessbuddy-slider-thumb' ); 
											} else {
												the_post_thumbnail( 'accessbuddy-slider-large' );
											}
										?>
									</figure>
								</div><!-- .slider-image-wrap -->
								<div class="slider-info"><?php the_content(); ?></div><!-- .slider-info -->
							</li>
					<?php
						}
					}
					echo '</ul>';
				}
				wp_reset_query();
			?>
			</div><!-- .ab-front-slider-wrapper -->
		<?php
		}
		if( $ab_banner_layout == 'slider_featured_banner' && !empty( $ab_featured_posts_cat_id ) ) {
	?>
			<div class="featured-post-section">
				<?php 
					$accessbuddy_featured_args = array( 
											'category_in' => $ab_featured_posts_cat_id,
											'posts_per_page' => 3
										);
					$accessbuddy_featured_query = new WP_Query( $accessbuddy_featured_args );
					$post_count = 0;
					if( $accessbuddy_featured_query->have_posts() ) {
						while( $accessbuddy_featured_query->have_posts() ) {
							$accessbuddy_featured_query->the_post();
							$post_count++;
							$image_id = get_post_thumbnail_id();
                            $post_align = '';
							if( $post_count == 1 ) {
								$image_path = wp_get_attachment_image_src( $image_id, 'accessbuddy-horizontal-thumb', true );
                                $accessbuddy_font_size = 'featured-large-font';
							} else {
								$image_path = wp_get_attachment_image_src( $image_id, 'accessbuddy-featured-thumb', true );
                                $accessbuddy_font_size = 'featured-small-font';
							}								
							$image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                            if( $post_count == 2 ) {
                                $post_align = 'left';
                            } elseif( $post_count == 3 ) {
                                $post_align = 'right';
                            }

				?>
					<div class="featured-article <?php echo esc_attr( $post_align ); ?> ">
                        <?php if( has_post_thumbnail() ) { ?>
							<a class="featured-img thumb-zoom" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                <img src="<?php echo esc_url( $image_path[0] ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" title="<?php the_title(); ?>">
                                <div class="image-overlay"></div>
                            </a>
                        <?php } ?>
						<div class="post-caption">
							<?php do_action( 'accessbuddy_post_tag_lists' ); ?>
							<h3 class="<?php echo esc_attr( $accessbuddy_font_size ); ?>"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>
							<div class="post-meta"><?php accessbuddy_posted_on(); ?></div>
						</div>
					</div>
				<?php
						}
					}
                    wp_reset_query();
				?>
			</div><!-- .featured-post-section -->
	<?php
			echo '</div><!-- .ab-container --></div>';
		}
	} else {
		$ab_static_banner_image = get_theme_mod( 'ab_static_banner_image', '' );
		$ab_static_banner_title = get_theme_mod( 'ab_static_banner_title', __( 'Get Connected', 'accessbuddy' ) );
		$ab_static_banner_info = get_theme_mod( 'ab_static_banner_info', '' );
	?>
		<div class="ab-static-banner-wrapper" style="background-image: url('<?php echo esc_url( $ab_static_banner_image ); ?>')">
			<div class="static-banner-content">
				<?php if( !empty( $ab_static_banner_title ) ) { ?>
					<h1 class="banner-title"><?php echo esc_html( $ab_static_banner_title ); ?></h1>
				<?php } ?>
				<?php if( !empty( $ab_static_banner_info ) ) { ?>
					<p class="banner-info"><?php echo wp_kses_post( $ab_static_banner_info ); ?></p>
				<?php } ?>
			</div>

			<?php if( is_active_sidebar( 'accessbuddy_home_banner_area' ) ): ?>
				<div class="ab-banner-widget-area">
					<?php dynamic_sidebar( 'accessbuddy_home_banner_area' ); ?>
				</div><!-- .ab-banner-widget-area -->
			<?php endif; ?>
		</div><!-- .ab-static-banner-wrapper -->
	<?php
	}
}