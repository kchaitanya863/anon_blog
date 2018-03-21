<?php
/**
 * Register widget area and call widget files
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @package VMag
 */

if( !function_exists( 'vmag_widgets_init' ) ) :
	function vmag_widgets_init() {

		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar', 'vmag' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'vmag' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Left Sidebar', 'vmag' ),
			'id'            => 'vmag_left_sidebar',
			'description'   => esc_html__( 'Add widgets here.', 'vmag' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Featured Slider Area', 'vmag' ),
			'id'            => 'vmag_featured_slider_area',
			'description'   => esc_html__( 'This area is for showing widgets in the home page and it is best to display widget VMag: Featured Slider', 'vmag' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Home Page Blocks Area', 'vmag' ),
			'id'            => 'vmag_homepage_blocks_area',
			'description'   => esc_html__( 'This area is for showing widgets in the home page and it is best to display widgets VMag: Block Posts (Style 1), VMag: Block Post (Style 2), VMag: Block Post (List), VMag: Block Post (Style 3), Category Posts (Slider), VMag: Category Post (List) ', 'vmag' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Home Page Sidebar Area', 'vmag' ),
			'id'            => 'vmag_homepage_sidebar_area',
			'description'   => esc_html__( 'This area is for showing widgets related to home page sidebar.', 'vmag' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Home Page Fullwidth Area ( First )', 'vmag' ),
			'id'            => 'vmag_homepage_fullwidth_area_one',
			'description'   => esc_html__( 'This area is for showing widgets in the home page and it is best to display widget VMag: Block Post(carousel)', 'vmag' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Home Page Fullwidth Area ( Second )', 'vmag' ),
			'id'            => 'vmag_homepage_fullwidth_area_two',
			'description'   => esc_html__( 'This area is for showing widgets in the home page and it is best to display widget VMag: Block Post(Column)', 'vmag' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );		

		register_sidebar( array(
			'name'          => esc_html__( 'Header Ads Area', 'vmag' ),
			'id'            => 'vmag_header_ads_area',
			'description'   => esc_html__( 'This area is for showing widget beside site logo.', 'vmag' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer Widget Column First', 'vmag' ),
			'id'            => 'vmag_footer_widget_column_first',
			'description'   => esc_html__( 'This area is for showing widget in first column at Footer widget area.', 'vmag' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer Widget Column Second', 'vmag' ),
			'id'            => 'vmag_footer_widget_column_second',
			'description'   => esc_html__( 'This area is for showing widget in second column at Footer widget area.', 'vmag' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer Widget Column Third', 'vmag' ),
			'id'            => 'vmag_footer_widget_column_third',
			'description'   => esc_html__( 'This area is for showing widget in third column at Footer widget area.', 'vmag' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer Widget Column Forth', 'vmag' ),
			'id'            => 'vmag_footer_widget_column_forth',
			'description'   => esc_html__( 'This area is for showing widget in forth column at Footer widget area.', 'vmag' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );

	}
endif;
add_action( 'widgets_init', 'vmag_widgets_init' );
/*--------------------------------------------------------------------------------------------------------*/
/**
 * Widget title function
 *
 * @param $widget_title string
 * @param $widget_title url
 *
 *  @return <h4>Widget title</h4> or <h4><a href="widget_title_url">widget title</a></h4> ( if widet url is not empty )
 */

if( ! function_exists( 'vmag_widget_title' ) ):
	function vmag_widget_title( $widget_title, $widget_title_url ) {
?>
		<h4 class="block-title">
<?php
		if( !empty( $widget_title_url ) ) {
			echo '<a href="'.esc_url( $widget_title_url ).'">'.esc_html( $widget_title ).'</a>';
		} else {
			echo esc_html( $widget_title );
		}
?>
		</h4>
<?php
	}
endif;
/*--------------------------------------------------------------------------------------------------------*/
/**
 * Title for tab in Tabbed Widget
 * 
 * @param $tabbed_title string
 * @param $vmag_cat_id intiger
 *
 * @return $tabbed_title or $category_title if parameter is empty
 *
 */
if( ! function_exists( 'vmag_tabbed_title' ) ):
	function vmag_tabbed_title( $tabbed_title, $vmag_cat_id ) {
		if( !empty( $tabbed_title ) ) {
			echo esc_html( $tabbed_title );
		} else {
			echo get_cat_name( $vmag_cat_id );
		}
	}
endif;
/*--------------------------------------------------------------------------------------------------------*/
/**
 * Checkboxes about admin roles
 */

$vmag_admin_roles = array(
		'subscriber'	=> esc_html__( 'Subscriber', 'vmag' ),
		'contributor'	=> esc_html__( 'Contributor', 'vmag' ),
		'author'		=> esc_html__( 'Author', 'vmag' ),
		'editor'		=> esc_html__( 'Editor', 'vmag' ),
		'administrator'	=> esc_html__( 'Administrator', 'vmag' ),
	);
/*--------------------------------------------------------------------------------------------------------*/
/**
 * View all icon in block section
 */
if( !function_exists( 'vmag_block_view_all' ) ):
	function vmag_block_view_all( $icon_option, $vmag_post_type, $vmag_block_cat_id ) {
		if( !empty( $icon_option ) && $vmag_post_type == 'category_posts' && $vmag_block_cat_id != null ) {
			$vmag_block_cat_link = get_category_link( $vmag_block_cat_id );
			$vmag_all_icon_value = apply_filters( 'vmag_view_all_icon', 'fa-th-large' );
?>
			<span class="view-all"><a href="<?php echo esc_url( $vmag_block_cat_link ); ?>" title="<?php _e( 'View all', 'vmag' ); ?>"><i class="fa <?php echo esc_attr( $vmag_all_icon_value ); ?>"></i></a></span>
<?php
		}
	}
endif;
/*--------------------------------------------------------------------------------------------------------*/
/**
 * Load individual widgets file and required related files too.
 */

require get_template_directory() . '/inc/widgets/vmag-widget-fields.php'; // widget fields
require get_template_directory() . '/inc/widgets/vmag-featured-slider.php'; // widget fields
require get_template_directory() . '/inc/widgets/vmag-block-style1.php'; // widget Block posts style1
require get_template_directory() . '/inc/widgets/vmag-block-style2.php'; // widget Block posts style2
require get_template_directory() . '/inc/widgets/vmag-block-style3.php'; // widget Block posts style3
require get_template_directory() . '/inc/widgets/vmag-block-list.php'; // widget Block posts list
require get_template_directory() . '/inc/widgets/vmag-block-column.php'; // widget Block posts column
require get_template_directory() . '/inc/widgets/vmag-block-carousel.php'; // widget Block posts carousel
require get_template_directory() . '/inc/widgets/vmag-category-slider.php'; // widget Category posts slider
require get_template_directory() . '/inc/widgets/vmag-category-list.php'; // widget Category posts List
require get_template_directory() . '/inc/widgets/vmag-leaderboard-ad.php'; // widget Leaderboard ads
require get_template_directory() . '/inc/widgets/vmag-medium-ad.php'; // widget medium rectangle ads
require get_template_directory() . '/inc/widgets/vmag-categories-tabbed.php'; // widget medium rectangle ads
require get_template_directory() . '/inc/widgets/vmag-authors.php'; // widget authors 