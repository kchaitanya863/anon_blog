<?php
/**
 * Define custom fields for widgets
 * 
 * @package AccessPress Themes
 * @subpackage AccessBuddy
 * @since 1.0.0
 */
function accessbuddy_widgets_show_widget_field( $instance = '', $widget_field = '', $athm_field_value = '' ) {
    
    extract( $widget_field );

    switch ( $accessbuddy_widgets_field_type ) {

    	// Standard text field
        case 'text' :
        ?>
            <p>
                <label for="<?php echo esc_attr( $instance->get_field_id( $accessbuddy_widgets_name ) ); ?>"><?php echo esc_html( $accessbuddy_widgets_title ); ?>:</label>
                <input class="widefat" id="<?php echo esc_attr( $instance->get_field_id( $accessbuddy_widgets_name ) ); ?>" name="<?php echo esc_attr( $instance->get_field_name( $accessbuddy_widgets_name ) ); ?>" type="text" value="<?php echo esc_attr( $athm_field_value ); ?>" />

                <?php if ( isset( $accessbuddy_widgets_description ) ) { ?>
                    <br />
                    <small><?php echo wp_kses_post( $accessbuddy_widgets_description ); ?></small>
                <?php } ?>
            </p>
        <?php
            break;

        // Standard url field
        case 'url' :
        ?>
            <p>
                <label for="<?php echo esc_attr( $instance->get_field_id( $accessbuddy_widgets_name ) ); ?>"><?php echo esc_html( $accessbuddy_widgets_title ); ?>:</label>
                <input class="widefat" id="<?php echo esc_attr( $instance->get_field_id( $accessbuddy_widgets_name ) ); ?>" name="<?php echo esc_attr( $instance->get_field_name( $accessbuddy_widgets_name ) ); ?>" type="text" value="<?php echo esc_url( $athm_field_value ); ?>" />

                <?php if ( isset( $accessbuddy_widgets_description ) ) { ?>
                    <br />
                    <small><?php echo wp_kses_post( $accessbuddy_widgets_description ); ?></small>
                <?php } ?>
            </p>
        <?php
            break;

        // Textarea field
        case 'textarea' :
        ?>
            <p>
                <label for="<?php echo esc_attr( $instance->get_field_id( $accessbuddy_widgets_name ) ); ?>"><?php echo esc_html( $accessbuddy_widgets_title ); ?>:</label>
                <textarea class="widefat" rows="<?php echo intval( $accessbuddy_widgets_row ); ?>" id="<?php echo esc_attr( $instance->get_field_id( $accessbuddy_widgets_name ) ); ?>" name="<?php echo esc_attr( $instance->get_field_name( $accessbuddy_widgets_name ) ); ?>"><?php echo wp_kses_post ( $athm_field_value ); ?></textarea>
            </p>
        <?php
            break;

        // Checkbox field
        case 'checkbox' :
        ?>
            <p>
                <input id="<?php echo esc_attr( $instance->get_field_id( $accessbuddy_widgets_name ) ); ?>" name="<?php echo esc_attr( $instance->get_field_name( $accessbuddy_widgets_name ) ); ?>" type="checkbox" value="1" <?php checked('1', $athm_field_value); ?>/>
                <label for="<?php echo esc_attr( $instance->get_field_id( $accessbuddy_widgets_name ) ); ?>"><?php echo esc_html( $accessbuddy_widgets_title ); ?>:</label>

                <?php if ( isset( $accessbuddy_widgets_description ) ) { ?>
                    <br />
                    <small><?php echo wp_kses_post( $accessbuddy_widgets_description ); ?></small>
                <?php } ?>
            </p>
        <?php
            break;

        // Radio fields
        case 'radio' :
        	if( empty( $athm_field_value ) ) {
        		$athm_field_value = $accessbuddy_widgets_default;
        	}
        ?>
            <p>
                <?php
                echo $accessbuddy_widgets_title;
                echo '<br />';
                foreach ( $accessbuddy_widgets_field_options as $athm_option_name => $athm_option_title ) {
                    ?>
                    <input id="<?php echo esc_attr( $instance->get_field_id( $athm_option_name ) ); ?>" name="<?php echo esc_attr( $instance->get_field_name( $accessbuddy_widgets_name ) ); ?>" type="radio" value="<?php echo esc_attr( $athm_option_name ); ?>" <?php checked( $athm_option_name, $athm_field_value ); ?> />
                    <label for="<?php echo esc_attr( $instance->get_field_id( $accessbuddy_widgets_name ) ); ?>"><?php echo esc_html( $accessbuddy_widgets_title ); ?>:</label>
                    <br />
                <?php } ?>

                <?php if ( isset( $accessbuddy_widgets_description ) ) { ?>
                    <small><?php echo wp_kses_post( $accessbuddy_widgets_description ); ?></small>
                <?php } ?>
            </p>
        <?php
            break;

        // Select field
        case 'select' :
            if( empty( $athm_field_value ) ) {
                $athm_field_value = $accessbuddy_widgets_default;
            }
        ?>
            <p>
                <label for="<?php echo esc_attr( $instance->get_field_id( $accessbuddy_widgets_name ) ); ?>"><?php echo esc_html( $accessbuddy_widgets_title ); ?>:</label>
                <select name="<?php echo esc_attr( $instance->get_field_name( $accessbuddy_widgets_name ) ); ?>" id="<?php echo esc_attr( $instance->get_field_id( $accessbuddy_widgets_name ) ); ?>" class="widefat">
                    <?php foreach ( $accessbuddy_widgets_field_options as $athm_option_name => $athm_option_title ) { ?>
                        <option value="<?php echo $athm_option_name; ?>" id="<?php echo esc_attr( $instance->get_field_id($athm_option_name) ); ?>" <?php selected( $athm_option_name, $athm_field_value ); ?>><?php echo esc_html( $athm_option_title ); ?></option>
                    <?php } ?>
                </select>

                <?php if ( isset( $accessbuddy_widgets_description ) ) { ?>
                    <br />
                    <small><?php echo wp_kses_post( $accessbuddy_widgets_description ); ?></small>
                <?php } ?>
            </p>
        <?php
            break;

        case 'number' :
        	if( empty( $athm_field_value ) ) {
        		$athm_field_value = $accessbuddy_widgets_default;
        	}
        ?>
            <p>
                <label for="<?php echo esc_attr( $instance->get_field_id( $accessbuddy_widgets_name ) ); ?>"><?php echo esc_html( $accessbuddy_widgets_title ); ?>:</label>
                <input name="<?php echo esc_attr( $instance->get_field_name( $accessbuddy_widgets_name ) ); ?>" type="number" step="1" min="1" id="<?php echo esc_attr( $instance->get_field_id( $accessbuddy_widgets_name ) ); ?>" value="<?php echo esc_attr( $athm_field_value ); ?>" class="small-text" />

                <?php if ( isset( $accessbuddy_widgets_description ) ) { ?>
                    <br />
                    <small><?php echo wp_kses_post( $accessbuddy_widgets_description ); ?></small>
                <?php } ?>
            </p>
       	<?php
            break;

        case 'section_header':
        ?>
        	<span class="section-header"><?php echo esc_attr( $accessbuddy_widgets_title ); ?></span>
        <?php
        	break;

        case 'widget_layout_image':
        ?>
            <div class="layout-image-wrapper">
                <img src="<?php echo esc_url( $accessbuddy_widgets_layout_img ); ?>" title="<?php _e( 'Widget Layout', 'accessbuddy' ); ?>" />
            </div>
        <?php
            break;

        case 'upload' :

            $output = '';
            $id = $instance->get_field_id( $accessbuddy_widgets_name );
            $class = '';
            $int = '';
            $value = $athm_field_value;
            $name = $instance->get_field_name( $accessbuddy_widgets_name );

            if ( $value ) {
                $class = ' has-file';
                $value = explode( 'wp-content', $value );
                $value = content_url().$value[1];
            }
            $output .= '<div class="sub-option widget-upload">';
            $output .= '<label for="' . $instance->get_field_id( $accessbuddy_widgets_name ) . '">' . $accessbuddy_widgets_title . '</label><br/>';
            $output .= '<input id="' . esc_attr( $id ) . '" class="upload' . esc_attr( $class ) . '" type="text" name="' . esc_attr( $name ) . '" value="' . $value . '" placeholder="' . __( 'No file chosen', 'accessbuddy' ) . '" />' . "\n";
            if ( function_exists( 'wp_enqueue_media' ) ) {
                if ( ( $value == '') ) {
                    $output .= '<input id="upload-' . esc_attr( $id ) . '" class="ap-upload-button button" type="button" value="' . __( 'Upload', 'accessbuddy' ) . '" />' . "\n";
                } else {
                    $output .= '<input id="remove-' . esc_attr( $id ) . '" class="remove-file button" type="button" value="' . __( 'Remove', 'accessbuddy' ) . '" />' . "\n";
                }
            } else {
                $output .= '<p><i>' . __( 'Upgrade your version of WordPress for full media support.', 'accessbuddy' ) . '</i></p>';
            }

            $output .= '<div class="screenshot upload-thumb" id="' . esc_attr( $id ) . '-image">' . "\n";

            if ( $value != '' ) {
                $remove = '<a class="remove-image">'. __( 'Remove', 'accessbuddy' ).'</a>';
                $attachment_id = accessbuddy_get_attachment_id_from_url( $value );
                $image_array = wp_get_attachment_image_src( $attachment_id, 'large' );
                $image = preg_match( '/(^.*\.jpg|jpeg|png|gif|ico*)/i', $value );
                if ( $image ) {
                    $output .= '<img src="' . $image_array[0] . '" alt="" />';
                } else {
                    $parts = explode( "/", $value );
                    for ( $i = 0; $i < sizeof( $parts ); ++$i ) {
                        $title = $parts[$i];
                    }

                    // No output preview if it's not an image.
                    $output .= '';

                    // Standard generic output if it's not an image.
                    $title = __( 'View File', 'accessbuddy' );
                    $output .= '<div class="no-image"><span class="file_link"><a href="' . $value . '" target="_blank" rel="external">' . $title . '</a></span></div>';
                }
            }
            $output .= '</div></div>' . "\n";
            echo $output;
            break;

        //Multi checkboxes
        case 'multicheckboxes':
            if( isset( $accessbuddy_widgets_title ) ) {
            ?>
                <label><?php echo esc_html( $accessbuddy_widgets_title ); ?>:</label>
            <?php
            }
            foreach ( $accessbuddy_widgets_field_options as $athm_option_name => $athm_option_title) {
                if( isset( $athm_field_value[$athm_option_name] ) ) {
                    $athm_field_value[$athm_option_name] = 1;
                }else{
                    $athm_field_value[$athm_option_name] = 0;
                }
                
            ?>
                <p>
                    <input id="<?php echo $instance->get_field_id($athm_option_name); ?>" name="<?php echo $instance->get_field_name($accessbuddy_widgets_name).'['.$athm_option_name.']'; ?>" type="checkbox" value="1" <?php checked( '1', $athm_field_value[$athm_option_name] ); ?>/>
                    <label for="<?php echo $instance->get_field_id($athm_option_name); ?>"><?php echo $athm_option_title; ?></label>
                </p>
            <?php
                }
                if ( isset( $accessbuddy_widgets_description ) ) {
            ?>
                    <small><?php echo wp_kses_post( $accessbuddy_widgets_description ); ?></small>
            <?php
                }
        break;
    }
}

function accessbuddy_widgets_updated_field_value( $widget_field, $new_field_value ) {

    extract( $widget_field );

    // Allow only integers in number fields
    if ( $accessbuddy_widgets_field_type == 'number') {
        return accessbuddy_sanitize_number( $new_field_value );

        // Allow some tags in textareas
    } elseif ( $accessbuddy_widgets_field_type == 'textarea' ) {
        // Check if field array specifed allowed tags
        if ( !isset( $accessbuddy_widgets_allowed_tags ) ) {
            // If not, fallback to default tags
            $accessbuddy_widgets_allowed_tags = '<p><strong><em><a>';
        }
        return strip_tags( $new_field_value, $accessbuddy_widgets_allowed_tags );

        // No allowed tags for all other fields
    } elseif ( $accessbuddy_widgets_field_type == 'url' ) {
        return esc_url( $new_field_value );
    } elseif ( $accessbuddy_widgets_field_type == 'multicheckboxes' ) {
        return $new_field_value;
    } else {
        return strip_tags( $new_field_value );
    }
}