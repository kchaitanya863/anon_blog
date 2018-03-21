<?php
/**
 * Design Settings panel in customizer section
 *
 * @package VMag
 */


add_action( 'customize_register', 'vmag_design_settings_panel_register' );

if( !function_exists( 'vmag_design_settings_panel_register' ) ):
	function vmag_design_settings_panel_register( $wp_customize ) { 

		/**
		 * Add General Settings panel
		 */
		$wp_customize->add_panel(
	        'vmag_design_settings_panel', 
	        	array(
	        		'priority'       => 30,
	            	'capability'     => 'edit_theme_options',
	            	'theme_supports' => '',
	            	'title'          => esc_html__( 'Design Settings', 'vmag' ),
	            ) 
	    );
	/*------------------------------------------------------------------------------------*/
		/**
		 * Additional Settings
		 */
		$wp_customize->add_section(
	        'vmag_additonal_settings_section',
	        array(
	            'title'		=> esc_html__( 'Additional Settings', 'vmag' ),
	            'panel'     => 'vmag_design_settings_panel',
	            'priority'  => 5,
	        )
	    );

	    //Show/hide for tag in homepage
	    $wp_customize->add_setting(
	        'vmag_homepage_tag_option',
	        array(
	            'default' => 'show',
	            'sanitize_callback' => 'vmag_sanitize_switch_option',
	            )
	    );
	    $wp_customize->add_control( new Vmag_Customize_Switch_Control(
	        $wp_customize, 
	            'vmag_homepage_tag_option', 
	            array(
	                'type' 		=> 'switch',
	                'label' 	=> esc_html__( 'Tags in Home Page', 'vmag' ),
	                'description' 	=> esc_html__( 'Enable/Disable tags in homepge', 'vmag' ),
	                'section' 	=> 'vmag_additonal_settings_section',
	                'choices'   => array(
	                    'show' 	=> esc_html__( 'Show', 'vmag' ),
	                    'hide' 	=> esc_html__( 'Hide', 'vmag' )
	                    ),
	                'priority'  => 5,
	            )
	        )
	    );

	    //Enable/disable animation
	    $wp_customize->add_setting(
	        'vmag_wow_animation_option',
	        array(
	            'default' => 'enable',
	            'sanitize_callback' => 'vmag_sanitize_switch_enable_option',
	            )
	    );
	    $wp_customize->add_control( new Vmag_Customize_Switch_Control(
	        $wp_customize, 
	            'vmag_wow_animation_option', 
	            array(
	                'type' 		=> 'switch',	                
	                'label' 	=> esc_html__( 'Animation Option', 'vmag' ),
	                'description' 	=> esc_html__( 'Enable/Disable wow animation in widget section at homepage.', 'vmag' ),
	                'section' 	=> 'vmag_additonal_settings_section',
	                'choices'   => array(
	                    'enable' 	=> esc_html__( 'Enable', 'vmag' ),
	                    'disable' 	=> esc_html__( 'Disable', 'vmag' )
	                    ),
	                'priority'  => 6,
	            )	            	
	        )
	    );
	/*------------------------------------------------------------------------------------*/
		/**
		 * Archive Settings
		 */
		$wp_customize->add_section(
	        'vmag_archive_settings_section',
	        array(
	            'title'		=> esc_html__( 'Archive Settings', 'vmag' ),
	            'panel'     => 'vmag_design_settings_panel',
	            'priority'  => 6,
	        )
	    );

	    // Archive sidebars
		$wp_customize->add_setting(
	        'vmag_archive_sidebar', 
	        array(
	    		'default' => 'right_sidebar',
	            'capability' => 'edit_theme_options',
	    		'sanitize_callback' => 'vmag_sanitize_page_sidebar'
		       )
	    );

		$wp_customize->add_control( new Vmag_Image_Radio_Control(
	        $wp_customize, 
	        'vmag_archive_sidebar', 
	        array(
	    		'type' 		=> 'radio',
	    		'label' 	=> esc_html__( 'Available Sidebars', 'vmag' ),
	            'description' => esc_html__( 'Choose between available layouts for all archives, categories, search page etc.', 'vmag' ),
	    		'section' 	=> 'vmag_archive_settings_section',
	            'priority'  => 3,
	    		'choices' 	=> array(
	        			'right_sidebar' => get_template_directory_uri() . '/inc/assets/images/right-sidebar.png',
	                    'left_sidebar' => get_template_directory_uri() . '/inc/assets/images/left-sidebar.png',
	                    'no_sidebar' => get_template_directory_uri() . '/inc/assets/images/no-sidebar.png',
	                    'no_sidebar_center' => get_template_directory_uri() . '/inc/assets/images/no-sidebar-center.png'
	        		)
		       )
	        )
	    );

	    //Length of archive excerpt
	    $wp_customize->add_setting(
	        'vmag_archive_excerpt_lenght',
	        array(
	            'default' => '50',
	            'sanitize_callback' => 'vmag_sanitize_number',
	        )
	    );
	    $wp_customize->add_control(
	        'vmag_archive_excerpt_lenght',
	        array(
	            'type' => 'number',
	            'priority' => 4,
	            'label' => esc_html__( 'Excerpt length', 'vmag' ),
	            'description'   => esc_html__( 'Choose number of words in archive pages.', 'vmag' ),
	            'section' => 'vmag_archive_settings_section',
	            'input_attrs' => array(
	                'min'   => 10,
	                'max'   => 100,
	                'step'  => 1
	            )
	        )
	    );

	    //Archive read more button text
	    $wp_customize->add_setting(
	        'vmag_archive_read_more_text', 
            array(
                'default' 	=> esc_html__( 'Read More', 'vmag' ),
                'transport' => 'postMessage',
                'sanitize_callback' => 'vmag_sanitize_text'	                
	       	)
	    );    
	    $wp_customize->add_control(
	        'vmag_archive_read_more_text',
            array(
	            'type'		=> 'text',
	            'label' 	=> esc_html__( 'Read More Button', 'vmag' ),
	            'section' 	=> 'vmag_archive_settings_section',
	            'priority' 	=> 6
            )
	    );

	/*------------------------------------------------------------------------------------*/
		/**
		 * Post Settings
		 */
		$wp_customize->add_section(
	        'vmag_posts_settings_section',
	        array(
	            'title'		=> esc_html__( 'Post Settings', 'vmag' ),
	            'panel'     => 'vmag_design_settings_panel',
	            'priority'  => 7,
	        )
	    );

	    // Post sidebars
		$wp_customize->add_setting(
	        'vmag_default_post_sidebar', 
	        array(
	    		'default' => 'right_sidebar',
	            'capability' => 'edit_theme_options',
	    		'sanitize_callback' => 'vmag_sanitize_page_sidebar'
		       )
	    );

		$wp_customize->add_control( new Vmag_Image_Radio_Control(
	        $wp_customize, 
	        'vmag_default_post_sidebar', 
	        array(
	    		'type' 		=> 'radio',
	    		'label' 	=> esc_html__( 'Available Sidebars', 'vmag' ),
	            'description' => esc_html__( 'Choose between available layouts for single post.', 'vmag' ),
	    		'section' 	=> 'vmag_posts_settings_section',
	            'priority'  => 3,
	    		'choices' 	=> array(
	        			'right_sidebar' => get_template_directory_uri() . '/inc/assets/images/right-sidebar.png',
	                    'left_sidebar' => get_template_directory_uri() . '/inc/assets/images/left-sidebar.png',
	                    'no_sidebar' => get_template_directory_uri() . '/inc/assets/images/no-sidebar.png',
	                    'no_sidebar_center' => get_template_directory_uri() . '/inc/assets/images/no-sidebar-center.png'
	        		)
		       )
	        )
	    );

	    //Show/hide author box
	    $wp_customize->add_setting(
	        'vmag_author_info_option',
	        array(
	            'default' => 'show',
	            'sanitize_callback' => 'vmag_sanitize_switch_option',
	            )
	    );
	    $wp_customize->add_control( new Vmag_Customize_Switch_Control(
	        $wp_customize, 
	            'vmag_author_info_option', 
	            array(
	                'type' 		=> 'switch',	                
	                'label' 	=> esc_html__( 'Author Box.', 'vmag' ),
	                'description' 	=> esc_html__( 'Enable/Disable author box information at single post.', 'vmag' ),
	                'section' 	=> 'vmag_posts_settings_section',
	                'choices'   => array(
	                    'show' 	=> esc_html__( 'Show', 'vmag' ),
	                    'hide' 	=> esc_html__( 'Hide', 'vmag' )
	                    ),
	                'priority'  => 4,
	            )	            	
	        )
	    );

	    //Show/hide related posts
	    $wp_customize->add_setting(
	        'vmag_related_posts_option',
	        array(
	            'default' => 'show',
	            'sanitize_callback' => 'vmag_sanitize_switch_option',
	            )
	    );
	    $wp_customize->add_control( new Vmag_Customize_Switch_Control(
	        $wp_customize, 
	            'vmag_related_posts_option', 
	            array(
	                'type' 		=> 'switch',	                
	                'label' 	=> esc_html__( 'Related Posts', 'vmag' ),
	                'description' 	=> esc_html__( 'Enable/Disable related posts section in single post page.', 'vmag' ),
	                'section' 	=> 'vmag_posts_settings_section',
	                'choices'   => array(
	                    'show' 	=> esc_html__( 'Show', 'vmag' ),
	                    'hide' 	=> esc_html__( 'Hide', 'vmag' )
	                    ),
	                'priority'  => 5,
	            )	            	
	        )
	    );

	    //Related posts caption
	    $wp_customize->add_setting(
	        'vmag_related_posts_title', 
            array(
                'default' 	=> esc_html__( 'Related Articles', 'vmag' ),
                'transport' => 'postMessage',
                'sanitize_callback' => 'vmag_sanitize_text'	                
	       	)
	    );    
	    $wp_customize->add_control(
	        'vmag_related_posts_title',
            array(
	            'type'		=> 'text',
	            'label' 	=> esc_html__( 'Section Title', 'vmag' ),
	            'section' 	=> 'vmag_posts_settings_section',
	            'priority' 	=> 6
            )
	    );

	    // Types of related posts
	    $wp_customize->add_setting(
	        'vmag_related_post_type',
	        array(
	            'default'           => 'related_cat',
	            'sanitize_callback' => 'vmag_sanitize_related_type',
	        )
	    );
	    $wp_customize->add_control(
	        'vmag_related_post_type',
	        array(
	            'type'        => 'radio',
	            'label'       => esc_html__( 'Types of Related Posts', 'vmag' ),
	            'description' => esc_html__( 'Option to display related posts from category or tags.', 'vmag' ),
	            'section'     => 'vmag_posts_settings_section',            
	            'choices' => array(
	                'related_cat'   => esc_html__( 'Related Posts by Category', 'vmag' ),
	                'related_tag'   => esc_html__( 'Related Posts by Tags', 'vmag' )
	            ),
	            'active_callback'	=> 'vmag_related_post_option_callback',
	            'priority' 	=> 7
	        )
	    );
	/*------------------------------------------------------------------------------------*/
		/**
		 * Page Settings
		 */
		$wp_customize->add_section(
	        'vmag_page_settings_section',
	        array(
	            'title'		=> esc_html__( 'Page Settings', 'vmag' ),
	            'panel'     => 'vmag_design_settings_panel',
	            'priority'  => 8,
	        )
	    );

	    // Post sidebars
		$wp_customize->add_setting(
	        'vmag_default_page_sidebar', 
	        array(
	    		'default' => 'right_sidebar',
	            'capability' => 'edit_theme_options',
	    		'sanitize_callback' => 'vmag_sanitize_page_sidebar'
		       )
	    );

		$wp_customize->add_control( new Vmag_Image_Radio_Control(
	        $wp_customize, 
	        'vmag_default_page_sidebar', 
	        array(
	    		'type' 		=> 'radio',
	    		'label' 	=> esc_html__( 'Available Sidebars', 'vmag' ),
	            'description' => esc_html__( 'Choose between available layouts for all pages.', 'vmag' ),
	    		'section' 	=> 'vmag_page_settings_section',
	            'priority'  => 3,
	    		'choices' 	=> array(
	        			'right_sidebar' => get_template_directory_uri() . '/inc/assets/images/right-sidebar.png',
	                    'left_sidebar' => get_template_directory_uri() . '/inc/assets/images/left-sidebar.png',
	                    'no_sidebar' => get_template_directory_uri() . '/inc/assets/images/no-sidebar.png',
	                    'no_sidebar_center' => get_template_directory_uri() . '/inc/assets/images/no-sidebar-center.png'
	        		)
		       )
	        )
	    );
	/*------------------------------------------------------------------------------------*/
		/**
		 * Footer Settings
		 */
		$wp_customize->add_section(
	        'vmag_footer_settings_section',
	        array(
	            'title'		=> esc_html__( 'Footer Settings', 'vmag' ),
	            'panel'     => 'vmag_design_settings_panel',
	            'priority'  => 9,
	        )
	    );

	    // Footer widget area column
	    $wp_customize->add_setting(
	        'vmag_footer_widget_layout',
	        array(
	            'default'           => 'column_three',
	            'sanitize_callback' => 'vmag_sanitize_footer_widget',
	        )
	    );
	    $wp_customize->add_control(
	        'vmag_footer_widget_layout',
	        array(
	            'type'        => 'radio',
	            'label'       => esc_html__( 'Footer Widget Columns', 'vmag' ),
	            'description' => esc_html__( 'Option to set number of columns in footer widget area.', 'vmag' ),
	            'section'     => 'vmag_footer_settings_section',            
	            'choices' => array(
	                'column_one'   => esc_html__( 'One Column', 'vmag' ),
		            'column_two'   => esc_html__( 'Two Columns', 'vmag' ),
		            'column_three'   => esc_html__( 'Three Columns', 'vmag' ),
		            'column_four'   => esc_html__( 'Four Columns', 'vmag' )
	            ),
	            'priority' 	=> 3
	        )
	    );

	    // copyright textarea
	    $wp_customize->add_setting(
	        'vmag_copyright_text',
	        array(
	            'default' => esc_html__( '2016 VMag', 'vmag' ),
	            'capability' => 'edit_theme_options',
	            'sanitize_callback' => 'vmag_sanitize_text'
	        )
	    );
	    $wp_customize->add_control( new Vmag_Textarea_Custom_Control(
	        $wp_customize,
	        'vmag_copyright_text',
	            array(
	                'type' => 'vmag_textarea',
	                'label' => esc_html__( 'Copyright Info', 'vmag' ),
	                'priority' => 5,
	                'section' => 'vmag_footer_settings_section'
	            )
	        )
	    );
	}
	
endif;