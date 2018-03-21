<?php
/**
 * Header Settings panel in customizer section
 *
 * @package VMag
 */


add_action( 'customize_register', 'vmag_header_settings_panel_register' );

if( !function_exists( 'vmag_header_settings_panel_register' ) ):
	function vmag_header_settings_panel_register( $wp_customize ) {
		global $vmag_cat_array;

		/**
		 * Add Header Settings panel
		 */
		$wp_customize->add_panel(
	        'vmag_header_settings_panel', 
        	array(
        		'priority'       => 10,
            	'capability'     => 'edit_theme_options',
            	'theme_supports' => '',
            	'title'          => esc_html__( 'Header Settings', 'vmag' ),
            ) 
	    );
	/*------------------------------------------------------------------------------------*/
		/**
		 * Header Options
		 */
		$wp_customize->add_section(
	        'vmag_header_options_section',
	        array(
	            'title'		=> esc_html__( 'Header Options', 'vmag' ),
	            'panel'     => 'vmag_header_settings_panel',
	            'priority'  => 5,
	        )
	    );

	    // Header date
	    $wp_customize->add_setting(
	        'vmag_header_date_option',
	        array(
	        	'default'	=> 'show',
	            'sanitize_callback' => 'vmag_sanitize_switch_option'
	        )
	    );
	    $wp_customize->add_control( new Vmag_Customize_Switch_Control(
	        $wp_customize, 
	            'vmag_header_date_option', 
	            array(
	                'type' 		=> 'switch',	                
	                'label' 	=> esc_html__( 'Date in header', 'vmag' ),
	                'description' 	=> esc_html__( 'Enable/Disable date in top header', 'vmag' ),
	                'section' 	=> 'vmag_header_options_section',
	                'choices'   => array(
	                    'show' 	=> esc_html__( 'Show', 'vmag' ),
	                    'hide' 	=> esc_html__( 'Hide', 'vmag' )
	                    ),
	                'priority'  => 5,
	            )	            	
	        )
	    );

	    // Search at primary menu section
	    $wp_customize->add_setting(
	        'vmag_menu_search_option',
	        array(
	        	'default'	=> 'show',
	            'sanitize_callback' => 'vmag_sanitize_switch_option'
	        )
	    );
	    $wp_customize->add_control( new Vmag_Customize_Switch_Control(
	        $wp_customize, 
	            'vmag_menu_search_option', 
	            array(
	                'type' 		=> 'switch',	                
	                'label' 	=> esc_html__( 'Search Icon', 'vmag' ),
	                'description' 	=> esc_html__( 'Enable/Disable search icon in primary menu', 'vmag' ),
	                'section' 	=> 'vmag_header_options_section',
	                'choices'   => array(
	                    'show' 	=> esc_html__( 'Show', 'vmag' ),
	                    'hide' 	=> esc_html__( 'Hide', 'vmag' )
	                    ),
	                'priority'  => 6,
	            )	            	
	        )
	    );

	    // Random icon at primary menu section
	    $wp_customize->add_setting(
	        'vmag_menu_random_option',
	        array(
	        	'default'	=> 'show',
	            'sanitize_callback' => 'vmag_sanitize_switch_option'
	        )
	    );
	    $wp_customize->add_control( new Vmag_Customize_Switch_Control(
	        $wp_customize, 
	            'vmag_menu_random_option', 
	            array(
	                'type' 		=> 'switch',	                
	                'label' 	=> esc_html__( 'Random Post', 'vmag' ),
	                'description' 	=> esc_html__( 'Enable/Disable random post icon in primary menu', 'vmag' ),
	                'section' 	=> 'vmag_header_options_section',
	                'choices'   => array(
	                    'show' 	=> esc_html__( 'Show', 'vmag' ),
	                    'hide' 	=> esc_html__( 'Hide', 'vmag' )
	                    ),
	                'priority'  => 7,
	            )	            	
	        )
	    );

	/*------------------------------------------------------------------------------------*/
		/**
		 * News Ticker
		 */
		$wp_customize->add_section(
	        'vmag_news_ticker_section',
	        array(
	            'title'		=> esc_html__( 'News Ticker', 'vmag' ),
	            'panel'     => 'vmag_header_settings_panel',
	            'priority'  => 5,
	        )
	    );

	    // News ticker option
	    $wp_customize->add_setting(
	        'vmag_ticker_option',
	        array(
	        	'default'	=> 'show',
	            'sanitize_callback' => 'vmag_sanitize_switch_option'
	        )
	    );
	    $wp_customize->add_control( new Vmag_Customize_Switch_Control(
	        $wp_customize, 
	            'vmag_ticker_option', 
	            array(
	                'type' 		=> 'switch',	                
	                'label' 	=> esc_html__( 'News Ticker', 'vmag' ),
	                'description' 	=> esc_html__( 'Enable/Disable news ticker ', 'vmag' ),
	                'section' 	=> 'vmag_news_ticker_section',
	                'choices'   => array(
	                    'show' 	=> esc_html__( 'Show', 'vmag' ),
	                    'hide' 	=> esc_html__( 'Hide', 'vmag' )
	                    ),
	                'priority'  => 5,
	            )	            	
	        )
	    );

	    //News ticker caption
	    $wp_customize->add_setting(
	        'vmag_ticker_caption', 
            array(
                'default' 	=> esc_html__( 'Recent News', 'vmag' ),
                'transport' => 'postMessage',
                'sanitize_callback' => 'vmag_sanitize_text'	                
	       	)
	    );    
	    $wp_customize->add_control(
	        'vmag_ticker_caption',
            array(
	            'type'		=> 'text',
	            'label' 	=> esc_html__( 'Section Menu Text', 'vmag' ),
	            'section' 	=> 'vmag_news_ticker_section',
	            'priority' 	=> 6
            )
	    );
	}
endif;