<?php
/**
 * Vmag: Authors List
 *
 * Widget to display authors
 *
 * @package VMag
 */
add_action( 'widgets_init', 'vmag_register_authors_list_widget' );

function vmag_register_authors_list_widget() {
    register_widget( 'vmag_authors_list' );
}

class Vmag_Authors_List extends WP_Widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'vmag_authors_list',
            'description' => __( 'This widget for showing authors which have selected roles.', 'vmag' )
        );
        parent::__construct( 'vmag_authors_list', __( 'VMag: Authors', 'vmag' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

    	global $vmag_admin_roles;
        
        $fields = array(

            'widget_title' => array(
                'vmag_widgets_name'         => 'widget_title',
                'vmag_widgets_title'        => __( 'Widget Title', 'vmag' ),
                'vmag_widgets_field_type'   => 'text'
            ),

            'vmag_author_roles' => array(
                'vmag_widgets_name' => 'vmag_author_roles',
                'vmag_widgets_title' => __( 'Select the user roles you would like to show', 'vmag' ),
                'vmag_widgets_field_type' => 'multicheckboxes',
                'vmag_widgets_field_options' => $vmag_admin_roles
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

        $vmag_widget_title = empty( $instance['widget_title'] ) ? '' : $instance['widget_title'];
        $vmag_author_roles = empty( $instance['vmag_author_roles'] ) ? '' : $instance['vmag_author_roles'];

        echo $before_widget;
    ?>
            <div class="vmag-authors-wrapper">
                <h4 class="block-title"><?php echo esc_html( $vmag_widget_title ); ?></h4>
                    <?php
                        foreach ( $vmag_author_roles as $key => $value ) { 
                            $author_args = array(
                                        'fields'=>'all_with_meta',
                                        'orderby'=>'user_nicename',
                                        'role'=>$key
                                        );
                            $author_query = new WP_User_Query( $author_args );
                            $authors = $author_query->get_results();
                            if ( ! empty( $author_query->results ) ) {
                                foreach ( $author_query->results as $vmag_admin ) {
                                    $vmag_admin_name = $vmag_admin->display_name;
                                    $vmag_admin_nickname = $vmag_admin->user_nicename;
                                    $vmag_admin_id = $vmag_admin->ID;
                                    $vmag_admin_avatar = get_avatar( $vmag_admin_id, '104' );
                    ?>
                                    <div class="single-user" id="user-<?php echo esc_attr( $vmag_admin_id ); ?>">
                                        <a href="<?php echo esc_url( get_author_posts_url( $vmag_admin_id, $vmag_admin_nickname ) ) ;?>" title="<?php echo esc_attr( $vmag_admin_name );?>">
                                            <div class="user-image"><?php echo $vmag_admin_avatar;?></div>
                                            <h3 class="user-name"><?php echo esc_html( $vmag_admin_name );?></h3>
                                        </a>
                                    </div><!-- .single-user -->
                    <?php
                                }
                            }
                        }
                    ?>
            </div><!-- .vmag-authors-wrapper -->
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
            $vmag_widgets_field_value = !empty( $instance[$vmag_widgets_name]) ? $instance[$vmag_widgets_name] : '';
            vmag_widgets_show_widget_field( $this, $widget_field, $vmag_widgets_field_value );
        }
    }
}