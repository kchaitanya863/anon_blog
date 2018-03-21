<?php
/**
 * Vmag: Categories Tabbed
 *
 * Widget to display selected category posts as on tabbed.
 *
 * @package VMag
 */
add_action( 'widgets_init', 'vmag_register_categories_tabbed_widget' );

function vmag_register_categories_tabbed_widget() {
    register_widget( 'vmag_categories_tabbed' );
}

class Vmag_Categories_Tabbed extends WP_Widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'vmag_categories_tabbed',
            'description' => __( 'This widget for showing category post in tabbed.', 'vmag' )
        );
        parent::__construct( 'vmag_categories_tabbed', __( 'VMag: Categories Tabbed', 'vmag' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

        global $vmag_cat_dropdown;
        
        $fields = array(

            'block_layout' => array(
                'vmag_widgets_name'         => 'block_layout',
                'vmag_widgets_title'        => __( 'Category Tabbed layout', 'vmag' ),
                'vmag_widgets_layout_img'   => get_template_directory_uri() .'/inc/assets/images/category-tabbed.png',
                'vmag_widgets_field_type'   => 'widget_layout_image'
            ),

            'first_tabbed_section_header' => array(
                'vmag_widgets_name' => 'first_tabbed_section_header',
                'vmag_widgets_title' => __( 'First Tab', 'vmag' ),
                'vmag_widgets_field_type' => 'section_header'
            ),

            'first_tab_title' => array(
                'vmag_widgets_name'         => 'first_tab_title',
                'vmag_widgets_title'        => __( 'Tab Title', 'vmag' ),
                'vmag_widgets_field_type'   => 'text'
            ),

            'first_tab_category' => array(
                'vmag_widgets_name' => 'first_tab_category',
                'vmag_widgets_title' => __( 'Select Category for First Tab', 'vmag' ),
                'vmag_widgets_default'      => 0,
                'vmag_widgets_field_type' => 'select',
                'vmag_widgets_field_options' => $vmag_cat_dropdown
            ),

            'second_tabbed_section_header' => array(
                'vmag_widgets_name' => 'second_tabbed_section_header',
                'vmag_widgets_title' => __( 'Second Tab', 'vmag' ),
                'vmag_widgets_field_type' => 'section_header'
            ),

            'second_tab_title' => array(
                'vmag_widgets_name'         => 'second_tab_title',
                'vmag_widgets_title'        => __( 'Tab Title', 'vmag' ),
                'vmag_widgets_field_type'   => 'text'
            ),

            'second_tab_category' => array(
                'vmag_widgets_name' => 'second_tab_category',
                'vmag_widgets_title' => __( 'Select Category for Second Tab', 'vmag' ),
                'vmag_widgets_default'      => 0,
                'vmag_widgets_field_type' => 'select',
                'vmag_widgets_field_options' => $vmag_cat_dropdown
            ),

            'third_tabbed_section_header' => array(
                'vmag_widgets_name' => 'third_tabbed_section_header',
                'vmag_widgets_title' => __( 'Third Tab', 'vmag' ),
                'vmag_widgets_field_type' => 'section_header'
            ),

            'third_tab_title' => array(
                'vmag_widgets_name'         => 'third_tab_title',
                'vmag_widgets_title'        => __( 'Tab Title', 'vmag' ),
                'vmag_widgets_field_type'   => 'text'
            ),

            'third_tab_category' => array(
                'vmag_widgets_name' => 'third_tab_category',
                'vmag_widgets_title' => __( 'Select Category for Third Tab', 'vmag' ),
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

        $vmag_first_tab_title = empty( $instance['first_tab_title'] ) ? '' : $instance['first_tab_title'];
        $vmag_second_tab_title = empty( $instance['second_tab_title'] ) ? '' : $instance['second_tab_title'];
        $vmag_third_tab_title = empty( $instance['third_tab_title'] ) ? '' : $instance['third_tab_title'];

        $vmag_first_tab_cat_id = empty( $instance['first_tab_category'] ) ? 0: $instance['first_tab_category'];
        $vmag_second_tab_cat_id = empty( $instance['second_tab_category'] ) ? 0: $instance['second_tab_category'];
        $vmag_third_tab_cat_id = empty( $instance['third_tab_category'] ) ? 0: $instance['third_tab_category'];


    	echo $before_widget;
   	?>
   		<div class="vmag-tabbed-wrapper wow fadeInUp" data-wow-duration="1s">
   			<ul class="vmag-cat-tabs clearfix" id="vmag-widget-tabbed">
                <?php if( $vmag_first_tab_cat_id ) { ?>
	                <li class="cat-tab first-tabs">
	                    <a href="javascript:void(0)" id="tabfirst"><?php vmag_tabbed_title( $vmag_first_tab_title, $vmag_first_tab_cat_id ); ?></a>
	                </li>
                <?php } ?>
                <?php if( $vmag_second_tab_cat_id ) { ?>
	                <li class="cat-tab second-tabs">
	                    <a href="javascript:void(0)" id="tabsecond"><?php vmag_tabbed_title( $vmag_second_tab_title, $vmag_second_tab_cat_id ); ?></a>
	                </li>
                <?php } ?>
                <?php if( $vmag_third_tab_cat_id ) { ?>
	                <li class="cat-tab third-tabs">
	                    <a href="javascript:void(0)" id="tabthird"><?php vmag_tabbed_title( $vmag_third_tab_title, $vmag_third_tab_cat_id ); ?></a>
	                </li>
                <?php } ?>
           </ul>

           	<?php if( $vmag_first_tab_cat_id ) { ?>
           		<div id="section-tabfirst" class="vmag-tabbed-section" style="display: none;">
           			<?php
	                    $first_tab_args = array(  
	                                'post_type' => 'post',
	                                'category__in' => $vmag_first_tab_cat_id,
	                                'posts_per_page' => 3,
	                            );
	                    $first_tab_query = new WP_Query( $first_tab_args );
	                    if( $first_tab_query->have_posts() ) {
	                        while( $first_tab_query->have_posts() ) {
	                            $first_tab_query->the_post();
	                            $image_id = get_post_thumbnail_id();
	                            $image_path = wp_get_attachment_image_src( $image_id, 'vmag-small-thumb', true );
	                            $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
	            	?>
	                            <div class="single-post clearfix">
	                                <div class="post-thumb">
	                                    <?php if( has_post_thumbnail() ) { ?>
	                                        <a class="thumb-zoom" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
	                                            <img src="<?php echo esc_url( $image_path[0] ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" title="<?php the_title(); ?>" />
                                                <div class="image-overlay"></div>
	                                        </a>
	                                    <?php } ?>
	                                </div>
	                                <div class="post-caption clearfix">
	                                    <h3 class="small-font"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	                                    <div class="post-meta">
	                                        <?php do_action( 'vmag_post_meta' ); ?>
	                                    </div>
	                                </div><!-- .post-caption -->
	                            </div><!-- .single-post -->
	            	<?php
	                        }
	                    }
                        wp_reset_query();
	            	?>
            	</div><!-- #tabfirst -->
            <?php } ?>
            <?php if( $vmag_second_tab_cat_id ) { ?>
	            <div id="section-tabsecond" class="vmag-tabbed-section" style="display: none;">
	           		<?php
	                    $second_tab_args = array(  
	                                'post_type' => 'post',
	                                'category__in' => $vmag_second_tab_cat_id,
	                                'posts_per_page' => 3,
	                            );
	                    $second_tab_query = new WP_Query( $second_tab_args );
	                    if( $second_tab_query->have_posts() ) {
	                        while( $second_tab_query->have_posts() ) {
	                            $second_tab_query->the_post();
	                            $image_id = get_post_thumbnail_id();
	                            $image_path = wp_get_attachment_image_src( $image_id, 'vmag-small-thumb', true );
	                            $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
	            	?>
	                            <div class="single-post clearfix">
	                                <div class="post-thumb">
	                                    <?php if( has_post_thumbnail() ) { ?>
	                                        <a class="thumb-zoom" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
	                                            <img src="<?php echo esc_url( $image_path[0] ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" title="<?php the_title(); ?>" />
                                                <div class="image-overlay"></div>
	                                        </a>
	                                    <?php } ?>
	                                </div>
	                                <div class="post-caption clearfix">
	                                    <h3 class="small-font"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	                                    <div class="post-meta">
	                                        <?php do_action( 'vmag_post_meta' ); ?>
	                                    </div>
	                                </div><!-- .post-caption -->
	                            </div><!-- .single-post -->
	            	<?php
	                        }
	                    }
                        wp_reset_query();
	            	?>
            	</div><!-- #tabsecond -->
            <?php } ?>
            <?php if( $vmag_third_tab_cat_id ) { ?>
	            <div id="section-tabthird" class="vmag-tabbed-section" style="display: none;">
	           		<?php 
	                
	                    $third_tab_args = array(  
	                                'post_type' => 'post',
	                                'category__in' => $vmag_third_tab_cat_id,
	                                'posts_per_page' => 3,
	                            );
	                    $third_tab_query = new WP_Query( $third_tab_args );
	                    if( $third_tab_query->have_posts() ) {
	                        while( $third_tab_query->have_posts() ) {
	                            $third_tab_query->the_post();
	                            $image_id = get_post_thumbnail_id();
	                            $image_path = wp_get_attachment_image_src( $image_id, 'vmag-small-thumb', true );
	                            $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
	            	?>
	                            <div class="single-post clearfix">
	                                <div class="post-thumb">
	                                    <?php if( has_post_thumbnail() ) { ?>
	                                        <a class="thumb-zoom" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
	                                            <img src="<?php echo esc_url( $image_path[0] ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" title="<?php the_title(); ?>" />
                                                <div class="image-overlay"></div>
	                                        </a>
	                                    <?php } ?>
	                                </div>
	                                <div class="post-caption clearfix">
	                                    <h3 class="small-font"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	                                    <div class="post-meta">
	                                        <?php do_action( 'vmag_post_meta' ); ?>
	                                    </div>
	                                </div><!-- .post-caption -->	                                
	                            </div><!-- .single-post -->
	            	<?php
	                        }
	                    }
                        wp_reset_query();
	            	?>
            	</div><!-- #tabthird -->
            <?php } ?>
   		</div><!-- .vmag-tabbed-wrapper -->
   	<?php
    	echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param   array   $new_instance   Values just sent to be saved.
     * @param   array   $old_instance   Previously saved values from database.
     *
     * @uses    vmag_widgets_updated_field_value()      defined in vmag-widget-fields.php
     *
     * @return  array Updated safe values to be saved.
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
     * @param   array $instance Previously saved values from database.
     *
     * @uses    vmag_widgets_show_widget_field()        defined in vmag-widget-fields.php
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
