<?php
/**
 * AccessBuddy Theme Customizer for Design panel.
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

if( ! function_exists( 'accessbuddy_design_panel_register' ) ):
	function accessbuddy_design_panel_register( $wp_customize ) {

		// Register the radio image control class as a JS control type.
    	$wp_customize->register_control_type( 'AccessBuddy_Customize_Control_Radio_Image' );

		/**
		 * Design Settings Panel on customizer
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_panel(
	        'accessbuddy_design_settings_panel', 
	        	array(
	        		'priority'       => 20,
	            	'capability'     => 'edit_theme_options',
	            	'theme_supports' => '',
	            	'title'          => esc_html__( 'Design Settings', 'accessbuddy' ),
	            ) 
	    );
/*--------------------------------------------------------------------------------------------------------------*/
		/**
		 * Archive Settings
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_section(
	        'archive_settings_section',
	        array(
	            'title'		=> esc_html__( 'Archive Settings', 'accessbuddy' ),
	            'panel'     => 'accessbuddy_design_settings_panel',
	            'priority'  => 5,
	        )
	    );	    

	    /**
	     * Field for Image Radio
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'ab_archive_sidebar',
	        array(
	            'default'           => 'right_sidebar',
	            'sanitize_callback' => 'sanitize_key',
	        )
	    );	    
	    $wp_customize->add_control( new AccessBuddy_Customize_Control_Radio_Image(
	        $wp_customize,
	        'ab_archive_sidebar',
	            array(
	                'label'    => esc_html__( 'Archive Sidebars', 'accessbuddy' ),
	                'description' => esc_html__( 'Choose sidebar from available layouts', 'accessbuddy' ),
	                'section'  => 'archive_settings_section',
	                'choices'  => array(
		                    'left_sidebar' => array(
		                        'label' => esc_html__( 'Left Sidebar', 'accessbuddy' ),
		                        'url'   => '%s/assets/images/left-sidebar.png'
		                    ),
		                    'right_sidebar' => array(
		                        'label' => esc_html__( 'Right Sidebar', 'accessbuddy' ),
		                        'url'   => '%s/assets/images/right-sidebar.png'
		                    ),
		                    'no_sidebar' => array(
		                        'label' => esc_html__( 'No Sidebar', 'accessbuddy' ),
		                        'url'   => '%s/assets/images/no-sidebar.png'
		                    ),
		                    'no_sidebar_center' => array(
		                        'label' => esc_html__( 'No Sidebar Center', 'accessbuddy' ),
		                        'url'   => '%s/assets/images/no-sidebar-center.png'
		                    )
		            ),
		            'priority' => 5
	            )
	        )
	    );

/*--------------------------------------------------------------------------------------------------------------*/
		/**
		 * Page Settings
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_section(
	        'page_settings_section',
	        array(
	            'title'		=> esc_html__( 'Page Settings', 'accessbuddy' ),
	            'panel'     => 'accessbuddy_design_settings_panel',
	            'priority'  => 10,
	        )
	    );	    

	    /**
	     * Field for sidebar Image Radio
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'ab_default_page_sidebar',
	        array(
	            'default'           => 'right_sidebar',
	            'sanitize_callback' => 'sanitize_key',
	        )
	    );	    
	    $wp_customize->add_control( new AccessBuddy_Customize_Control_Radio_Image(
	        $wp_customize,
	        'ab_default_page_sidebar',
	            array(
	                'label'    => esc_html__( 'Page Sidebars', 'accessbuddy' ),
	                'description' => esc_html__( 'Choose sidebar from available layouts', 'accessbuddy' ),
	                'section'  => 'page_settings_section',
	                'choices'  => array(
		                    'left_sidebar' => array(
		                        'label' => esc_html__( 'Left Sidebar', 'accessbuddy' ),
		                        'url'   => '%s/assets/images/left-sidebar.png'
		                    ),
		                    'right_sidebar' => array(
		                        'label' => esc_html__( 'Right Sidebar', 'accessbuddy' ),
		                        'url'   => '%s/assets/images/right-sidebar.png'
		                    ),
		                    'no_sidebar' => array(
		                        'label' => esc_html__( 'No Sidebar', 'accessbuddy' ),
		                        'url'   => '%s/assets/images/no-sidebar.png'
		                    ),
		                    'no_sidebar_center' => array(
		                        'label' => esc_html__( 'No Sidebar Center', 'accessbuddy' ),
		                        'url'   => '%s/assets/images/no-sidebar-center.png'
		                    )
		            ),
		            'priority' => 5
	            )
	        )
	    );
/*--------------------------------------------------------------------------------------------------------------*/
		/**
		 * Post Settings
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_section(
	        'post_settings_section',
	        array(
	            'title'		=> esc_html__( 'Post Settings', 'accessbuddy' ),
	            'panel'     => 'accessbuddy_design_settings_panel',
	            'priority'  => 15,
	        )
	    );	    

	    /**
	     * Field for sidebar Image Radio
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'ab_default_post_sidebar',
	        array(
	            'default'           => 'right_sidebar',
	            'sanitize_callback' => 'sanitize_key',
	        )
	    );	    
	    $wp_customize->add_control( new AccessBuddy_Customize_Control_Radio_Image(
	        $wp_customize,
	        'ab_default_post_sidebar',
	            array(
	                'label'    => esc_html__( 'Post Sidebars', 'accessbuddy' ),
	                'description' => esc_html__( 'Choose sidebar from available layouts', 'accessbuddy' ),
	                'section'  => 'post_settings_section',
	                'choices'  => array(
		                    'left_sidebar' => array(
		                        'label' => esc_html__( 'Left Sidebar', 'accessbuddy' ),
		                        'url'   => '%s/assets/images/left-sidebar.png'
		                    ),
		                    'right_sidebar' => array(
		                        'label' => esc_html__( 'Right Sidebar', 'accessbuddy' ),
		                        'url'   => '%s/assets/images/right-sidebar.png'
		                    ),
		                    'no_sidebar' => array(
		                        'label' => esc_html__( 'No Sidebar', 'accessbuddy' ),
		                        'url'   => '%s/assets/images/no-sidebar.png'
		                    ),
		                    'no_sidebar_center' => array(
		                        'label' => esc_html__( 'No Sidebar Center', 'accessbuddy' ),
		                        'url'   => '%s/assets/images/no-sidebar-center.png'
		                    )
		            ),
		            'priority' => 5
	            )
	        )
	    );

	}//close function
endif;

add_action( 'customize_register', 'accessbuddy_design_panel_register' );