<?php
/**
 * VMag functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package VMag
 */

if ( ! function_exists( 'vmag_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function vmag_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on VMag, use a find and replace
	 * to change 'vmag' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'vmag', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for custom logo.
	 */	
	add_theme_support( 'custom-logo', 
		array(
			'height'      => 90,
			'width'       => 268,
			'flex-width' => true,
		) 
	);

	/**
	 * Define various size of image
	 */
	add_image_size( 'vmag-slider-thumb', 534, 464, true );
	add_image_size( 'vmag-horizontal-thumb', 535, 261, true );
	add_image_size( 'vmag-featured-thumb', 480, 357, true );
	add_image_size( 'vmag-vertical-slider-thumb', 500, 575, true );
	add_image_size( 'vmag-rectangle-thumb', 510, 369, true );
	add_image_size( 'vmag-small-thumb', 320, 224, true );
	add_image_size( 'vmag-single-large', 1200, 630, true );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary_menu' => esc_html__( 'Primary Menu', 'vmag' ),
		'top_menu' => esc_html__( 'Top Header Menu', 'vmag' ),
		'footer_menu' => esc_html__( 'Footer Menu', 'vmag' )
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

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'audio',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'vmag_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'vmag_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function vmag_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'vmag_content_width', 640 );
}
add_action( 'after_setup_theme', 'vmag_content_width', 0 );

/**
 * Load VMag extra/custom functions file
 */
require get_template_directory() . '/inc/vmag-functions.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load metaboxes
 */
require get_template_directory() . '/inc/metabox/vmag-post-metabox.php'; //post metabox
require get_template_directory() . '/inc/metabox/vmag-page-metabox.php'; //page metabox

/**
 * Custom classes for customizer.
 */
require get_template_directory() . '/inc/assets/vmag-customizer-classes.php';

/**
 * Sanitize fields.
 */
require get_template_directory() . '/inc/assets/vmag-sanitize.php';

/**
 * Load VMag widget areas
 */
require get_template_directory() . '/inc/vmag-widget-functions.php';

/**
 * Vmag Breadcrumbs function
 */
require get_template_directory() . '/inc/vmag-breadcrumbs.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/assets/customizer/customizer.php';
require get_template_directory() . '/inc/assets/customizer/general-panel.php'; // General Settings panel
require get_template_directory() . '/inc/assets/customizer/header-panel.php'; // Header Settings panel
require get_template_directory() . '/inc/assets/customizer/design-panel.php'; // Design Settings panel

/**
 * Add Welcome Page
 */
require get_template_directory() . '/welcome/welcome.php';

/**
 * Registers an editor stylesheet for the theme.
 */
function vmag_add_editor_styles() {
    add_editor_style( 'css/custom-editor-style.css' );
}
add_action( 'admin_init', 'vmag_add_editor_styles' );