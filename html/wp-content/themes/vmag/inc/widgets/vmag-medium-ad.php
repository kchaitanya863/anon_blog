<?php
/**
 * Vmag: Leaderboard ads
 *
 * Widget to display ads size of 300x250
 *
 * @package VMag
 */
add_action( 'widgets_init', 'vmag_register_medium_ads_widget' );

function vmag_register_medium_ads_widget() {
    register_widget( 'vmag_medium_ad' );
}

class Vmag_Medium_Ad extends WP_Widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'vmag_medium_ad',
            'description' => __( 'This widget for showing ads in size of medium rectangle', 'vmag' )
        );
        parent::__construct( 'vmag_medium_ad', __( 'VMag: Medium Rectangle Ads (300x250)', 'vmag' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        
        $fields = array(

            'ad_banner_title' => array(
                'vmag_widgets_name'         => 'ad_banner_title',
                'vmag_widgets_title'        => __( 'Banner Title', 'vmag' ),
                'vmag_widgets_field_type'   => 'text'
            ),

            'ad_banner_image' => array(
                'vmag_widgets_name' => 'ad_banner_image',
                'vmag_widgets_title' => __( 'Banner Image', 'vmag' ),
                'vmag_widgets_field_type' => 'upload',
            ),

            'ad_banner_url' => array(
                'vmag_widgets_name'         => 'ad_banner_url',
                'vmag_widgets_title'        => __( 'Banner Url', 'vmag' ),
                'vmag_widgets_field_type'   => 'url'
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

        $vmag_banner_title = empty( $instance['ad_banner_title'] ) ? '' : $instance['ad_banner_title'];
        $vmag_banner_image   = empty( $instance['ad_banner_image'] ) ? '' : $instance['ad_banner_image'];
        $vmag_banner_url   = empty( $instance['ad_banner_url'] ) ? '' : $instance['ad_banner_url'];
        echo $before_widget;
        if( !empty( $vmag_banner_image ) ) {
    ?>
            <div class="medium-rectangle-wrapper">
                <h4 class="block-title"><?php echo esc_html( $vmag_banner_title ); ?></h4>
                <?php
                    if( !empty( $vmag_banner_url ) ) {
                ?>
                    <a href="<?php echo esc_url( $vmag_banner_url );?>"><img src="<?php echo esc_url( $vmag_banner_image ); ?>" /></a>
                <?php
                    } else {
                ?>
                    <img src="<?php echo esc_url( $vmag_banner_image ); ?>" />
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