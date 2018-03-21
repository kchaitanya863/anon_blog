<?php
/**
 * AccessBuddy custom functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package AccessPress Themes
 * @subpackage AccessBuddy
 * @since 1.0.0
 */
/*-----------------------------------------------------------------------------------------------------------------*/
/**
 * Define variable for theme version
 *
 * @since 1.0.0
 */
$accessbuddy_theme_details = wp_get_theme();
$accessbuddy_theme_version = $accessbuddy_theme_details->Version;

/*-----------------------------------------------------------------------------------------------------------------*/
/**
 * Enqueue scripts and styles.
 *
 * @since 1.0.0
 */
function accessbuddy_scripts() {

	global $accessbuddy_theme_version;

	$accessbuddy_fonts_args = array(
        'family' => 'Open+Sans:400,600,700,300|Poppins:400,500,600|Roboto:300,400,500,700'
    );

    wp_enqueue_style( 'accessbuddy-google-fonts', add_query_arg( $accessbuddy_fonts_args, "//fonts.googleapis.com/css" ) );
	
	wp_enqueue_style( 'lightslider-style', get_template_directory_uri() . '/assets/library/lightslider/css/lightslider.css', array(), '1.1.3' );
	wp_enqueue_style( 'font-awesome-style', get_template_directory_uri() . '/assets/library/font-awesome/css/font-awesome.min.css', array(), '4.6.3' );
	wp_enqueue_style( 'accessbuddy-style', get_stylesheet_uri(), array(), esc_attr( $accessbuddy_theme_version ) );

	wp_enqueue_script( 'lightslider', get_template_directory_uri() . '/assets/library/lightslider/js/lightslider.js', array( 'jquery' ), '1.1.3', true );
	wp_enqueue_script( 'jquery-counterup', get_template_directory_uri() . '/assets/library/counterup/js/jquery.counterup.min.js', '1.0', true );
	wp_enqueue_script( 'jquery-waypoints', get_template_directory_uri() . '/assets/library/waypoints/js/jquery.waypoints.min.js', '2.0.5', true );
	wp_enqueue_script( 'accessbuddy-scripts', get_template_directory_uri() . '/assets/js/custom-scripts.js', array( 'jquery' ), esc_attr( $accessbuddy_theme_version ), true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'accessbuddy_scripts' );

/*-----------------------------------------------------------------------------------------------------------------*/
/**
 * Enqueue scripts/styles for admin area
 *
 * @since 1.0.0
 */
if( ! function_exists( 'accessbuddy_admin_scripts' ) ):
	function accessbuddy_admin_scripts() {
		global $accessbuddy_theme_version;

        if ( function_exists( 'wp_enqueue_media' ) ) {
            wp_enqueue_media();
        }

        wp_register_script( 'of-media-uploader', get_template_directory_uri() . '/assets/js/media-uploader.js', array('jquery'), 1.70);
        wp_enqueue_script( 'of-media-uploader' );
        wp_localize_script( 'of-media-uploader', 'accessbuddy_l10n', array(
            'upload' => esc_html__( 'Upload', 'accessbuddy' ),
            'remove' => esc_html__( 'Remove', 'accessbuddy' )
        ));

		wp_enqueue_style( 'accessbuddy-admin-style', get_template_directory_uri() . '/assets/css/admin-styles.css', array(), esc_attr( $accessbuddy_theme_version ) );

		wp_enqueue_script( 'jquery-ui-button' );

		wp_enqueue_script( 'accessbuddy-admin-scripts', get_template_directory_uri() . '/assets/js/admin-scripts.js', array( 'jquery', 'jquery-ui-button' ), esc_attr( $accessbuddy_theme_version ), true );
	}
endif;

add_action( 'admin_enqueue_scripts', 'accessbuddy_admin_scripts' );

/*-----------------------------------------------------------------------------------------------------------------*/
/**
 * Display news ticker
 *
 * @since 1.0.0
 */

if( ! function_exists( 'accessbuddy_news_ticker_hook' ) ):
	function accessbuddy_news_ticker_hook() {
		$ab_ticker_option = get_theme_mod( 'ab_ticker_option', 'show' );
		$ab_ticker_caption = get_theme_mod( 'ab_ticker_caption', __( 'Trending News', 'accessbuddy' ) );
		if( $ab_ticker_option != 'hide' ) {
?>
		<div class="ab-newsticker-wrapper">
			<div class="ab-container">
				<div class="ab-ticker-caption">
					<span><?php echo esc_html( $ab_ticker_caption ); ?></span>
				</div>
<?php
			$ab_ticker_args = array(
								'post_type' => 'post',
								'posts_per_page' => 5,
								'ignore_sticky_posts' => 1
							);
			$ab_ticker_query = new WP_Query( $ab_ticker_args );
			if( $ab_ticker_query->have_posts() ) {
				echo '<ul id="ab-ticker" class="cS-hidden">';
				while( $ab_ticker_query->have_posts() ) {
					$ab_ticker_query->the_post();
		?>
					<li>
						<div class="single-news">
							<a href="<?php the_permalink(); ?>"><?php the_title();?></a>
						</div>
					</li>
		<?php
				}
				echo '</li>';
			}
			wp_reset_query();
	?>
			</div><!-- .ab-container -->
		</div><!-- .ab-newsticker-wrapper -->
	<?php
		}
	}
endif;
add_action( 'accessbuddy_news_ticker', 'accessbuddy_news_ticker_hook', 10 );

/*------------------------------------------------------------------------------------------------------------------*/
/**
 * Dropdown for categories
 *
 * @since 1.0.0
 */
$accessbuddy_categories = get_categories( array( 'hide_empty' => 0 ) );
$accessbuddy_cat_dropdown['0'] = __( 'Select Category', 'accessbuddy' );
foreach ( $accessbuddy_categories as $accessbuddy_category ) {
	$accessbuddy_cat_dropdown[$accessbuddy_category->term_id] = $accessbuddy_category->cat_name;
}

/*-----------------------------------------------------------------------------------------------------------------*/
/**
 * Post format icons for homepage post
 *
 * @since 1.0.0
 */
if( !function_exists( 'accessbuddy_post_format_icon' ) ):
    function accessbuddy_post_format_icon() {
        global $post;
        $post_id = $post->ID;
        $accessbuddy_post_format = get_post_format( $post_id );
        switch ( $accessbuddy_post_format ) {
            case 'video':
                $post_format_icon = '<i class="fa fa-play"></i>';
                break;
            case 'audio':
                $post_format_icon = '<i class="fa fa-volume-up"></i>';
                break;            
            default:
                $post_format_icon = '';
                break;
        }
        if( $post_format_icon ) {
            echo '<span class="format-icon">'. $post_format_icon .'</span>';
        }
    }
endif;

/*-----------------------------------------------------------------------------------------------------------------*/
/**
 * Function for excerpt length
 *
 * @since 1.0.0
 */
if( ! function_exists( 'accessbuddy_get_excerpt_content' ) ):
    function accessbuddy_get_excerpt_content( $content, $limit ) {
        $striped_content = strip_tags( $content );
        $striped_content = strip_shortcodes( $striped_content );
        $limit_content = mb_substr( $striped_content, 0 , $limit );
        if( $limit_content < $content ){
            $limit_content .= "..."; 
        }
        return $limit_content;
    }
endif;
/*-----------------------------------------------------------------------------------------------------------------*/
/**
 * Function for excerpt length in archive
 *
 * @since 1.0.0
 */
if( ! function_exists( 'accessbuddy_archive_excerpt' ) ):
    function accessbuddy_archive_excerpt( $content, $limit ) {
        $content = strip_tags( $content );
        $content = strip_shortcodes( $content );
        $words = explode( ' ', $content );    
        return implode( ' ', array_slice( $words, 0, $limit ));
    }
endif;
/*-----------------------------------------------------------------------------------------------------------------*/
/**
 * Function define about page/post/archive sidebar
 *
 * @since 1.0.0
 */
if( ! function_exists( 'accessbuddy_get_sidebar' ) ):
function accessbuddy_get_sidebar() {
    
    $archive_sidebar = get_theme_mod( 'ab_archive_sidebar', 'right_sidebar' );
    $post_default_sidebar = get_theme_mod( 'ab_default_post_sidebar', 'right_sidebar' );
    $page_default_sidebar = get_theme_mod( 'ab_default_page_sidebar', 'right_sidebar' );

        if( is_single() ) {
            if( $post_default_sidebar == 'right_sidebar' ) {
                get_sidebar();
            } elseif( $post_default_sidebar == 'left_sidebar' ) {
                get_sidebar( 'left' );
            }
            //var_dump($post_default_sidebar);
        } elseif( is_page() ) {
            if( $page_default_sidebar == 'right_sidebar' ) {
                get_sidebar();
            } elseif( $page_default_sidebar == 'left_sidebar' ) {
                get_sidebar( 'left' );
            }
        } elseif( $archive_sidebar == 'right_sidebar' ) {
            get_sidebar();
        } elseif( $archive_sidebar == 'left_sidebar' ) {
            get_sidebar( 'left' );
        }
}
endif;

/*-----------------------------------------------------------------------------------------------------------------*/
/**
 * Get media attachment id from url
 *
 * @since 1.0.0
 */ 
if ( ! function_exists( 'accessbuddy_get_attachment_id_from_url' ) ):
    function accessbuddy_get_attachment_id_from_url( $attachment_url ) {     
        global $wpdb;
        $attachment_id = false;
     
        // If there is no url, return.
        if ( '' == $attachment_url )
            return;
     
        // Get the upload directory paths
        $upload_dir_paths = wp_upload_dir();
     
        // Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
        if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {
     
            // If this is the URL of an auto-generated thumbnail, get the URL of the original image
            $attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );
     
            // Remove the upload path base directory from the attachment URL
            $attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );
     
            // Finally, run a custom database query to get the attachment ID from the modified attachment URL
            $attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );
     
        }     
        return $attachment_id;
    }
endif;