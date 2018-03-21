<?php
/**
 * AccessBuddy Theme Customizer Option for BuddyPress.
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

if( ! function_exists( 'accessbuddy_bp_options_register' ) ):
	function accessbuddy_bp_options_register( $wp_customize ) {

/*--------------------------------------------------------------------------------------------------------------*/
		/**
		 * Primary Menu Section
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_section(
	        'ab_primary_menu_section',
	        array(
	            'title'		=> esc_html__( 'Primary Menu Settings', 'accessbuddy' ),
	            'panel'     => 'accessbuddy_header_settings_panel',
	            'priority'  => 10,
	        )
	    );

	    /**
	     * Switch option for Notification on Menu Section
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'ab_bp_menu_notification',
	        array(
	            'default' => 'show',
	            'transport' => 'postMessage',
	            'sanitize_callback' => 'accessbuddy_sanitize_switch_option',
	            )
	    );
	    $wp_customize->add_control( new AccessBuddy_Customize_Switch_Control(
	        $wp_customize, 
	            'ab_bp_menu_notification', 
	            array(
	                'type' 		=> 'switch',	                
	                'label' 	=> esc_html__( 'Notification Option', 'accessbuddy' ),
	                'description' 	=> esc_html__( 'Show/hide buddypress notification on menu section.', 'accessbuddy' ),
	                'section' 	=> 'ab_primary_menu_section',
	                'choices'   => array(
	                    'show' 	=> esc_html__( 'Show', 'accessbuddy' ),
	                    'hide' 	=> esc_html__( 'Hide', 'accessbuddy' )
	                    ),
	                'priority'  => 5,
	            )	            	
	        )
	    );

	} //close fucntion
endif;
add_action( 'customize_register', 'accessbuddy_bp_options_register' );