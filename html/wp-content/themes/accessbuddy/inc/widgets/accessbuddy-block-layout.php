<?php
/**
 * AB: Block Posts Layout
 *
 * Widget to display latest or selected category posts as block layout
 *
 * @package AccessPress Themes
 * @subpackage AccessBuddy
 * @since 1.0.0
 *
 */
add_action( 'widgets_init', 'accessbuddy_register_block_posts_layout_widget' );

function accessbuddy_register_block_posts_layout_widget() {
    register_widget( 'accessbuddy_block_posts_layout' );
}

class AccessBuddy_Block_Posts_Layout extends WP_Widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'accessbuddy_block_posts_layout',
            'description' => __( 'Display posts from selected category or latest.', 'accessbuddy' )
        );
        parent::__construct( 'accessbuddy_block_posts_layout', __( 'AB: Block Posts Layout', 'accessbuddy' ), $widget_ops );
    }


    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

        global $accessbuddy_cat_dropdown;
        
        $fields = array(

            'block_layout' => array(
                'accessbuddy_widgets_name'         => 'block_layout',
                'accessbuddy_widgets_title'        => __( 'Block Posts layout', 'accessbuddy' ),
                'accessbuddy_widgets_layout_img'   => get_template_directory_uri() .'/assets/images/block-layout.png',
                'accessbuddy_widgets_field_type'   => 'widget_layout_image'
            ),

            'block_title' => array(
                'accessbuddy_widgets_name'         => 'block_title',
                'accessbuddy_widgets_title'        => __( 'Block Title', 'accessbuddy' ),
                'accessbuddy_widgets_field_type'   => 'text'
            ),

            'block_post_category' => array(
                'accessbuddy_widgets_name' => 'block_post_category',
                'accessbuddy_widgets_title' => __( 'Category for Block Posts', 'accessbuddy' ),
                'accessbuddy_widgets_default'      => 0,
                'accessbuddy_widgets_field_type' => 'select',
                'accessbuddy_widgets_field_options' => $accessbuddy_cat_dropdown
            ),

            'block_posts_count' => array(
                'accessbuddy_widgets_name'         => 'block_posts_count',
                'accessbuddy_widgets_title'        => __( 'No. of Posts', 'accessbuddy' ),
                'accessbuddy_widgets_default'      => 5,
                'accessbuddy_widgets_field_type'   => 'number'
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

        $accessbuddy_block_title   = empty( $instance['block_title'] ) ? '' : $instance['block_title'];        
        $accessbuddy_block_posts_count = empty( $instance['block_posts_count'] ) ? 5 : $instance['block_posts_count'];
        $accessbuddy_block_cat_id    = empty( $instance['block_post_category'] ) ? null: $instance['block_post_category'];
        echo $before_widget;
    ?>
        <div class="block-post-wrapper clearfix">
            <div class="block-header clearfix">
                <?php echo $args['before_title'] . $accessbuddy_block_title . $args['after_title']; ?>
            </div><!-- .block-header-->
            <div class="block-content-wrapper">            
            <?php 
                $block_args = array(
                                'category__in' => $accessbuddy_block_cat_id,
                                'posts_per_page' => $accessbuddy_block_posts_count
                            );
                $block_query = new WP_Query( $block_args );
                $post_count = 0;
                $total_posts_count = $block_query->post_count;
                if( $block_query->have_posts() ) {
                    while( $block_query->have_posts() ) {
                        $block_query->the_post();
                        $post_count++;
                        $image_id = get_post_thumbnail_id();
                        $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                        if( $post_count == 1 ) {
                            $accessbuddy_font_size = 'large-font';
                            $image_path = wp_get_attachment_image_src( $image_id, 'accessbuddy-rectangle-thumb', true );
                            echo '<div class="left-post-wrapper wow fadeInDown" data-wow-duration="0.7s">';
                        } elseif( $post_count == 2 ) {
                            $accessbuddy_font_size = 'small-font';
                            $image_path = wp_get_attachment_image_src( $image_id, 'accessbuddy-small-thumb', true );
                            $accessbuddy_animate_class = 'fadeInUp';
                            echo '<div class="right-posts-wrapper wow fadeInUp" data-wow-duration="0.7s">';
                        } else {
                            $accessbuddy_font_size = 'small-font';
                            $image_path = wp_get_attachment_image_src( $image_id, 'accessbuddy-small-thumb', true );
                        }
            ?>
                        <div class="single-post clearfix">
                            <div class="post-thumb">
                                <?php if( has_post_thumbnail() ) { ?>
                                    <a class="thumb-zoom" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                        <img src="<?php echo esc_url( $image_path[0] ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" title="<?php the_title(); ?>" />
                                        <div class="image-overlay"></div>
                                    </a>
                                <?php } ?>
                                <?php 
                                    if( $post_count == 1 ) { 
                                        accessbuddy_post_categories_lists();
                                        accessbuddy_post_format_icon();
                                    } 
                                ?>
                            </div><!-- .post-thumb -->
                            <div class="post-caption-wrapper">
                                <h3 class="<?php echo esc_attr( $accessbuddy_font_size ); ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="post-meta clearfix">
                                    <?php accessbuddy_posted_on(); ?>
                                </div>
                            </div><!-- .post-caption-wrapper -->
                            <?php 
                                if( $post_count == 1 ) {
                                    $post_content = get_the_content();
                                    echo accessbuddy_get_excerpt_content( $post_content, 130 );
                                }
                            ?>
                        </div><!-- .single-post -->
            <?php
                        if( $post_count == 1 || $post_count == $total_posts_count ) {
                            echo '</div>';
                        }
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
     * @uses    accessbuddy_widgets_updated_field_value()      defined in accessbuddy-widget-fields.php
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
            $instance[$accessbuddy_widgets_name] = accessbuddy_widgets_updated_field_value( $widget_field, $new_instance[$accessbuddy_widgets_name] );
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
     * @uses    accessbuddy_widgets_show_widget_field()        defined in accessbuddy-widget-fields.php
     */
    public function form( $instance ) {
        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ( $widget_fields as $widget_field ) {

            // Make array elements available as variables
            extract( $widget_field );
            $accessbuddy_widgets_field_value = !empty( $instance[$accessbuddy_widgets_name]) ? esc_attr($instance[$accessbuddy_widgets_name] ) : '';
            accessbuddy_widgets_show_widget_field( $this, $widget_field, $accessbuddy_widgets_field_value );
        }
    }
}