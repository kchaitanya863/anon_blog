<?php
/**
 * Vmag: Featured Slider
 *
 * Widget to be manage slider section with featured posts which have options to hide featuerd posts.
 *
 * @package VMag
 */
add_action( 'widgets_init', 'vmag_register_featured_slider_widget' );

function vmag_register_featured_slider_widget() {
    register_widget( 'vmag_featured_slider' );
}

class Vmag_Featured_Slider extends WP_Widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
                'vmag_featured_slider', __( 'VMag: Featured Slider', 'vmag' ), array(
                'description' => __( 'This widget for showing slider and featured posts in slider section.', 'vmag' )
                )
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
    	global $vmag_cat_dropdown, $vmag_posts_type;
        $fields = array(

            'slider_section_header' => array(
                'vmag_widgets_name' => 'slider_section_header',
                'vmag_widgets_title' => __( 'Slider Section', 'vmag' ),
                'vmag_widgets_field_type' => 'section_header'
            ),

            'vmag_slide_count' => array(
                'vmag_widgets_name' => 'vmag_slide_count',
                'vmag_widgets_title' => __( 'No of slides', 'vmag' ),
                'vmag_widgets_default' => 5,
                'vmag_widgets_field_type' => 'number'
            ),

            'vmag_slider_post_type' => array(
                'vmag_widgets_name' => 'vmag_slider_post_type',
                'vmag_widgets_title' => __( 'Slider posts: ', 'vmag' ),
                'vmag_widgets_field_type' => 'radio',
                'vmag_widgets_default' => 'latest_posts',
                'vmag_widgets_field_options' => $vmag_posts_type
            ),

            'vmag_slider_category' => array(
                'vmag_widgets_name' => 'vmag_slider_category',
                'vmag_widgets_title' => __( 'Category for Slider', 'vmag' ),
                'vmag_widgets_default'      => 0,
                'vmag_widgets_field_type' => 'select',
                'vmag_widgets_field_options' => $vmag_cat_dropdown
            ),

            'featured_section_header' => array(
                'vmag_widgets_name' => 'featured_section_header',
                'vmag_widgets_title' => __( 'Featured Posts Section', 'vmag' ),
                'vmag_widgets_field_type' => 'section_header'
            ),

            'featured_section_option' => array(
                'vmag_widgets_name' => 'featured_section_option',
                'vmag_widgets_title' => __( 'Featured Section Option', 'vmag' ),
                'vmag_widgets_description' => __( 'Check to disable featured posts section', 'vmag' ),
                'vmag_widgets_field_type' => 'checkbox',
            ),

            'vmag_featured_post_type' => array(
                'vmag_widgets_name' => 'vmag_featured_post_type',
                'vmag_widgets_title' => __( 'Featured posts: ', 'vmag' ),
                'vmag_widgets_field_type' => 'radio',
                'vmag_widgets_default' => 'latest_posts',
                'vmag_widgets_field_options' => $vmag_posts_type
            ),

            'vmag_featured_category' => array(
                'vmag_widgets_name' => 'vmag_featured_category',
                'vmag_widgets_title' => __( 'Category for Featured Posts', 'vmag' ),
                'vmag_widgets_default'      => 0,
                'vmag_widgets_field_type' => 'select',
                'vmag_widgets_field_options' => $vmag_cat_dropdown
            ),
        );
        return $fields;
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        extract( $args );
        if( empty( $instance ) ) {
            return ;
        }

        $vmag_slide_count	= empty( $instance['vmag_slide_count'] ) ? 5 : $instance['vmag_slide_count'];
        $vmag_slider_type 	= empty( $instance['vmag_slider_post_type'] ) ? 'latest_posts' : $instance['vmag_slider_post_type'];
        $vmag_slider_cat_id = empty( $instance['vmag_slider_category'] ) ? 0 : $instance['vmag_slider_category'];
        $featured_option 	= empty( $instance['featured_section_option'] ) ? '' : $instance['featured_section_option'];
        $featured_type 		= empty( $instance['vmag_featured_post_type'] ) ? 'latest_posts' : $instance['vmag_featured_post_type'];
        $featured_cat_id 	= empty( $instance['vmag_featured_category'] ) ? 0 : $instance['vmag_featured_category'];
        echo $before_widget;
    ?>
    		<div class="featured-slider-wrapper">
				<div class="section-wrapper clearfix">
					<div class="slider-section <?php if( !empty( $featured_option ) ) { echo 'slider-fullwidth'; }?>">
						<?php 
							$vmag_slider_args = vmag_query_args( $vmag_slider_type, $vmag_slide_count, $vmag_slider_cat_id  );
							$vmag_slider_query = new WP_Query( $vmag_slider_args );
							if( $vmag_slider_query->have_posts() ) {
								echo '<ul class="featuredSlider cS-hidden">';
								while( $vmag_slider_query->have_posts() ) {
									$vmag_slider_query->the_post();
									$image_id = get_post_thumbnail_id();
                                    if( !empty( $featured_option ) ) {
                                        $image_path = wp_get_attachment_image_src( $image_id, 'vmag-single-large', true );
                                    } else {
                                        $image_path = wp_get_attachment_image_src( $image_id, 'vmag-slider-thumb', true );
                                    }
									
									$image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
									if( has_post_thumbnail() ) {
						?>
										<li class="slide">
											<a class="slider-img thumb-zoom" href="<?php the_permalink(); ?>">
                                                <img src="<?php echo esc_url( $image_path[0] ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" title="<?php the_title(); ?>">
                                            </a>
											<div class="slider-caption">
												<?php do_action( 'vmag_post_tag_lists' ); ?>
												<h3 class="featured-large-font"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
												<div class="post-meta"><?php do_action( 'vmag_post_meta' ); ?></div>
											</div>
										</li>
						<?php
									}
								}
								echo '</ul>';
							}
							wp_reset_query();
						?>						
					</div><!-- .slider-section -->
                    <?php if( empty( $featured_option ) ) { ?>
    					<div class="featured-post-section">
    					<?php 
    						$vmag_featured_args = vmag_query_args( $featured_type, 3, $featured_cat_id  );
    						$vmag_featured_query = new WP_Query( $vmag_featured_args );
    						$post_count = 0;
    						if( $vmag_featured_query->have_posts() ) {
    							while( $vmag_featured_query->have_posts() ) {
    								$vmag_featured_query->the_post();
    								$post_count++;
    								$image_id = get_post_thumbnail_id();
                                    $post_align = '';
    								if( $post_count == 1 ) {
    									$image_path = wp_get_attachment_image_src( $image_id, 'vmag-horizontal-thumb', true );
                                        $vmag_font_size = 'featured-large-font';
    								} else {
    									$image_path = wp_get_attachment_image_src( $image_id, 'vmag-featured-thumb', true );
                                        $vmag_font_size = 'featured-small-font';
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
    								<?php do_action( 'vmag_post_tag_lists' ); ?>
    								<h3 class="<?php echo esc_attr( $vmag_font_size ); ?>"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>
    								<div class="post-meta"><?php do_action( 'vmag_post_meta' ); ?></div>
    							</div>
    						</div>
    					<?php
    							}
    						}
                            wp_reset_query();
    					?>
    					</div><!-- .featured-post-section -->                        
                    <?php } ?>
				</div><!-- .section-wrapper -->
			</div><!-- .featured-slider-wrapper -->
    <?php
        echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param	array	$new_instance	Values just sent to be saved.
     * @param	array	$old_instance	Previously saved values from database.
     *
     * @uses	vmag_widgets_updated_field_value()		defined in vmag-widget-fields.php
     *
     * @return	array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ( $widget_fields as $widget_field ) {

            extract( $widget_field );

            // Use helper function to get updated field values
            $instance[$vmag_widgets_name] = vmag_widgets_updated_field_value( $widget_field, $new_instance[$vmag_widgets_name] );
        }

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param	array $instance Previously saved values from database.
     *
     * @uses	vmag_widgets_show_widget_field()		defined in widget-fields.php
     */
    public function form( $instance ) {
        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ( $widget_fields as $widget_field ) {

            // Make array elements available as variables
            extract( $widget_field );
            $vmag_widgets_field_value = !empty( $instance[$vmag_widgets_name]) ? esc_attr($instance[$vmag_widgets_name] ) : '';
            vmag_widgets_show_widget_field( $this, $widget_field, $vmag_widgets_field_value );
        }
    }
}