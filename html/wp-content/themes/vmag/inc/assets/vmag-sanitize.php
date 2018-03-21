<?php
/**
 * Sanitize for all fields
 * 
 * @package VMag
 */

//Text
function vmag_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

// Number
function vmag_sanitize_number( $input ) {
    $output = intval($input);
     return $output;
}

//Checkbox
function vmag_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}

// site layout
function vmag_sanitize_site_layout( $input ) {
    $valid_keys = array(
            'fullwidth_layout' => esc_html__( 'Full Width Layout', 'vmag' ),
            'boxed_layout'     => esc_html__( 'Boxed Layout', 'vmag' )
        );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

//switch option
function vmag_sanitize_switch_option( $input ) {
    $valid_keys = array(
            'show'  => esc_html__( 'Show', 'vmag' ),
            'hide'  => esc_html__( 'Hide', 'vmag' )
        );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

//switch option for enable/disable
function vmag_sanitize_switch_enable_option( $input ) {
    $valid_keys = array(
            'enable'  => esc_html__( 'Enable', 'vmag' ),
            'disable'  => esc_html__( 'Disable', 'vmag' )
        );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}


// page sidebar
function vmag_sanitize_page_sidebar( $input ) {
    $valid_keys = array(
            'right_sidebar' => get_template_directory_uri() . '/inc/assets/images/right-sidebar.png',
            'left_sidebar' => get_template_directory_uri() . '/inc/assets/images/left-sidebar.png',
            'no_sidebar' => get_template_directory_uri() . '/inc/assets/images/no-sidebar.png',
            'no_sidebar_center' => get_template_directory_uri() . '/inc/assets/images/no-sidebar-center.png'
        );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

//Related Post type
function vmag_sanitize_related_type( $input ) {
    $valid_keys = array(
            'related_cat'   => esc_html__( 'Related Posts by Category', 'vmag' ),
            'related_tag'   => esc_html__( 'Related Posts by Tags', 'vmag' )
        );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

//Footer widget column
function vmag_sanitize_footer_widget( $input ) {
    $valid_keys = array(
            'column_one'   => esc_html__( 'One Column', 'vmag' ),
            'column_two'   => esc_html__( 'Two Columns', 'vmag' ),
            'column_three'   => esc_html__( 'Three Columns', 'vmag' ),
            'column_four'   => esc_html__( 'Four Columns', 'vmag' )
        );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * Callback functions
 */
function vmag_related_post_option_callback( $control ) {
    if ( $control->manager->get_setting('vmag_related_posts_option')->value() == 'show' ) {
        return true;
    } else {
        return false;
    }
}