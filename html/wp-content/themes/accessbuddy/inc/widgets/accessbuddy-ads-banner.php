<?php
/**
 * AB: Ads Banner
 *
 * Widget to display ads size of 728x90 or 300x250
 *
 * @package AccessPress Themes
 * @subpackage AccessBuddy
 * @since 1.0.0
 */
add_action( 'widgets_init', 'accessbuddy_register_ads_banner_widget' );

function accessbuddy_register_ads_banner_widget() {
    register_widget( 'accessbuddy_ads_banner' );
}

class AccessBuddy_Ads_Banner extends WP_Widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'accessbuddy_ads_banner',
            'description' => __( 'This widget for showing ads in size of leaderboard or medium size', 'accessbuddy' )
        );
        parent::__construct( 'accessbuddy_ads_banner', __( 'AB: Ads Banner', 'accessbuddy' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

        $ads_banner_type = array(
                            'leaderboard'   => esc_html__( 'Leaderboard (728x90) ', 'accessbuddy' ),
                            'medium'        => esc_html__( 'Medium (300x250)', 'accessbuddy' )
                        );
        
        $fields = array(

            'ad_banner_title' => array(
                'accessbuddy_widgets_name'         => 'ad_banner_title',
                'accessbuddy_widgets_title'        => __( 'Banner Title', 'accessbuddy' ),
                'accessbuddy_widgets_field_type'   => 'text'
            ),

            'ad_banner_type' => array(
                'accessbuddy_widgets_name'         => 'ad_banner_type',
                'accessbuddy_widgets_title'        => __( 'Ads Banner Type', 'accessbuddy' ),
                'accessbuddy_widgets_default'      => 'leaderboard',
                'accessbuddy_widgets_field_type'   => 'radio',
                'accessbuddy_widgets_field_options' => $ads_banner_type
            ),

            'ad_banner_image' => array(
                'accessbuddy_widgets_name' => 'ad_banner_image',
                'accessbuddy_widgets_title' => __( 'Banner Image', 'accessbuddy' ),
                'accessbuddy_widgets_field_type' => 'upload',
            ),

            'ad_banner_url' => array(
                'accessbuddy_widgets_name'         => 'ad_banner_url',
                'accessbuddy_widgets_title'        => __( 'Banner Url', 'accessbuddy' ),
                'accessbuddy_widgets_field_type'   => 'url'
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

        $accessbuddy_banner_title = empty( $instance['ad_banner_title'] ) ? '' : $instance['ad_banner_title'];
        $accessbuddy_banner_image   = empty( $instance['ad_banner_image'] ) ? '' : $instance['ad_banner_image'];
        $accessbuddy_banner_url   = empty( $instance['ad_banner_url'] ) ? '' : $instance['ad_banner_url'];
        $accessbuddy_banner_type = empty( $instance['ad_banner_type'] ) ? 'leaderboard' : $instance['ad_banner_type'];
        echo $before_widget;
        if( !empty( $accessbuddy_banner_image ) ) {
    ?>
            <div class="banner-wrapper <?php echo esc_attr( $accessbuddy_banner_type ); ?>">
                <?php if( !empty( $accessbuddy_banner_title ) ) { ?>
                    <h4 class="block-title"><?php echo esc_html( $accessbuddy_banner_title ); ?></h4>
                <?php } ?>
                <?php
                    if( !empty( $accessbuddy_banner_url ) ) {
                ?>
                    <a href="<?php echo esc_url( $accessbuddy_banner_url );?>"><img src="<?php echo esc_url( $accessbuddy_banner_image ); ?>" /></a>
                <?php
                    } else {
                ?>
                    <img src="<?php echo esc_url( $accessbuddy_banner_image ); ?>" />
                <?php
                    }
                ?>
            </div>  
    <?php
        }
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