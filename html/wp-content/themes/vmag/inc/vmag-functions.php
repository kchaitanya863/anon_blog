<?php
/**
 *  Define custom or extra function which needed for VMag
 *
 * @package VMag
 */

$vmag_theme = wp_get_theme();
$vmag_version = $vmag_theme->get( 'Version' );

add_action( 'admin_enqueue_scripts', 'vmag_admin_scripts' );

function vmag_admin_scripts() {
	global $vmag_version;
	
	if ( function_exists( 'wp_enqueue_media' ) ) {
        wp_enqueue_media();
	}

    wp_register_script( 'of-media-uploader', get_template_directory_uri() . '/inc/js/media-uploader.js', array('jquery'), 1.70);
    wp_enqueue_script( 'of-media-uploader' );
    wp_localize_script( 'of-media-uploader', 'vmag_l10n', array(
        'upload' => esc_html__( 'Upload', 'vmag' ),
        'remove' => esc_html__( 'Remove', 'vmag' )
    ));
    wp_enqueue_script( 'vmag-admin-script', get_template_directory_uri() .'/inc/js/vmag-admin-scripts.js', array( 'jquery' ), $vmag_version, true );

    wp_enqueue_style( 'vmag-admin-style', get_template_directory_uri() . '/inc/css/admin-style.css', $vmag_version );
}

/**
 * Enqueue scripts and styles.
 */
function vmag_scripts() {
	global $vmag_version;
    
    wp_enqueue_script( 'lightslider', get_template_directory_uri() .'/js/lightslider.js', array( 'jquery' ), '1.1.5', true );
    wp_enqueue_script( 'wow', get_template_directory_uri() .'/js/wow.js', array( 'jquery' ), '1.1.2', true );
	wp_register_script( 'vmag-custom-script', get_template_directory_uri() .'/js/vmag-custom.js', array( 'jquery' ), $vmag_version, true );
    /**
     * wp localize
     */
    $animation_option = get_theme_mod( 'vmag_wow_animation_option', 'enable' );
    wp_localize_script( 'vmag-custom-script', 'WowOption', array(
        'mode'=> $animation_option
        ) );
    wp_enqueue_script( 'vmag-custom-script' );

	$vmag_font_args = array(
        'family' => 'Open+Sans:400,600,700,400italic,300|Roboto:400,500,700,300,400italic',
    );
    wp_enqueue_style( 'vmag-google-fonts', add_query_arg( $vmag_font_args, "//fonts.googleapis.com/css" ) );
	wp_enqueue_style( 'vmag-style', get_stylesheet_uri(), array(), $vmag_version );
	wp_enqueue_style( 'lightslider-style', get_template_directory_uri() .'/css/lightslider.css', array( 'vmag-style' ), '1.1.5' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() .'/css/font-awesome.css', array('vmag-style'), '4.5.0' );
    wp_enqueue_style( 'animate-css', get_template_directory_uri() .'/css/animate.css', array('vmag-style'), '3.5.1' );
    wp_enqueue_style( 'vmag-responsive-style', get_template_directory_uri(). '/css/responsive.css', array(), $vmag_version );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'vmag_scripts' );

if ( ! function_exists( 'vmag_the_custom_logo' ) ) :
	/**
	 * Displays the optional custom logo.
	 *
	 * Does nothing if the custom logo is not available.
	 */
	function vmag_the_custom_logo() {
		if ( function_exists( 'the_custom_logo' ) ) {
			the_custom_logo();
		}
	}
endif;

if( ! function_exists( 'vmag_news_ticker_hook' ) ):
	/**
	 * Display news ticker
	 */
	function vmag_news_ticker_hook() {
		$vmag_ticker_option = get_theme_mod( 'vmag_ticker_option', 'show' );
		$vmag_ticker_caption = get_theme_mod( 'vmag_ticker_caption', esc_html__( 'Recent News', 'vmag' ) );
		if( $vmag_ticker_option != 'hide' ) {
?>
		<div class="vmag-ticker-caption">
			<span><?php echo esc_html( $vmag_ticker_caption ); ?></span>
		</div>
<?php
			$vmag_ticker_args = array(
									'post_type' => 'post',
									'posts_per_page' => 5,
									'ignore_sticky_posts' => 1
								);
			$vmag_ticker_query = new WP_Query( $vmag_ticker_args );
			if( $vmag_ticker_query->have_posts() ) {
				echo '<ul id="vmag-news-ticker" class="cS-hidden">';
				while( $vmag_ticker_query->have_posts() ) {
					$vmag_ticker_query->the_post();
		?>
					<li>
						<div class="single-news"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></div>
					</li>
		<?php
				}
				echo '</li>';
			}
		}
	}
