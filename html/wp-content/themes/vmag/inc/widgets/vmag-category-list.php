<?php
/**
 * Vmag: Category Posts (Lists)
 *
 * Widget to display selected category posts as on list style.
 *
 * @package VMag
 */
add_action( 'widgets_init', 'vmag_register_category_posts_list_widget' );

function vmag_register_category_posts_list_widget() {
    register_widget( 'vmag_category_posts_list' );
}

class Vmag_Category_Posts_List extends WP_Widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'vmag_category_posts_list',
            'description' => __( 'This widget for showing posts from selected category as list.', 'vmag' )
        );
        parent::__construct( 'vmag_category_posts_list', __( 'VMag: Category Posts(List)', 'vmag' ), $widget_ops );
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
                'vmag_widgets_title'        => __( 'Category Posts (List) layout', 'vmag' ),
                'vmag_widgets_layout_img'   => get_template_directory_uri() .'/inc/assets/images/block-list.png',
                'vmag_widgets_field_type'   => 'widget_layout_image'
            ),

            'block_title' => array(
                'vmag_widgets_name'         => 'block_title',
                'vmag_widgets_title'        => __( 'Block Title', 'vmag' ),
                'vmag_widgets_field_type'   => 'text'
            ),

            'block_title_url' => array(
                'vmag_widgets_name'         => 'block_title_url',
                'vmag_widgets_title'        => __( 'Block Title Url', 'vmag' ),
                'vmag_widgets_field_type'   => 'url'
            ),

            'block_posts_count' => array(
                'vmag_widgets_name'         => 'block_posts_count',
                'vmag_widgets_title'        => __( 'No. of Posts', 'vmag' ),
                'vmag_widgets_default'      => 4,
                'vmag_widgets_field_type'   => 'number'
            ),

            'block_post_category' => array(
                'vmag_widgets_name' => 'block_post_category',
                'vmag_widgets_title' => __( 'Select Category for Lists', 'vmag' ),
                'vmag_widgets_default'      => 0,
                'vmag_widgets_field_type' => 'select',
                'vmag_widgets_field_options' => $vmag_cat_dropdown
            )
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

        $vmag_block_title   = empty( $instance['block_title'] ) ? '' : $instance['block_title'];
        $vmag_block_title_url   = empty( $instance['block_title_url'] ) ? '' : $instance['block_title_url'];
        $vmag_block_posts_count = empty( $instance['block_posts_count'] ) ? 4 : $instance['block_posts_count'];
        $vmag_block_cat_id    = empty( $instance['block_post_category'] ) ? 0: $instance['block_post_category'];
        echo $before_widget;
    ?>
        <div class="block-post-wrapper wow fadeInUp" data-wow-duration="1s">
            <?php vmag_widget_title( $vmag_block_title, $vmag_block_title_url ); ?>
            <?php 
                if( !empty( $vmag_block_cat_id ) ) {
                    $block_args = array(  
                                'post_type' => 'post',
                                'category__in' => $vmag_block_cat_id,
                                'posts_per_page' => $vmag_block_posts_count,
                            );
                    $block_query = new WP_Query( $block_args );
                    if( $block_query->have_posts() ) {
                        while( $block_query->have_posts() ) {
                            $block_query->the_post();
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
                }
            ?>
        </div><!-- .block-post-wrapper -->
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