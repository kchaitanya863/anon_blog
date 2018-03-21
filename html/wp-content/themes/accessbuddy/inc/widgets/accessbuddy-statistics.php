<?php
/**
 * AB: Statistics
 *
 * Widget to display statistics of buddypress
 *
 * @package AccessPress Themes
 * @subpackage AccessBuddy
 * @since 1.0.0
 *
 */
add_action( 'widgets_init', 'accessbuddy_register_statistics_widget' );

function accessbuddy_register_statistics_widget() {
    register_widget( 'accessbuddy_statistics' );
}

class AccessBuddy_Statistics extends WP_Widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'accessbuddy_statistics',
            'description' => __( 'Display BuddryPress statistics', 'accessbuddy' )
        );
        parent::__construct( 'accessbuddy_statistics', __( 'AB: Statistics', 'accessbuddy' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        
        $fields = array(

            'ab_stat_widget_title' => array(
                'accessbuddy_widgets_name'         => 'ab_stat_widget_title',
                'accessbuddy_widgets_title'        => __( 'Widget Title', 'accessbuddy' ),
                'accessbuddy_widgets_field_type'   => 'text'
            ),

            'ab_stat_widget_info' => array(
                'accessbuddy_widgets_name'         => 'ab_stat_widget_info',
                'accessbuddy_widgets_title'        => __( 'Widget Description', 'accessbuddy' ),
                'accessbuddy_widgets_row'          => 5,    
                'accessbuddy_widgets_field_type'   => 'textarea'
            ),

            'ab_stat_activity_option' => array(
                'accessbuddy_widgets_name'         => 'ab_stat_activity_option',
                'accessbuddy_widgets_title'        => __( 'Activity Stat', 'accessbuddy' ),
                'accessbuddy_widgets_field_type'   => 'checkbox'
            ),

            'ab_stat_members_option' => array(
                'accessbuddy_widgets_name'         => 'ab_stat_members_option',
                'accessbuddy_widgets_title'        => __( 'Members Stat', 'accessbuddy' ),
                'accessbuddy_widgets_field_type'   => 'checkbox'
            ),

            'ab_stat_groups_option' => array(
                'accessbuddy_widgets_name'         => 'ab_stat_groups_option',
                'accessbuddy_widgets_title'        => __( 'Groups Stat', 'accessbuddy' ),
                'accessbuddy_widgets_field_type'   => 'checkbox'
            ),

            'ab_stat_forums_option' => array(
                'accessbuddy_widgets_name'         => 'ab_stat_forums_option',
                'accessbuddy_widgets_title'        => __( 'Forums Stat', 'accessbuddy' ),
                'accessbuddy_widgets_field_type'   => 'checkbox'
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
        $ab_stat_widget_title = empty( $instance['ab_stat_widget_title'] ) ? '' : $instance['ab_stat_widget_title'];
        $ab_stat_widget_info = empty( $instance['ab_stat_widget_info'] ) ? '' : $instance['ab_stat_widget_info'];
        $ab_stat_activity_option = empty( $instance['ab_stat_activity_option'] ) ? '' : $instance['ab_stat_activity_option'];
        $ab_stat_members_option = empty( $instance['ab_stat_members_option'] ) ? '' : $instance['ab_stat_members_option'];
        $ab_stat_groups_option = empty( $instance['ab_stat_groups_option'] ) ? '' : $instance['ab_stat_groups_option'];
        $ab_stat_forums_option = empty( $instance['ab_stat_forums_option'] ) ? '' : $instance['ab_stat_forums_option'];


        echo $before_widget;
    ?>
            <div class="ab-statistics-wrapper">
                <div class="ab-container">
                    <div class="block-header clearfix">
                        <?php echo $args['before_title'] . $ab_stat_widget_title . $args['after_title']; ?>
                        <?php if( !empty( $ab_stat_widget_info ) ){ ?>
                            <p class="ab-widget-info"><?php echo esc_html( $ab_stat_widget_info ); ?></p>
                        <?php } ?>
                    </div><!-- .block-header-->
                    <div class="ab-component-wrap">
                        
                        <?php 
                            if( !empty( $ab_stat_activity_option ) ) {
                                if( ! accessbuddy_is_bp_active() ) {
                                    return;
                                }
                                $ab_activites_count = accessbuddy_get_activity_count_by_user();
                        ?>
                            <div class="stat-col" id="counter-activity">
                                <div class="icon-holder">
                                    <i class="fa fa-wechat"></i>
                                </div>
                                <div class="count-wrapper">
                                    <h4 class="counter"><?php echo esc_attr( $ab_activites_count ); ?></h4>
                                    <span class="counter-title"><?php _e( 'Activity', 'accessbuddy' ); ?></span>
                                </div>
                            </div>
                        <?php } ?>

                        <?php
                            if( !empty( $ab_stat_members_option ) ) {
                                $ab_member_count = bp_get_total_member_count();
                        ?>
                            <div class="stat-col" id="counter-members">
                                <div class="icon-holder">
                                    <i class="fa fa-user-plus"></i>
                                </div>
                                <div class="count-wrapper">
                                    <h4 class="counter"><?php echo esc_attr( $ab_member_count ); ?></h4>
                                    <span class="counter-title"><?php _e( 'Members', 'accessbuddy' ); ?></span>
                                </div>
                            </div>
                        <?php } ?>

                        <?php
                            if( !empty( $ab_stat_groups_option ) ) {
                                $ab_group_count = groups_get_total_group_count();
                        ?>
                            <div class="stat-col" id="counter-groups">
                                <div class="icon-holder">
                                    <i class="fa fa-users"></i>
                                </div>
                                <div class="count-wrapper">
                                    <h4 class="counter"><?php echo esc_attr( $ab_group_count ); ?></h4>
                                    <span class="counter-title"><?php _e( 'Groups', 'accessbuddy' ); ?></span>
                                </div>
                            </div>
                        <?php } ?>

                        <?php
                            if( !empty( $ab_stat_forums_option ) ) {
                                if( ! accessbuddy_is_bbp_active() ) {
                                    return;
                                }
                                $ab_bbp_stat = bbp_get_statistics();
                                $ab_forum_count = $ab_bbp_stat['forum_count'];
                        ?>
                            <div class="stat-col" id="counter-groups">
                                <div class="icon-holder">
                                    <i class="fa fa-forumbee"></i>
                                </div>
                                <div class="count-wrapper">
                                    <h4 class="counter"><?php echo esc_attr( $ab_forum_count ); ?></h4>
                                    <span class="counter-title"><?php _e( 'Forums', 'accessbuddy' ); ?></span>
                                </div>
                            </div>
                        <?php } ?>

                    </div><!-- .ab-component-wrap -->
                </div><!-- .ab-container -->
            </div><!-- .ab-statistics-wrapper -->
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