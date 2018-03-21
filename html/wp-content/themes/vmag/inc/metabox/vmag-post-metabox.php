<?php
/**
 * Functions for rendering metaboxes in post area
 * 
 * @package VMag
 */

add_action( 'add_meta_boxes', 'vmag_post_metabox' );

if( !function_exists( 'vmag_post_metabox' ) ):
	function vmag_post_metabox() {
		add_meta_box(
			'vmag_post_metabox_settings', // $id
			esc_html__( 'Post Options', 'vmag' ), // $title
			'vmag_post_metabox_settings_callback', // $callback
			'post', // $page
			'normal', // $context
			'high'
        ); // $priority
	}
endif; //vmag_post_metabox

$vmag_post_sidebar = array(
        'default-layout' => array(
                        'value'     => 'default_sidebar',
                        'label'     => esc_html__( 'Default Sidebar', 'vmag' ),
                        'thumbnail' => get_template_directory_uri() . '/inc/assets/images/default-sidebar.png'
                    ), 
        'right-sidebar' => array(
                        'value'     => 'right_sidebar',
                        'label'     => esc_html__( 'Right sidebar', 'vmag' ),
                        'thumbnail' => get_template_directory_uri() . '/inc/assets/images/right-sidebar.png'
                    ),
        'left-sidebar' => array(
                        'value'     => 'left_sidebar',
                        'label'     => esc_html__( 'Left sidebar', 'vmag' ),
                        'thumbnail' => get_template_directory_uri() . '/inc/assets/images/left-sidebar.png'
                    ),
        'no-sidebar' => array(
                        'value'     => 'no_sidebar',
                        'label'     => esc_html__( 'No sidebar Full width', 'vmag' ),
                        'thumbnail' => get_template_directory_uri() . '/inc/assets/images/no-sidebar.png'
                    ),
        
        'no-sidebar-center' => array(
                        'value'     => 'no_sidebar_center',
                        'label'     => esc_html__( 'No sidebar Centered', 'vmag' ),
                        'thumbnail' => get_template_directory_uri() . '/inc/assets/images/no-sidebar-center.png'
                    )    

    );

/**
 * Call back function for post option
 */
if( !function_exists( 'vmag_post_metabox_settings_callback' ) ):

	function vmag_post_metabox_settings_callback() {
		global $post, $vmag_post_sidebar;
		wp_nonce_field( basename( __FILE__ ), 'vmag_post_meta_nonce' );
?>
	<ul class="vmag-page-meta-tabs">
        <li class="meta-menu-titlebar active" atr="pg-metabox-info"><i class="fa fa-info"></i><?php _e( 'Information', 'vmag' ); ?></li>
        <li class="meta-menu-sidebars" atr="pg-metabox-sidebars"><i class="fa fa-map-o"></i><?php _e( 'Sidebars', 'vmag' ); ?></li>
    </ul><!--.tmp-page-meta-tabs-->
    <div class="pg-metabox">
            <!-- Header -->
            <div id="pg-metabox-info" class="pg-metabox-inside">
                <h3><?php _e( 'About Metabox Options', 'vmag' ); ?></h3>
                <hr />
                <ul>
                    <li><?php _e( 'This option allows to set a specific layout for this post.', 'vmag' ); ?></li>
                </ul>
            </div><!-- #pg-metabox-info-->

            <!-- Page sidebars -->
            <div id="pg-metabox-sidebars" class="pg-metabox-inside">
            	<div class="meta-row">
                    <div class="meta-title"> <?php _e( 'Available Sidebars', 'vmag' ); ?> </div>
                    <span class="section-desc"><em><?php _e( 'Choose between available layouts.', 'vmag' ); ?></em></span>
                    <div class="meta-options">
                        <div class="layout-thmub-section">
			                <ul class="single-sidebar-layout" id="vmag-img-container-meta">
			                <?php
			                    $img_count = 0 ; 
			                   foreach ( $vmag_post_sidebar as $field ) {
			                        $img_count++;
			                        $vmag_sidebar_meta_layout = get_post_meta( $post->ID, 'vmag_page_sidebar', true );
			                        $default_class ='';
			                        if( empty( $vmag_sidebar_meta_layout ) && $img_count == 1 ){
			                            $default_class = 'vmag-radio-img-selected';
			                        }
			                        $img_class = ( $field['value'] == $vmag_sidebar_meta_layout )?'vmag-radio-img-selected vmag-radio-img-img':'vmag-radio-img-img'; 
			                ?>
			                    <li>
			                        <label>
			                            <img class="<?php echo esc_attr( $default_class.' '.$img_class );?>" src="<?php echo esc_url( $field['thumbnail'] ); ?>" alt="<?php echo esc_attr( $field['label'] );?>" title="<?php echo esc_attr( $field['label'] );?>" />
			                            <input style = 'display:none' type="radio" value="<?php echo esc_attr( $field['value'] ); ?>" name="vmag_page_sidebar" <?php checked( $field['value'], $vmag_sidebar_meta_layout ); if( empty( $vmag_sidebar_meta_layout ) && $field['value'] == 'default_sidebar' ){ echo "checked='checked'";}  ?> />
			                        </label>
			                    </li>
			                    
			                <?php } ?>
			                </ul>
			            </div><!-- .layout-thmub-section -->
                    </div><!-- .meta-options -->
                </div>
            </div><!-- #pg-metabox-sidebars -->
        </div><!--.pg-metabox-->
    <div class="clear"></div>
<?php
	}
endif;

/**
 * Function for save sidebar layout of post
 */
add_action( 'save_post', 'vmag_save_post_settings' );

if( ! function_exists( 'vmag_save_post_settings' ) ):

function vmag_save_post_settings( $post_id ) {

    global $post, $vmag_post_sidebar;
    // Verify the nonce before proceeding.
    if ( !isset( $_POST[ 'vmag_post_meta_nonce' ] ) || !wp_verify_nonce( $_POST[ 'vmag_post_meta_nonce' ], basename( __FILE__ ) ) )
        return;

    // Stop WP from clearing custom fields on autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE) {
    	return;
    }        
        
    if ( 'page' == $_POST['post_type'] ) {
        if ( !current_user_can( 'edit_page', $post_id ) ){
        	return $post_id;  
        }            
    } elseif ( !current_user_can( 'edit_post', $post_id ) ) {  
            return $post_id;  
    }

    //$page_template_value = the_monday_get_page_template( $post->ID );    

    /*Post sidebar*/    
    $old = get_post_meta( $post_id, 'vmag_page_sidebar', true ); 
    $new = sanitize_text_field( $_POST['vmag_page_sidebar'] );
    if ( $new && $new != $old ) {  
        update_post_meta ( $post_id, 'vmag_page_sidebar', $new );  
    } elseif ( '' == $new && $old ) {  
        delete_post_meta( $post_id,'vmag_page_sidebar', $old );  
    }

}
endif;