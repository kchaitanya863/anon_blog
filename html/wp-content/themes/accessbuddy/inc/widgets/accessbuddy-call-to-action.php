<?php
/**
 * AB: Call To Action
 *
 * Widget to display call to action content.
 *
 * @package AccessPress Themes
 * @subpackage AccessBuddy
 * @since 1.0.0
 *
 */
add_action( 'widgets_init', 'accessbuddy_register_cta_widget' );

function accessbuddy_register_cta_widget() {
    register_widget( 'accessbuddy_call_to_action' );
}

class AccessBuddy_Call_To_Action extends WP_Widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'accessbuddy_call_to_action',
            'description' => __( 'Display call to action content.', 'accessbuddy' )
        );
        parent::__construct( 'accessbuddy_call_to_action', __( 'AB: Call To Action', 'accessbuddy' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        
        $fields = array(

            'widget_conetnt' => array(
                'accessbuddy_widgets_name'         => 'widget_conetnt',
                'accessbuddy_widgets_title'        => __( 'Widget Content', 'accessbuddy' ),
                'accessbuddy_widgets_row'          => 5,
                'accessbuddy_widgets_field_type'   => 'textarea'
            ),

            'widget_button_text' => array(
                'accessbuddy_widgets_name'         => 'widget_button_text',
                'accessbuddy_widgets_title'        => __( 'Widget Button Text', 'accessbuddy' ),
                'accessbuddy_widgets_field_type'   => 'text'
            ),

            'widget_button_url' => array(
                'accessbuddy_widgets_name'         => 'widget_button_url',
                'accessbuddy_widgets_title'        => __( 'Widget Button Url', 'accessbuddy' ),
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
        
        $accessbuddy_widget_content = empty( $instance['widget_conetnt'] ) ? '' : $instance['widget_conetnt'];
        $accessbuddy_widget_button_text = empty( $instance['widget_button_text'] ) ? '' : $instance['widget_button_text'];
        $accessbuddy_widget_button_url = empty( $instance['widget_button_url'] ) ? '' : $instance['widget_button_url'];

        echo $before_widget;
    ?>
        <div class="ab-cta-wrapper">
            <div class="ab-container">
                <div class="cta-content"><?php echo esc_html( $accessbuddy_widget_content ); ?></div>
                <div class="ab-cta-btn">
                    <a href="<?php echo esc_url( $accessbuddy_widget_button_url ); ?>" class="ab-btn" target="_blank" />
                        <?php echo esc_html( $accessbuddy_widget_button_text ); ?>
                    </a>
                </div>
            </div><!--. ab-container -->
        </div><!-- .ab-cta-wrapper -->
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
            $accessbuddy_widgets_field_value = !empty( $instance[$accessbuddy_widgets_name]) ? $instance[$accessbuddy_widgets_name] : '';
            accessbuddy_widgets_show_widget_field( $this, $widget_field, $accessbuddy_widgets_field_value );
        }
    }
}