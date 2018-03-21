<?php
/**
 * AccessBuddy Theme Customizer for header panel.
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

if( ! function_exists( 'accessbuddy_header_panel_register' ) ):
	function accessbuddy_header_panel_register( $wp_customize ) {

		$wp_customize->remove_section( 'header_image');

		/**
		 * Header Settings Panel on customizer
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_panel(
	        'accessbuddy_header_settings_panel', 
	        	array(
	        		'priority'       => 10,
	            	'capability'     => 'edit_theme_options',
	            	'theme_supports' => '',
	            	'title'          => esc_html__( 'Header Settings', 'accessbuddy' ),
	            ) 
	    );
/*--------------------------------------------------------------------------------------------------------------*/
		/**
		 * Top Header Section
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_section(
	        'ab_top_header_section',
	        array(
	            'title'		=> esc_html__( 'Top Header Settings', 'accessbuddy' ),
	            'panel'     => 'accessbuddy_header_settings_panel',
	            'priority'  => 5,
	        )
	    );

	    /**
	     * Switch option for Top Header Section
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'top_header_option',
	        array(
	            'default' => 'show',
	            'transport' => 'postMessage',
	            'sanitize_callback' => 'accessbuddy_sanitize_switch_option',
	            )
	    );
	    $wp_customize->add_control( new AccessBuddy_Customize_Switch_Control(
	        $wp_customize, 
	            'top_header_option', 
	            array(
	                'type' 		=> 'switch',	                
	                'label' 	=> esc_html__( 'Top Header Option', 'accessbuddy' ),
	                'description' 	=> esc_html__( 'Show/hide option for Top Header Section.', 'accessbuddy' ),
	                'section' 	=> 'ab_top_header_section',
	                'choices'   => array(
	                    'show' 	=> esc_html__( 'Show', 'accessbuddy' ),
	                    'hide' 	=> esc_html__( 'Hide', 'accessbuddy' )
	                    ),
	                'priority'  => 5,
	            )	            	
	        )
	    );

	    /**
	     * Switch option for current date
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'ab_top_current_date',
	        array(
	            'default' => 'show',
	            'transport' => 'postMessage',
	            'sanitize_callback' => 'accessbuddy_sanitize_switch_option',
	            )
	    );
	    $wp_customize->add_control( new AccessBuddy_Customize_Switch_Control(
	        $wp_customize, 
	            'ab_top_current_date', 
	            array(
	                'type' 		=> 'switch',	                
	                'label' 	=> esc_html__( 'Current Date', 'accessbuddy' ),
	                'description' 	=> esc_html__( 'Show/hide option for Currnet date at top header.', 'accessbuddy' ),
	                'section' 	=> 'ab_top_header_section',
	                'choices'   => array(
	                    'show' 	=> esc_html__( 'Show', 'accessbuddy' ),
	                    'hide' 	=> esc_html__( 'Hide', 'accessbuddy' )
	                    ),
	                'priority'  => 10,
	            )	            	
	        )
	    );
/*------------------------------------------------------------------------------------*/
		/**
		 * News Ticker Section
		 *
		 * @since 1.0.0
		 */
		$wp_customize->add_section(
	        'ab_news_ticker_section',
	        array(
	            'title'		=> __( 'News Ticker', 'accessbuddy' ),
	            'panel'     => 'accessbuddy_header_settings_panel',
	            'priority'  => 15,
	        )
	    );

	    /**
	     * Switch option for News ticker
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'ab_ticker_option',
	        array(
	        	'default'	=> 'show',
	            'sanitize_callback' => 'accessbuddy_sanitize_switch_option'
	        )
	    );
	    $wp_customize->add_control( new AccessBuddy_Customize_Switch_Control(
	        $wp_customize, 
	            'ab_ticker_option', 
	            array(
	                'type' 		=> 'switch',	                
	                'label' 	=> __( 'News Ticker', 'accessbuddy' ),
	                'description' 	=> __( 'Show/hide news ticker section at frontpage header.', 'accessbuddy' ),
	                'section' 	=> 'ab_news_ticker_section',
	                'choices'   => array(
	                    'show' 	=> __( 'Show', 'accessbuddy' ),
	                    'hide' 	=> __( 'Hide', 'accessbuddy' )
	                    ),
	                'priority'  => 5,
	            )	            	
	        )
	    );

	    /**
	     * Dropdown available category for Ticker slider
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'ab_ticker_cat_id',
		        array(
		            'default' => '0',
		            'capability' => 'edit_theme_options',
		            'sanitize_callback' => 'absint'
		        )
	    );
	    $wp_customize->add_control( new AccessBuddy_Customize_Category_Control(
	        $wp_customize,
	        'ab_ticker_cat_id', 
		        array(
		            'label' => esc_html__( 'Ticker Category', 'accessbuddy' ),
		            'description' => esc_html__( 'Select cateogry for Homepage Ticker Section', 'accessbuddy' ),
		            'section' => 'ab_news_ticker_section',
		            'priority' => 10
		        )
		    )
	    );

	    /**
	     * Slider range for post count
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting(
	        'ab_ticker_caption', 
            array(
                'default' 	=> __( 'Trending News', 'accessbuddy' ),
                'transport' => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field'
	       	)
	    );    
	    $wp_customize->add_control( 
	        'ab_ticker_caption',
            array(
            	'type'		=> 'text',
	            'label' 	=> __( 'News Ticker Caption', 'accessbuddy' ),
	            'section' 	=> 'ab_news_ticker_section',
	            'priority' 	=> 15
            )
	    );

	} //close fucntion
endif;
add_action( 'customize_register', 'accessbuddy_header_panel_register' );