<?php
/**
 * AccessBuddy Theme Customizer.
 *
 * @package AccessPress Themes
 * @subpackage AccessBuddy
 * @since 1.0.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function accessbuddy_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'accessbuddy_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function accessbuddy_customize_preview_js() {
	wp_enqueue_script( 'accessbuddy_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'accessbuddy_customize_preview_js' );

/**
 * Enqueue style and scripts for customizer section
 */
function accessbuddy_customize_backend_scripts() {
	/*wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/library/font-awesome/css/font-awesome.min.css', array(), '4.6.3' );*/
	wp_enqueue_style( 'jquery-ui-style', get_template_directory_uri() . '/assets/css/jquery-ui.css' );
	wp_enqueue_style( 'accessbuddy_admin_customizer_style', get_template_directory_uri() . '/assets/css/customizer-style.css' );

	wp_enqueue_script( 'accessbuddy_admin_customizer', get_template_directory_uri() . '/assets/js/customizer-scripts.js', array( 'jquery', 'customize-controls' ), '20160807', true );
}
add_action( 'customize_controls_enqueue_scripts', 'accessbuddy_customize_backend_scripts', 10 );
