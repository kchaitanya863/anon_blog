<?php
/**
 * AB: Activities Feed
 *
 * Widget to display activities feed from buddypress
 *
 * @package AccessPress Themes
 * @subpackage AccessBuddy
 * @since 1.0.0
 */
add_action( 'widgets_init', 'accessbuddy_register_activities_feed_widget' );

function accessbuddy_register_activities_feed_widget() {
    register_widget( 'accessbuddy_activities_feed' );
}

class AccessBuddy_Activities_Feed extends WP_Widget {
	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'accessbuddy_activities_feed',
            'description' => __( 'Display activites feed from buddypress.', 'accessbuddy' )
        );
        parent::__construct( 'accessbuddy_activities_feed', __( 'AB: Activities Feed', 'accessbuddy' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        
        $fields = array(

            'block_title' => array(
                'accessbuddy_widgets_name'         => 'block_title',
                'accessbuddy_widgets_title'        => __( 'Widget Title', 'accessbuddy' ),
                'accessbuddy_widgets_field_type'   => 'text'
            ),

            'feed_count' => array(
                'accessbuddy_widgets_name'         => 'feed_count',
                'accessbuddy_widgets_title'        => __( 'No. of Feeds', 'accessbuddy' ),
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

        $accessbuddy_block_title   = apply_filters( 'widget_title', empty( $instance['block_title'] ) ? '' : $instance['block_title'], $instance, $this->id_base );
        $accessbuddy_feed_count = empty( $instance['feed_count'] ) ? 5 : $instance['feed_count'];
        echo $before_widget;
    ?>
    	<div class="activities-feed-wrapper">
            <div class="block-header clearfix">
                <?php echo $args['before_title'] . $accessbuddy_block_title . $args['after_title']; ?>
            </div><!-- .block-header-->
            <div class="block-content-wrapper">
                <div id="buddypress">
                    <div class="activity">
                        <ul id="activity-stream" class="activity-list item-list">
                        	<?php 
                        		if ( accessbuddy_is_bp_active() ) {
                                    $activites_args = array( 
                            							'per_page' => $accessbuddy_feed_count,
                            							'max' => 20
                            						);
                            		if ( bp_has_activities( $activites_args ) ) {
                                        while ( bp_activities() ) {
                                            bp_the_activity();
                                            bp_get_template_part( 'activity/entry' );
                                        }
                                        if ( bp_activity_has_more_items() ) : ?>

                                        <!-- <li class="load-more">
                                            <a href="<?php bp_activity_load_more_link() ?>"><?php _e( 'Load More', 'accessbuddy' ); ?></a>
                                        </li> -->

                                    <?php endif; 
                                    }
                                }
                            ?>
                        </ul><!-- #activity-stream -->
                    </div><!-- .activity -->
                </div><!-- #buddypress -->
            </div><!-- .block-content-wrapper -->
        </div><!-- .activities-feed-wrapper -->
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