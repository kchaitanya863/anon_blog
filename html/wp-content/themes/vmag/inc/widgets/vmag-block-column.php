<?php
/**
 * Vmag: Block Posts (Column)
 *
 * Widget to display latest or selected category posts as block one style.
 *
 * @package VMag
 */
add_action( 'widgets_init', 'vmag_register_block_posts_column_widget' );

function vmag_register_block_posts_column_widget() {
    register_widget( 'vmag_block_posts_column' );
}

class Vmag_Block_Posts_Column extends WP_Widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'vmag_block_posts_column',
            'description' => __( 'This widget for showing posts from selected category or latest.', 'vmag' )
        );
        parent::__construct( 'vmag_block_posts_column', __( 'VMag: Block Posts(Column)', 'vmag' ), $widget_ops );
    }


    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

        global $vmag_posts_type, $vmag_cat_dropdown;
        
        $fields = array(

            'block_layout' => array(
                'vmag_widgets_name'         => 'block_layout',
                'vmag_widgets_title'        => __( 'Block Posts (Style 1) layout', 'vmag' ),
                'vmag_widgets_layout_img'   => get_template_directory_uri() .'/inc/assets/images/block-column.png',
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
                'vmag_widgets_default'      => 5,
                'vmag_widgets_field_type'   => 'number'
            ),

            'block_post_type' => array(
                'vmag_widgets_name' => 'block_post_type',
                'vmag_widgets_title' => __( 'Block posts: ', 'vmag' ),
                'vmag_widgets_field_type' => 'radio',
                'vmag_widgets_default' => 'latest_posts',
                'vmag_widgets_field_options' => $vmag_posts_type
            ),

            'block_post_category' => array(
                'vmag_widgets_name' => 'block_post_category',
                'vmag_widgets_title' => __( 'Category for Block Posts', 'vmag' ),
                'vmag_widgets_default'      => 0,
                'vmag_widgets_field_type' => 'select',
                'vmag_widgets_field_options' => $vmag_cat_dropdown
            ),

            'block_view_all_icon' => array(
                'vmag_widgets_name'         => 'block_view_all_icon',
                'vmag_widgets_title'        => __( 'View all Icon', 'vmag' ),
                'vmag_widgets_field_type'   => 'checkbox'
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

        $vmag_block_title   = empty( $instance['block_title'] ) ? '' : $instance['block_title'];
        $vmag_block_title_url   = empty( $instance['block_title_url'] ) ? '' : $instance['block_title_url'];
        $vmag_block_posts_count = empty( $instance['block_posts_count'] ) ? 5 : $instance['block_posts_count'];
        $vmag_block_posts_type    = empty( $instance['block_post_type'] ) ? 'latest_posts' : $instance['block_post_type'];
        $vmag_block_cat_id    = empty( $instance['block_post_category'] ) ? null: $instance['block_post_category'];
        $vmag_block_view_all_icon   = empty( $instance['block_view_all_icon'] ) ? '' : $instance['block_view_all_icon'];
        echo $before_widget;
    ?>
        <div class="block-post-wrapper wow zoomIn" data-wow-duration="1s">
            <div class="block-header clearfix">
                <?php 
                    vmag_widget_title( $vmag_block_title, $vmag_block_title_url );
                    vmag_block_view_all( $vmag_block_view_all_icon, $vmag_block_posts_type, $vmag_block_cat_id );
                ?>
            </div><!-- .block-header-->
            <?php 
                $block_args = vmag_query_args( $vmag_block_posts_type, $vmag_block_posts_count, $vmag_block_cat_id );
                $block_query = new WP_Query( $block_args );
                $post_count = 0;
                $total_posts_count = $block_query->post_count;
                if( $block_query->have_posts() ) {
                    while( $block_query->have_posts() ) {
                        $block_query->the_post();
                        $post_count++;
                        $image_id = get_post_thumbnail_id();
                        $image_path = wp_get_attachment_image_src( $image_id, 'vmag-rectangle-thumb', true );
                        $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                        $post_class = '';
                        if( $post_count == 1 ) { 
                            $post_class = 'first-post'; 
                            $vmag_font_size = 'large-font';
                        } else {
                            $post_class = '';
                            $vmag_font_size = 'small-font';
                        }
            ?>
                        <div class="single-post <?php echo esc_attr( $post_class ); ?> clearfix">
                        <?php if( $post_count == 1 ) { ?>
                            <div class="post-thumb">
                                <?php if( has_post_thumbnail() ) { ?>
                                    <a class="thumb-zoom" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                        <img src="<?php echo esc_url( $image_path[0] ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" title="<?php the_title(); ?>" />
                                        <div class="image-overlay"></div>
                                    </a>
                                <?php } ?>
                                    <?php 
                                        do_action( 'vmag_post_tag_lists' );
                                        do_action( 'vmag_post_format_icon' );
                                    ?>
                            </div>
                        <?php } ?>
                            <h3 class="<?php echo esc_attr( $vmag_font_size ); ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <div class="post-meta clearfix">
                                <?php 
                                    do_action( 'vmag_post_meta' );
                                    vmag_post_comments();
                                ?>
                            </div>
                            <?php 
                                if( $post_count == 1 ) {
                                    $post_content = get_the_content(); 
                                    echo vmag_get_excerpt_content( $post_content, 180 );
                                }
                            ?>
                        </div>
            <?php
                    }
                }
                wp_reset_query();
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