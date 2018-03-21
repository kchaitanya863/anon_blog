<?php
/**
 * AccessBuddy Theme Customizer for Frontpage panel.
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

if( ! function_exists( 'accessbuddy_frontpage_panel_register' ) ):
	function accessbuddy_frontpage_panel_register( $wp_customize ) {

		/**
		 * Header Settings Panel on customizer
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_panel(
	        'accessbuddy_frontpage_settings_panel', 
	        	array(
	        		'priority'       => 15,
	            	'capability'     => 'edit_theme_options',
	            	'theme_supports' => '',
	            	'title'          => esc_html__( 'FrontPage Settings', 'accessbuddy' ),
	            ) 
	    );
/*--------------------------------------------------------------------------------------------------------------*/
		/**
		 * Banner Section
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_section(
	        'front_slider_section',
	        array(
	            'title'		=> esc_html__( 'Banner Settings', 'accessbuddy' ),
	            'panel'     => 'accessbuddy_frontpage_settings_panel',
	            'priority'  => 5,
	        )
	    );

	    /**
	     * Switch option for Slider Section
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'front_banner_option',
	        array(
	            'default' => 'show',
	            'transport' => 'postMessage',
	            'sanitize_callback' => 'accessbuddy_sanitize_switch_option',
	            )
	    );
	    $wp_customize->add_control( new AccessBuddy_Customize_Switch_Control(
	        $wp_customize, 
	            'front_banner_option', 
	            array(
	                'type' 		=> 'switch',	                
	                'label' 	=> esc_html__( 'Banner Option', 'accessbuddy' ),
	                'description' 	=> esc_html__( 'Show/hide option for slider Section on frontpage.', 'accessbuddy' ),
	                'section' 	=> 'front_slider_section',
	                'choices'   => array(
	                    'show' 	=> esc_html__( 'Show', 'accessbuddy' ),
	                    'hide' 	=> esc_html__( 'Hide', 'accessbuddy' )
	                    ),
	                'priority'  => 5,
	            )	            	
	        )
	    );

	    /**
	     * Switch option for Slider Section
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'front_banner_layout',
	        array(
	            'default' => 'static_banner',
	            'sanitize_callback' => 'sanitize_key',
	            )
	    );
	    $wp_customize->add_control( new AccessBuddy_Select_Customize_Control(
	        $wp_customize, 
	            'front_banner_layout', 
	            array(	                
	                'label' 	=> esc_html__( 'Banner Layout', 'accessbuddy' ),
	                'description' 	=> esc_html__( 'Select the banner layout.', 'accessbuddy' ),
	                'section' 	=> 'front_slider_section',
	                'choices'   => array(
	                    'static_banner'		=> esc_html__( 'Static Banner', 'accessbuddy' ),
	                    'slider_banner' 	=> esc_html__( 'Slider Banner', 'accessbuddy' ),
	                    'slider_featured_banner'	=> esc_html__( 'Slider with Featured Posts', 'accessbuddy' )
	                    ),
	                'priority'  => 10,
	            )	            	
	        )
	    );

	    /**
	     * Dropdown available category for homepage slider
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'slider_cat_id',
		        array(
		            'default' => '0',
		            'capability' => 'edit_theme_options',
		            'sanitize_callback' => 'absint'
		        )
	    );
	    $wp_customize->add_control( new AccessBuddy_Customize_Category_Control(
	        $wp_customize,
	        'slider_cat_id', 
		        array(
		            'label' => esc_html__( 'Category for Slider', 'accessbuddy' ),
		            'description' => esc_html__( 'Select cateogry for Homepage Slider Section', 'accessbuddy' ),
		            'section' => 'front_slider_section',
		            'priority' => 15,
		            'active_callback' => 'accessbuddy_is_slider_banner'
		        )
		    )
	    );

	    /**
	     * Upload image control for static banner
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'ab_static_banner_image',
		        array(
		            'default' => '',
		            'capability' => 'edit_theme_options',
		            'sanitize_callback' => 'esc_url_raw'
		        )
	    );

	    $wp_customize->add_control( new WP_Customize_Image_Control(
	        $wp_customize,
	        'ab_static_banner_image',
	        	array(
	            	'label'      => esc_html__( 'Banner Image', 'accessbuddy' ),
	               	'section'    => 'front_slider_section',
	               	'priority' => 20,
	               	'active_callback' => 'accessbuddy_is_static_banner'
	           	)
	       	)
	   	);

	    /**
	     * Static banner title
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'ab_static_banner_title', 
            array(
                'default' 	=> __( 'Get Connected', 'accessbuddy' ),
                'transport' => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field'
	       	)
	    );    
	    $wp_customize->add_control( 
	        'ab_static_banner_title',
            array(
	            'label' 	=> __( 'Banner Title', 'accessbuddy' ),
	            'section' 	=> 'front_slider_section',
	            'priority' 	=> 25,
	            'active_callback' => 'accessbuddy_is_static_banner'
            )
	    );

	    /**
	     * Static banner info
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'ab_static_banner_info', 
            array(
                'default' 	=> '',
                'transport' => 'postMessage',
                'sanitize_callback' => 'wp_kses_post'
	       	)
	    );    
	    $wp_customize->add_control( 
	        'ab_static_banner_info',
            array(
            	'type' 		=> 'textarea',
	            'label' 	=> __( 'Banner Info', 'accessbuddy' ),
	            'section' 	=> 'front_slider_section',
	            'priority' 	=> 30,
	            'active_callback' => 'accessbuddy_is_static_banner'
            )
	    );

	    /**
	     * Switch option for Buddypress login form
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'ab_banner_buddy_form_option',
	        array(
	            'default' => 'show',
	            'transport' => 'postMessage',
	            'sanitize_callback' => 'accessbuddy_sanitize_switch_option',
	            )
	    );
	    $wp_customize->add_control( new AccessBuddy_Customize_Switch_Control(
	        $wp_customize, 
	            'ab_banner_buddy_form_option', 
	            array(
	                'type' 		=> 'switch',	                
	                'label' 	=> esc_html__( 'BuddyPress Login Form Option', 'accessbuddy' ),
	                'description' 	=> esc_html__( 'On/Off option for BuddyPress form at static banner.', 'accessbuddy' ),
	                'section' 	=> 'front_slider_section',
	                'choices'   => array(
	                    'show' 	=> esc_html__( 'On', 'accessbuddy' ),
	                    'hide' 	=> esc_html__( 'Off', 'accessbuddy' )
	                    ),
	                'priority'  => 35,
	                'active_callback' => 'accessbuddy_is_static_banner'
	            )	            	
	        )
	    );

	    /**
	     * Dropdown available category for featured post
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'featured_posts_cat_id',
		        array(
		            'default' => '0',
		            'capability' => 'edit_theme_options',
		            'sanitize_callback' => 'absint'
		        )
	    );
	    $wp_customize->add_control( new AccessBuddy_Customize_Category_Control(
	        $wp_customize,
	        'featured_posts_cat_id', 
		        array(
		            'label' => esc_html__( 'Category for Featured Posts', 'accessbuddy' ),
		            'description' => esc_html__( 'Select cateogry for Featured posts at Slider Section', 'accessbuddy' ),
		            'section' => 'front_slider_section',
		            'priority' => 40,
		            'active_callback' => 'accessbuddy_is_slider_featured_banner'
		        )
		    )
	    );

	} //close fucntion
endif;
add_action( 'customize_register', 'accessbuddy_frontpage_panel_register' );