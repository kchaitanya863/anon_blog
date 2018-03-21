<?php
/**
 * AccessBuddy Theme Customizer for General Settings Panel.
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

if( ! function_exists( 'accessbuddy_general_panel_register' ) ):
	function accessbuddy_general_panel_register( $wp_customize ) {
	   
       /**
		 * General Settings Panel on customizer
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_panel(
	        'accessbuddy_general_settings_panel', 
	        	array(
	        		'priority'       => 5,
	            	'capability'     => 'edit_theme_options',
	            	'theme_supports' => '',
	            	'title'          => esc_html__( 'General Settings', 'accessbuddy' ),
	            ) 
	    );

		$wp_customize->get_section( 'title_tagline' )->panel = 'accessbuddy_general_settings_panel';
    	$wp_customize->get_section( 'background_image' )->panel = 'accessbuddy_general_settings_panel';
    	$wp_customize->get_section( 'colors' )->panel = 'accessbuddy_general_settings_panel';
        $wp_customize->get_section( 'static_front_page' )->panel = 'accessbuddy_general_settings_panel';     

        $wp_customize->add_section(
	        'ab_website_layout_section',
	        array(
	            'title'		=> esc_html__( 'Website Layout', 'accessbuddy' ),
	            'panel'     => 'accessbuddy_general_settings_panel',
	        )
	    );
        
        /**
	     * Switch option for Top Header Section
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'website_layout',
	        array(
                'default' => 'full-width',
	            'sanitize_callback' => 'accessbuddy_sanitize_choice',
	            )
	    );
	    $wp_customize->add_control(
            'website_layout', 
            array(
                'type' 		=> 'radio',	                
                'label' 	=> esc_html__( 'Website Layout', 'accessbuddy' ),
                'section' 	=> 'ab_website_layout_section',
                'choices'   => array(
                    'boxed' 	=> esc_html__( 'Boxed', 'accessbuddy' ),
                    'full-width' 	=> esc_html__( 'Full Width', 'accessbuddy' )
                    ),
            )
	    );

	} //close fucntion
endif;

add_action( 'customize_register', 'accessbuddy_general_panel_register' );