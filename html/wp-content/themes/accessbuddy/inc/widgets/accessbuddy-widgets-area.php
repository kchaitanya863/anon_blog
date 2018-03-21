<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @package AccessPress Themes
 * @subpackage AccessBuddy
 * @since 1.0.0
 */
function accessbuddy_widgets_init() {
	
	/**
	 * Widgets area for Rigth Sidebar
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', 'accessbuddy' ),
		'id'            => 'accessbuddy_right_sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'accessbuddy' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	/**
	 * Widgets area for Left Sidebar
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Left Sidebar', 'accessbuddy' ),
		'id'            => 'accessbuddy_left_sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'accessbuddy' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	/**
	 * Widgets area for Header Ads
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Header Ads Section', 'accessbuddy' ),
		'id'            => 'accessbuddy_header_ads_area',
		'description'   => esc_html__( 'Add widgets here.', 'accessbuddy' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	/**
	 * Widgets area for Homepage Top
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'HomePage Banner Section', 'accessbuddy' ),
		'id'            => 'accessbuddy_home_banner_area',
		'description'   => esc_html__( 'Add widgets here.', 'accessbuddy' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	/**
	 * Widgets area for Homepage Top
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'HomePage Top Fullwidth', 'accessbuddy' ),
		'id'            => 'accessbuddy_home_top_fullwidth',
		'description'   => esc_html__( 'Add widgets here.', 'accessbuddy' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title"><span>',
		'after_title'   => '</span></h4>',
	) );

	/**
	 * Widgets area for Homepage main Section
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'HomePage Main Section', 'accessbuddy' ),
		'id'            => 'accessbuddy_home_main',
		'description'   => esc_html__( 'Add widgets here.', 'accessbuddy' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	/**
	 * Widgets Area for Homepage main Sidebar
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'HomePage Main aside', 'accessbuddy' ),
		'id'            => 'accessbuddy_home_main_aside',
		'description'   => esc_html__( 'Add widgets here.', 'accessbuddy' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	/**
	 * Widgets Area for Homepage fullwidth
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'HomePage Fullwidth Section', 'accessbuddy' ),
		'id'            => 'accessbuddy_bottom_home_fullwidth',
		'description'   => esc_html__( 'Add widgets here.', 'accessbuddy' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	/**
	 * Register 4 different Footer Area 
	 */
	register_sidebars( 4 , array(
		'name'          => esc_html__( 'Footer Area %d', 'accessbuddy' ),
		'id'            => 'accessbuddy_footer_sidebar',
		'description'   => esc_html__( 'Added widgets are display at Footer Widget Area.', 'accessbuddy' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );


}
add_action( 'widgets_init', 'accessbuddy_widgets_init' );

/**
 * Load custom widget functions file
 */
require ( trailingslashit ( get_template_directory() ) . '/inc/widgets/accessbuddy-widget-functions.php' );