endif;
add_action( 'vmag_news_ticker', 'vmag_news_ticker_hook' );

/**
 * Define categories lists in array
 */
$vmag_categories = get_categories( array( 'hide_empty' => 0 ) );
foreach ( $vmag_categories as $vmag_category ) {
	$vmag_cat_array[$vmag_category->term_id] = $vmag_category->cat_name;
}

//categories in dropdown
$vmag_cat_dropdown['0'] = esc_html__( 'Select Category', 'vmag' );
foreach ( $vmag_categories as $vmag_category ) {
	$vmag_cat_dropdown[$vmag_category->term_id] = $vmag_category->cat_name;
}

/**
 * radio option for types
 */
$vmag_posts_type = array(
	'latest_posts'   => esc_html__( 'From Latest Posts', 'vmag' ),
	'category_posts' => esc_html__( 'From Selected Category', 'vmag' )
	);

/**
 * Select options for column
 */
$vmag_column_choice = array(
		''	=> esc_html__( 'Select No.of Column', 'vmag' ),
		'1' => esc_html__( '1 Column', 'vmag' ),
		'2' => esc_html__( '2 Columns', 'vmag' ),
		'3' => esc_html__( '3 Columns', 'vmag' ),
		'4' => esc_html__( '4 Columns', 'vmag' )
	);

/**
 * Function about custom query arguments
 * 
 * @param string $vmag_query_type (required options "latest_posts" or "	")
 * @param int $vmag_post_count
 * @param int $vmag_cat_id
 * @return array $vmag_args
 */
if( ! function_exists( 'vmag_query_args' ) ) :
	function vmag_query_args( $vmag_query_type, $vmag_post_count, $vmag_cat_id = null ) {
		if( $vmag_query_type == 'category_posts' && !empty( $vmag_query_type ) ) {
			$vmag_args = array(
							'post_type' 	=> 'post',
							'category__in'	=> $vmag_cat_id,
							'posts_per_page'=> $vmag_post_count						
							);
		} else {
			$vmag_args = array(
							'post_type'		=> 'post',						
							'posts_per_page'=> $vmag_post_count,
							'ignore_sticky_posts' => 1
							);

		}
		return $vmag_args;
	}
endif;

/**
 * Function to display current date
 */
add_action( 'vmag_header_date', 'vmag_header_date_hook' );

if( ! function_exists( 'vmag_header_date_hook' ) ):
	function vmag_header_date_hook() {
		$vmag_date_option = get_theme_mod( 'vmag_header_date_option', 'show' );
		if( $vmag_date_option != 'hide' ) {
?>
			<div class="vmag-current-date"><?php echo esc_html( date_i18n( 'l, F j, Y' ) ); ?></div>
<?php
		}
	}
endif;

/**
 * Changed excerpt more
 */
add_filter( 'excerpt_more', 'vmag_custom_excerpt_more' );

if( ! function_exists( 'vmag_custom_excerpt_more' ) ):
	function vmag_custom_excerpt_more( $more ) {
		return '...';
	}
endif;

/**
 * Get media attachment id from url
 */ 
