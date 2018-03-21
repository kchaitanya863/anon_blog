<?php
/**
 * Create a metabox to added some custom filed in posts.
 *
 * @package AccessPress Themes
 * @subpackage AccessBuddy
 * @since 1.0.0
 */

 add_action( 'add_meta_boxes', 'accessbuddy_post_meta_options' );
 
 if( ! function_exists( 'accessbuddy_post_meta_options' ) ):
 function  accessbuddy_post_meta_options() {
    add_meta_box(
                'accessbuddy_post_meta', // $id
                esc_html__( 'Post Options', 'accessbuddy' ), // $title
                'accessbuddy_post_meta_callback', // $callback
                'post', // $page
                'normal', // $context
                'high'
            ); // $priority
 }
 endif;

 $accessbuddy_post_sidebar_options = array(
        'default-layout' => array(
                        'id'		=> 'post-defalut-layout',
                        'value'     => 'default_sidebar_layout',
                        'label'     => __( 'Default Sidebar', 'accessbuddy' ),
                        'thumbnail' => get_template_directory_uri() . '/assets/images/default-sidebar.png'
                    ), 
        'left-sidebar' => array(
                        'id'		=> 'post-right-sidebar',
                        'value'     => 'left_sidebar',
                        'label'     => __( 'Left sidebar', 'accessbuddy' ),
                        'thumbnail' => get_template_directory_uri() . '/assets/images/left-sidebar.png'
                    ), 
        'right-sidebar' => array(
                        'id'		=> 'post-left-sidebar',
                        'value' => 'right_sidebar',
                        'label' => __( 'Right sidebar', 'accessbuddy' ),
                        'thumbnail' => get_template_directory_uri() . '/assets/images/right-sidebar.png'
                    ),
        'no-sidebar' => array(
                        'id'		=> 'post-no-sidebar',
                        'value'     => 'no_sidebar',
                        'label'     => __( 'No sidebar Full width', 'accessbuddy' ),
                        'thumbnail' => get_template_directory_uri() . '/assets/images/no-sidebar.png'
                    ),        
        'no-sidebar-center' => array(
                        'id'		=> 'post-no-sidebar-center',
                        'value'     => 'no_sidebar_center',
                        'label'     => __( 'No sidebar Content Centered', 'accessbuddy' ),
                        'thumbnail' => get_template_directory_uri() . '/assets/images/no-sidebar-center.png'
                    )
    );

/**
 * Callback function for post option
 */
if( ! function_exists( 'accessbuddy_post_meta_callback' ) ):
	function accessbuddy_post_meta_callback() {
		global $post, $accessbuddy_post_sidebar_options;
		wp_nonce_field( basename( __FILE__ ), 'accessbuddy_post_meta_nonce' );
?>
		<div class="ab-meta-container clearfix">
			<ul class="ab-meta-menu-wrapper">
				<li class="ab-meta-tab active" id="ab-info-tab"><span class="dashicons dashicons-clipboard"></span><?php _e( 'Information', 'accessbuddy' ); ?></li>
				<li class="ab-meta-tab" id="ab-sidebar-tab"><span class="dashicons dashicons-exerpt-view"></span><?php _e( 'Sidebars', 'accessbuddy' ); ?></li>
			</ul><!-- .ab-meta-menu-wrapper -->
			<div class="ab-metabox-content-wrapper">
				
				<!-- Info tab content -->
				<div class="ab-single-meta active" id="ab-info-content">
					<div class="content-header">
						<h4><?php _e( 'About Metabox Options', 'accessbuddy' ) ;?></h4>
					</div><!-- .content-header -->
					<div class="meta-options-wrap">Semper principes ea qui, cu inermis disputationi eos. Eam ex indoctum salutandi assentior, ad veri sanctus his. Alii blandit prodesset his ne, affert partiendo ei vim. Debitis principes ei mei, ex alterum epicurei torquatos eam, odio agam sit eu. Dicam deterruisset et vel, ei verear iracundia vulputate quo. Pri noster integre probatus no.</div><!-- .meta-options-wrap  -->
				</div><!-- #ab-info-content -->

				<!-- Sidebar tab content -->
				<div class="ab-single-meta" id="ab-sidebar-content">
					<div class="content-header">
						<h4><?php _e( 'Available Sidebars', 'accessbuddy' ) ;?></h4>
						<span class="section-desc"><em><?php _e( 'Select sidebar from available options which replaced sidebar layout from customizer settings.', 'accessbuddy' ); ?></em></span>
					</div><!-- .content-header -->
					<div class="ab-meta-options-wrap">
						<div class="buttonset">
							<?php
			                   	foreach ( $accessbuddy_post_sidebar_options as $field ) {
			                    	$accessbuddy_post_sidebar = get_post_meta( $post->ID, 'ab_post_sidebar', true );
			                ?>
			                    	<input type="radio" id="<?php echo esc_attr( $field['id'] ); ?>" value="<?php echo $field['value']; ?>" name="ab_post_sidebar" <?php checked( $field['value'], $accessbuddy_post_sidebar ); if( empty( $accessbuddy_post_sidebar ) && $field['value'] == 'default_sidebar_layout' ){ echo "checked='checked'";}  ?> />
			                    	<label for="<?php echo esc_attr( $field['id'] ); ?>">
			                    		<span class="screen-reader-text"><?php echo esc_html( $field['label'] ); ?></span>
			                    		<img src="<?php echo esc_url( $field['thumbnail'] ); ?>" title="<?php echo esc_attr( $field['label'] ); ?>" alt="<?php echo esc_attr( $field['label'] ); ?>" />
			                    	</label>
			                    
			                <?php } ?>
						</div><!-- .buttonset -->
					</div><!-- .meta-options-wrap  -->
				</div><!-- #ab-sidebar-content -->

			</div><!-- .ab-metabox-content-wrapper -->
			</div><!-- .ab-meta-container -->
<?php		
	}
endif;

/*--------------------------------------------------------------------------------------------------------------*/
/**
 * Function for save value of meta opitons
 *
 * @since 1.0.0
 */
add_action( 'save_post', 'accessbuddy_save_post_meta' );

if( ! function_exists( 'accessbuddy_save_post_meta' ) ):

function accessbuddy_save_post_meta( $post_id ) {

    global $post, $accessbuddy_post_sidebar_options;

    // Verify the nonce before proceeding.
    if ( !isset( $_POST[ 'accessbuddy_post_meta_nonce' ] ) || !wp_verify_nonce( $_POST[ 'accessbuddy_post_meta_nonce' ], basename( __FILE__ ) ) )
        return;

    // Stop WP from clearing custom fields on autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )  
        return;
        
    if ('page' == $_POST['post_type']) {  
        if (!current_user_can( 'edit_page', $post_id ) )  
            return $post_id;  
    } elseif (!current_user_can( 'edit_post', $post_id ) ) {  
            return $post_id;  
    }

    /*Page sidebar*/
    foreach ( $accessbuddy_post_sidebar_options as $field ) {  
        //Execute this saving function
        $old = get_post_meta( $post_id, 'ab_post_sidebar', true ); 
        $new = sanitize_text_field( $_POST['ab_post_sidebar'] );
        if ( $new && $new != $old ) {  
            update_post_meta ( $post_id, 'ab_post_sidebar', $new );  
        } elseif ( '' == $new && $old ) {  
            delete_post_meta( $post_id,'ab_post_sidebar', $old );  
        }
    } // end foreach
}
endif;  