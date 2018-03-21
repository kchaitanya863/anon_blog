<?php
/**
 * Define sanitize functions for customizer fields
 *
 * @package AccessPress Themes
 * @subpackage AccessBuddy
 * @since 1.0.0
 */

/**
 * Sanitize number field
 *
 * @since 1.0.0
 */
function accessbuddy_sanitize_number( $input ) {
    $output = intval($input);
     return $output;
}

/**
 * Sanitize checkbox field
 *
 * @since 1.0.0
 */
function accessbuddy_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}

/**
 * Sanitize switch button
 *
 * @since 1.0.0
 */
function accessbuddy_sanitize_switch_option( $input ) {
    $valid_keys = array(
            'show'  => esc_html__( 'Show', 'accessbuddy' ),
            'hide'  => esc_html__( 'Hide', 'accessbuddy' )
        );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * Sanitize switch button ( Enable/Disable )
 *
 * @since 1.0.0
 */
function accessbuddy_sanitize_enable_switch_option( $input ) {
    $valid_keys = array(
            'enable'    => esc_html__( 'Enable', 'accessbuddy' ),
            'disable'   => esc_html__( 'Disable', 'accessbuddy' )
        );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * Sanitize switch button for menu
 *
 * @since 1.0.0
 */
function accessbuddy_sanitize_menu_switch_option( $input ) {
    $valid_keys = array(
            'parallax'  => esc_html__( 'Parallax', 'accessbuddy' ),
            'default'   => esc_html__( 'Default', 'accessbuddy' )
        );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * Sanitize multiple categories for blog
 *
 * @since 1.0.0
 */
function accessbuddy_multiple_categories_sanitize( $values ) {

    $multi_values = !is_array( $values ) ? explode( ',', $values ) : $values;

    return !empty( $multi_values ) ? array_map( 'sanitize_text_field', $multi_values ) : array();
}

/**
 * Callback function for slider banner controls
 *
 * @since 1.0.0
 */
function accessbuddy_is_slider_banner( $control ) {
    if ( $control->manager->get_setting( 'front_banner_layout' )->value() == 'slider_banner' || $control->manager->get_setting( 'front_banner_layout' )->value() == 'slider_featured_banner' ) {
        return true;
    } else {
        return false;
    }
}

/**
 * Callback function for static banner controls
 *
 * @since 1.0.0
 */
function accessbuddy_is_static_banner( $control ) {
    if ( $control->manager->get_setting( 'front_banner_layout' )->value() == 'static_banner' ) {
        return true;
    } else {
        return false;
    }
}

/**
 * Callback function for static banner controls
 *
 * @since 1.0.0
 */
function accessbuddy_is_slider_featured_banner( $control ) {
    if ( $control->manager->get_setting( 'front_banner_layout' )->value() == 'slider_featured_banner' ) {
        return true;
    } else {
        return false;
    }
}

/**
 * Callback function for Choices
 *
 * @since 1.0.0
 */
function accessbuddy_sanitize_choice( $input, $setting ) {

  // Ensure input is a slug.
  $input = sanitize_key( $input );

  // Get list of choices from the control associated with the setting.
  $choices = $setting->manager->get_control( $setting->id )->choices;

  // If the input is a valid key, return it; otherwise, return the default.
  return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}