if ( ! function_exists( 'vmag_get_attachment_id_from_url' ) ):
    function vmag_get_attachment_id_from_url( $attachment_url ) {     
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

/**
 * Widgets count in widget area
 */
function vmag_widgets_count( $sidebar_id ) {
	global $_wp_sidebars_widgets;
	if ( empty( $_wp_sidebars_widgets ) ) {
		$_wp_sidebars_widgets = get_option( 'sidebars_widgets', array() );
	}

	$sidebars_widgets_count = $_wp_sidebars_widgets;

	if ( isset( $sidebars_widgets_count[ $sidebar_id ] ) ) {
		$widget_count = count( $sidebars_widgets_count[ $sidebar_id ] );
		$widget_classes = 'widget-column-' . count( $sidebars_widgets_count[ $sidebar_id ] );
		return $widget_classes;
	}
}

/**
 * Function define about page/post/archive sidebar
 */
if( ! function_exists( 'vmag_get_sidebar' ) ):
function vmag_get_sidebar() {
    global $post;
    if( $post ) {
        $sidebar_meta_option = get_post_meta( $post->ID, 'vmag_page_sidebar', true );
    }
     
    if( is_home() ) {
        $set_id = get_option( 'page_for_posts' );
		$sidebar_meta_option = get_post_meta( $set_id, 'vmag_page_sidebar', true );
    }
    
    if( empty( $sidebar_meta_option ) || is_archive() || is_search() ) {
        $sidebar_meta_option = 'default_sidebar';
    }
    
    $vmag_archive_sidebar = get_theme_mod( 'vmag_archive_sidebar', 'right_sidebar' );
    $vmag_post_default_sidebar = get_theme_mod( 'vmag_default_post_sidebar', 'right_sidebar' );
    $vmag_page_default_sidebar = get_theme_mod( 'vmag_default_page_sidebar', 'right_sidebar' );
    
    if( $sidebar_meta_option == 'default_sidebar' ) {
        if( is_single() ) {
            if( $vmag_post_default_sidebar == 'right_sidebar' ) {
                get_sidebar();
            } elseif( $vmag_post_default_sidebar == 'left_sidebar' ) {
                get_sidebar( 'left' );
            }
        } elseif( is_page() ) {
            if( $vmag_page_default_sidebar == 'right_sidebar' ) {
                get_sidebar();
            } elseif( $vmag_page_default_sidebar == 'left_sidebar' ) {
                get_sidebar( 'left' );
            }
        } elseif( $vmag_archive_sidebar == 'right_sidebar' ) {
            get_sidebar();
        } elseif( $vmag_archive_sidebar == 'left_sidebar' ) {
            get_sidebar( 'left' );
        }
    } elseif( $sidebar_meta_option == 'right_sidebar' ) {
        get_sidebar();
    } elseif( $sidebar_meta_option == 'left_sidebar' ) {
        get_sidebar( 'left' );
    }
}
endif;

/**
 * Related posts
 */
add_action( 'vmag_related_posts', 'vmag_related_posts_hook' );
if( !function_exists( 'vmag_related_posts_hook' ) ):
    function vmag_related_posts_hook() {
        $vmag_related_posts_option = get_theme_mod( 'vmag_related_posts_option', 'show' );
        $vmag_related_post_title = get_theme_mod( 'vmag_related_posts_title', esc_html__( 'Related Articles', 'vmag' ) );
        if( $vmag_related_posts_option != 'hide' ) {
?>
            <div class="vmag-related-wrapper">
                <h4 class="related-title"><?php echo esc_attr( $vmag_related_post_title ); ?></h4>
        <?php
                wp_reset_postdata();
                global $post;
                if( empty( $post ) ) {
                    $post_id = '';
                } else {
                    $post_id = $post->ID;
                }

                $vmag_related_posts_type = get_theme_mod( 'vmag_related_post_type', 'related_cat' );
                $vmag_perpage_value = 3;
                $vmag_perpage_value = apply_filters( 'related_posts_count', $vmag_perpage_value );

                // Define related post arguments
                $related_args = array(
                    'no_found_rows'            => true,
                    'update_post_meta_cache'   => false,
                    'update_post_term_cache'   => false,
                    'ignore_sticky_posts'      => 1,
                    'orderby'                  => 'rand',
                    'post__not_in'             => array( $post_id ),
                    'posts_per_page'           => $vmag_perpage_value
                );

                
                if ( $vmag_related_posts_type == 'related_tag' ) {
                    $tags = wp_get_post_tags( $post_id );
                    if ( $tags ) {
                        $tag_ids = array();
                        foreach( $tags as $individual_tag ) $tag_ids[] = $individual_tag->term_id;
                        $related_args['tag__in'] = $tag_ids;
                    }
                } else {
                    $categories = get_the_category( $post_id );
                    if ( $categories ) {
                        $category_ids = array();
                        foreach( $categories as $individual_category ) {
                            $category_ids[] = $individual_category->term_id;
                        }
                        $related_args['category__in'] = $category_ids;
                    }
                }

                $related_query = new WP_Query( $related_args );
                if( $related_query->have_posts() ) {
                    echo '<div class="related-posts-wrapper clearfix">';
                    while( $related_query->have_posts() ) {
                        $related_query->the_post();
                        $image_id = get_post_thumbnail_id();
                        $image_path = wp_get_attachment_image_src( $image_id, 'vmag-rectangle-thumb', true );
                        $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                ?>
                        <div class="single-post">
                            <div class="post-thumb">
                                <?php if( has_post_thumbnail() ) { ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php echo esc_url( $image_path[0] ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" title="<?php the_title(); ?>" />
                                    </a>
                                <?php } ?>
                            </div>
                            
                            <h3 class="small-font"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        </div><!--. single-post -->
                <?php
                    }
                    echo '</div>';
                }
                wp_reset_query();
        ?>
            </div><!-- .vmag-related-wrapper -->
<?php
        }
    }
endif;

/**
 * Function to get author info
 */
add_action( 'vmag_author_info', 'vmag_author_info_hook' );
if( ! function_exists( 'vmag_author_info_hook' ) ):
    function vmag_author_info_hook() {
        global $post;
        $author_id = $post->post_author;
        $author_avatar = get_avatar( $author_id, '132' );
        $author_nickname = get_the_author_meta( 'display_name' );
        $vmag_author_option = get_theme_mod( 'vmag_author_info_option', 'show' );
        if( $vmag_author_option != 'hide' ) {
?>
            <div class="vmag-author-metabox clearfix">
                <div class="author-avatar">
                    <a class="author-image" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>"><?php echo $author_avatar; ?></a>
                </div><!-- .author-avatar -->
                <div class="author-desc-wrapper">                
                    <a class="author-title" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>"><?php echo esc_html( $author_nickname ); ?></a>
                    <div class="author-description"><?php echo get_the_author_meta('description');?></div>
                    <a href="<?php echo esc_url( get_the_author_meta( 'user_url' ) );?>" target="_blank"><?php echo esc_url( get_the_author_meta( 'user_url' ) );?></a>
                </div><!-- .author-desc-wrapper-->
            </div><!--vmag-author-metabox-->
<?php
        }
    }
endif;

/**
 * Move comment fields at bottom
 */
function vmag_move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}
add_filter( 'comment_form_fields', 'vmag_move_comment_field_to_bottom' );

/**
 * Icons in menu section
 */
add_action( 'vmag_menu_search_icon', 'vmag_menu_search_icon_hook' );
if( ! function_exists( 'vmag_menu_search_icon_hook' ) ):
    function vmag_menu_search_icon_hook() {
        $vmag_search_icon = get_theme_mod( 'vmag_menu_search_option', 'show' );
        if( $vmag_search_icon != 'hide' ) {
    ?>
            <div class="vmag-search-form-primary"><?php get_search_form(); ?></div>
            <span class="icon-search vmag-search-in-primary"></span>
    <?php
        }
    }
endif;

add_action( 'vmag_menu_random_icon', 'vmag_menu_random_icon_hook' );
if( ! function_exists( 'vmag_menu_random_icon_hook' ) ):
    function vmag_menu_random_icon_hook() {
        $vmag_random_icon = get_theme_mod( 'vmag_menu_random_option', 'show' );
        if( $vmag_random_icon != 'hide' ) {
            $vmag_random_post_args = array( 
                        'posts_per_page'        => 1,
                        'post_type'             => 'post',
                        'ignore_sticky_posts'   => true,
                        'orderby'               => 'rand'
                    );
            $vmag_random_post_query = new WP_Query( $vmag_random_post_args );
            while( $vmag_random_post_query->have_posts() ) {
                $vmag_random_post_query->the_post();
    ?>
                <a href="<?php the_permalink(); ?>" class="icon-random" title="<?php _e( 'View a random post', 'vmag' ); ?>"></a>
    <?php
            }
            wp_reset_query();
        }
    }
endif;

/**
 * Filter the except length to required characters.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
/*function vmag_get_excerpt_content_length( $length ) {
    return $length;
}
add_filter( 'excerpt_length', 'vmag_get_excerpt_content_length', 999 );*/

/**
 * Function for excerpt length
 */
if( ! function_exists( 'vmag_get_excerpt_content' ) ):
    function vmag_get_excerpt_content( $content, $limit ) {
        $striped_content = strip_tags( $content );
        $striped_content = strip_shortcodes( $striped_content );
        $limit_content = mb_substr( $striped_content, 0 , $limit );
        if( $limit_content < $content ){
            $limit_content .= "..."; 
        }
        return $limit_content;
    }
endif;

/**
 * Function for excerpt length in archive
 */
if( ! function_exists( 'vmag_archive_excerpt' ) ):
    function vmag_archive_excerpt( $content, $limit ) {
        $content = strip_tags( $content );
        $content = strip_shortcodes( $content );
        $words = explode( ' ', $content );    
        return implode( ' ', array_slice( $words, 0, $limit ));
    }
endif;

/**
 * Function to escaping hex color
 */
function vmag_esc_hex_color( $color ) {
    if ( '' === $color )
        return '';

    // 3 or 6 hex digits, or the empty string.
    if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) )
        return $color;
}

/**
 * Single post format
 */
add_action( 'vmag_post_format_icon', 'vmag_post_format_icon_hook' );

if( !function_exists( 'vmag_post_format_icon_hook' ) ):
    function vmag_post_format_icon_hook() {
        global $post;
        $post_id = $post->ID;
        $vmag_post_format = get_post_format( $post_id );
        switch ( $vmag_post_format ) {
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
            echo '<span class="format-icon">'. wp_kses_post( $post_format_icon ) .'</span>';
        }
    }
endif;