<?php
/**
 * AccessBuddy functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package AccessPress Themes
 * @subpackage AccessBuddy
 * @since 1.0.0
 */

if ( ! function_exists( 'accessbuddy_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function accessbuddy_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on AccessBuddy, use a find and replace
	 * to change 'accessbuddy' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'accessbuddy', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/**
	 * Enable support for custom logo.
	 *
	 * @since 1.0.0
	 */
	add_image_size( 'accessbuddy-site-logo', 268, 90 );
	add_theme_support( 'custom-logo', array( 'size' => 'accessbuddy-site-logo' ) );

	
	add_image_size( 'accessbuddy-horizontal-thumb', 570, 261, true );
	add_image_size( 'accessbuddy-featured-thumb', 283, 197, true );
	add_image_size( 'accessbuddy-rectangle-thumb', 510, 369, true );
	add_image_size( 'accessbuddy-small-thumb', 320, 224, true );
	add_image_size( 'accessbuddy-slider-thumb', 565, 462, true );
	add_image_size( 'accessbuddy-slider-large', 1349, 580, true );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'accessbuddy_top_menu' => esc_html__( 'Top Menu', 'accessbuddy' ),
		'accessbuddy_primary_menu' => esc_html__( 'Primary Menu', 'accessbuddy' ),
		'accessbuddy_footer_menu' => esc_html__( 'Footer Menu', 'accessbuddy' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'accessbuddy_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'accessbuddy_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function accessbuddy_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'accessbuddy_content_width', 640 );
}
add_action( 'after_setup_theme', 'accessbuddy_content_width', 0 );

/**
 * Load custom functions file
 */
require ( trailingslashit ( get_template_directory() ) . '/inc/accessbuddy-functions.php' );

/**
 * Load custom functions file about BuddyPress
 */
require ( trailingslashit ( get_template_directory() ) . '/inc/accessbuddy-bp-functions.php' );

/**
 * Load widget area
 */
require ( trailingslashit ( get_template_directory() ) . '/inc/widgets/accessbuddy-widgets-area.php' );

/**
 * Implement the Custom Header feature.
 */
require ( trailingslashit ( get_template_directory() ) . '/inc/custom-header.php' );

/**
 * Custom template tags for this theme.
 */
require ( trailingslashit ( get_template_directory() ) . '/inc/template-tags.php' );

/**
 * Custom functions that act independently of the theme templates.
 */
require ( trailingslashit ( get_template_directory() ) . '/inc/extras.php' );

/**
 * Load hooked files
 */
require ( trailingslashit ( get_template_directory() ) . '/inc/hook/hook-header.php' );
require ( trailingslashit ( get_template_directory() ) . '/inc/hook/hook-footer.php' );

/**
 * Customizer additions and it's more panels
 */
require ( trailingslashit ( get_template_directory() ) . '/inc/customizer/customizer.php' );
require ( trailingslashit ( get_template_directory() ) . '/inc/customizer/general-panel.php' );
require ( trailingslashit ( get_template_directory() ) . '/inc/customizer/header-panel.php' );
require ( trailingslashit ( get_template_directory() ) . '/inc/customizer/frontpage-panel.php' );

//require ( trailingslashit ( get_template_directory() ) . '/inc/customizer/buddypress-customizer.php' );

require ( trailingslashit ( get_template_directory() ) . '/inc/customizer/design-panel.php' );
require ( trailingslashit ( get_template_directory() ) . '/inc/customizer/footer-panel.php' );

/**
 * Customizer custom classes and sanitize files
 */
require ( trailingslashit ( get_template_directory() ) . '/inc/customizer/accessbuddy-customizer-classes.php' );
require ( trailingslashit ( get_template_directory() ) . '/inc/customizer/accessbuddy-sanitize.php' );

/**
 * Load post/page meta sections files
 */
//require ( trailingslashit ( get_template_directory() ) . '/inc/metaboxes/page-metabox.php' );
//require ( trailingslashit ( get_template_directory() ) . '/inc/metaboxes/post-metabox.php' );

/**
 * Load Jetpack compatibility file.
 */
require ( trailingslashit ( get_template_directory() ) . '/inc/jetpack.php' );
