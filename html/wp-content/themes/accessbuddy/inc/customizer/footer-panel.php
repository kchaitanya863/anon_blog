<?php
/**
 * AccessBuddy Theme Customizer for footer panel.
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

if( ! function_exists( 'accessbuddy_footer_panel_register' ) ):
	function accessbuddy_footer_panel_register( $wp_customize ) {

		// Register the radio image control class as a JS control type.
	    $wp_customize->register_control_type( 'AccessBuddy_Customize_Control_Radio_Image' );


		/**
		 * Footer Settings Panel on customizer
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_panel(
	        'accessbuddy_footer_settings_panel', 
	        	array(
	        		'priority'       => 30,
	            	'capability'     => 'edit_theme_options',
	            	'theme_supports' => '',
	            	'title'          => esc_html__( 'Footer Settings', 'accessbuddy' ),
	            ) 
	    );

/*--------------------------------------------------------------------------------------------------------------*/
		/**
		 * Footer Widget Settings
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_section(
	        'footer_widget_section',
	        array(
	            'title'		=> esc_html__( 'Footer Widget Settings', 'accessbuddy' ),
	            'panel'     => 'accessbuddy_footer_settings_panel',
	            'priority'  => 5,
	        )
	    );

	    /**
	     * Field for Image Radio
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'footer_widget_layout',
	        array(
	            'default'           => 'column_three',
	            'sanitize_callback' => 'sanitize_key',
	        )
	    );	    
	    $wp_customize->add_control( new AccessBuddy_Customize_Control_Radio_Image(
	        $wp_customize,
	        'footer_widget_layout',
	            array(
	                'label'    => esc_html__( 'Footer Widget Layout', 'accessbuddy' ),
	                'description' => esc_html__( 'Choose layout from available layouts', 'accessbuddy' ),
	                'section'  => 'footer_widget_section',
	                'choices'  => array(
		                    'column_four' => array(
		                        'label' => esc_html__( 'Columns Four', 'accessbuddy' ),
		                        'url'   => '%s/assets/images/footer-4.png'
		                    ),
		                    'column_three' => array(
		                        'label' => esc_html__( 'Columns Three', 'accessbuddy' ),
		                        'url'   => '%s/assets/images/footer-3.png'
		                    ),
		                    'column_two' => array(
		                        'label' => esc_html__( 'Columns Two', 'accessbuddy' ),
		                        'url'   => '%s/assets/images/footer-2.png'
		                    ),
		                    'column_one' => array(
		                        'label' => esc_html__( 'Column One', 'accessbuddy' ),
		                        'url'   => '%s/assets/images/footer-1.png'
		                    )
		            ),
		            'priority' => 5
	            )
	        )
	    );

/*--------------------------------------------------------------------------------------------------------------*/
		/**
		 * Bottom Footer Settings
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_section(
	        'bottom_footer_section',
	        array(
	            'title'		=> esc_html__( 'Bottom Footer Settings', 'accessbuddy' ),
	            'panel'     => 'accessbuddy_footer_settings_panel',
	            'priority'  => 10,
	        )
	    );

	    /**
	     * Field for Archive read more button text
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'ab_copyright_text', 
	            array(
	                'default' => esc_html__( '2016 AccessBuddy', 'accessbuddy' ),
	                'sanitize_callback' => 'wp_kses_post',
	                'transport' => 'postMessage'
		       	)
	    );
	    $wp_customize->add_control(
	        'ab_copyright_text',
	            array(
		            'type' => 'textarea',
		            'label' => esc_html__( 'Copyright Text', 'accessbuddy' ),
		            'section' => 'bottom_footer_section',
		            'priority' => 5
	            )
	    );
	
	} //end function
endif;

add_action( 'customize_register', 'accessbuddy_footer_panel_register' );