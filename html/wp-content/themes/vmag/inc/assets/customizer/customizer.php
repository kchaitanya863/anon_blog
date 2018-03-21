<?php
/**
 * VMag Theme Customizer.
 *
 * @package VMag
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function vmag_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->remove_section('header_image');

	/*------------------------------------------------------------------------------------*/
		/**
		 * Upgrade to Vmag Pro
		*/
		// Register custom section types.
		$wp_customize->register_section_type( 'Vmag_Customize_Section_Pro' );

		// Register sections.
		$wp_customize->add_section(
		    new Vmag_Customize_Section_Pro(
		        $wp_customize,
		        'vmag-pro',
		        array(
		            'title'    => esc_html__( 'Upgrade To Vmag Pro', 'vmag' ),
		            'title1'    => esc_html__( 'Free vs Pro', 'vmag' ),
		            'pro_text' => esc_html__( 'Go Pro', 'vmag' ),
		            'pro_text1' => esc_html__( 'Compare', 'vmag' ),
		            'pro_url'  => 'https://accesspressthemes.com/wordpress-themes/vmag-pro/',
		            'pro_url1'  => admin_url('themes.php?page=vmag-welcome&section=free_vs_pro'),
		            'priority' => 1,
		        )
		    )
		);
}
add_action( 'customize_register', 'vmag_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function vmag_customize_preview_js() {
	wp_enqueue_script( 'vmag_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'vmag_customize_preview_js' );

/**
 * Added customizer scripts
 */
function vmag_customizer_script() {
	wp_enqueue_script( 'vmag-customizer-script', get_template_directory_uri() .'/inc/js/customizer-scripts.js', array("jquery","jquery-ui-draggable"),'', true  );

	wp_enqueue_style( 'vmag-customizer-style', get_template_directory_uri() .'/inc/css/customizer-style.css', array(), '1.0.0' );

}
add_action( 'customize_controls_enqueue_scripts', 'vmag_customizer_script' );