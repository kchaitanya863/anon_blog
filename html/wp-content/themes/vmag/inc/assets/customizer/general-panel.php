<?php
/**
 * General Settings panel in customizer section
 *
 * @package VMag
 */


add_action( 'customize_register', 'vmag_general_settings_panel_register' );

if( !function_exists( 'vmag_general_settings_panel_register' ) ):
	function vmag_general_settings_panel_register( $wp_customize ) {    

		$wp_customize->get_section( 'title_tagline' )->panel = 'vmag_general_settings_panel';
    	$wp_customize->get_section( 'title_tagline' )->priority = '5';
    	$wp_customize->get_section( 'background_image' )->panel = 'vmag_general_settings_panel';
    	$wp_customize->get_section( 'background_image' )->priority = '10';
    	$wp_customize->get_section( 'colors' )->panel = 'vmag_general_settings_panel';
        $wp_customize->get_section( 'colors' )->priority = '15';
        $wp_customize->get_section( 'static_front_page' )->panel = 'vmag_general_settings_panel';
    	$wp_customize->get_section( 'static_front_page' )->priority = '20';        

		/**
		 * Add General Settings panel
		 */
		$wp_customize->add_panel(
	        'vmag_general_settings_panel', 
	        	array(
	        		'priority'       => 5,
	            	'capability'     => 'edit_theme_options',
	            	'theme_supports' => '',
	            	'title'          => esc_html__( 'General Settings', 'vmag' ),
	            ) 
	    );

    /*--------------------------------------------------------------------------------------------------*/
    	/**
    	 * Website layout
    	 */
    	$wp_customize->add_section(
            'vmag_site_layout_section',
            array(
                'title'         => esc_html__( 'Website Layout', 'vmag' ),
                'panel'         => 'vmag_general_settings_panel',
                'priority'      => 25,
            )
        );

    	// Whole Site except home page
        $wp_customize->add_setting(
            'vmag_site_layout',
            array(
                'default'           => 'fullwidth_layout',
                'sanitize_callback' => 'vmag_sanitize_site_layout',
            )
        );
        $wp_customize->add_control(
            'vmag_site_layout',
            array(
                'type'        => 'radio',
                'label'       => esc_html__( 'Website Layout', 'vmag' ),
                'description' => esc_html__( 'Option to change the website layout.', 'vmag' ),
                'section'     => 'vmag_site_layout_section',            
                'choices' => array(
                    'fullwidth_layout'     => esc_html__( 'Full Width Layout', 'vmag' ),
                    'boxed_layout'   => esc_html__( 'Boxed Layout', 'vmag' )
                ),
            )
        );

    /*--------------------------------------------------------------------------------------------------*/
        /**
         * Breadcrumbs Settings
         */
        $wp_customize->add_section(
            'vmag_breadcrumbs_section',
            array(
                'title'         => esc_html__( 'Breadcrumbs Settings', 'vmag' ),
                'panel'         => 'vmag_general_settings_panel',
                'priority'      => 30,
            )
        );

        //Show/hide breadcrumbs
        $wp_customize->add_setting(
            'vmag_breadcrumbs_option',
            array(
                'default' => 'show',
                'sanitize_callback' => 'vmag_sanitize_switch_option',
                )
        );
        $wp_customize->add_control( new Vmag_Customize_Switch_Control(
            $wp_customize, 
                'vmag_breadcrumbs_option', 
                array(
                    'type'      => 'switch',                    
                    'label'     => esc_html__( 'Breadcrumbs Option', 'vmag' ),
                    'description'   => esc_html__( 'Enable/Disable breadcrumbs in inner pages', 'vmag' ),
                    'section'   => 'vmag_breadcrumbs_section',
                    'choices'   => array(
                        'show'  => esc_html__( 'Show', 'vmag' ),
                        'hide'  => esc_html__( 'Hide', 'vmag' )
                        ),
                    'priority'  => 5,
                )                   
            )
        );

        //Breadcrumbs home text
        $wp_customize->add_setting(
            'vmag_bread_home_txt', 
            array(
                'default'   => esc_html__( 'Home', 'vmag' ),
                'transport' => 'postMessage',
                'sanitize_callback' => 'vmag_sanitize_text'                 
            )
        );    
        $wp_customize->add_control(
            'vmag_bread_home_txt',
            array(
                'type'      => 'text',
                'label'     => esc_html__( 'Home Text', 'vmag' ),
                'section'   => 'vmag_breadcrumbs_section',
                'priority'  => 6
            )
        );

	}
endif;