<?php
/**
 * Custom functions and definitions related to BuddyPress
 *
 * @package AccessPress Themes
 * @subpackage AccessBuddy
 * @since 1.0.0
 */
/*-----------------------------------------------------------------------------------------------------------------*/
/**
 * Function that checks if BuddyPress plugin is active
 *
 * @since 1.0.0
 */
function accessbuddy_is_bp_active() {
	if ( function_exists( 'bp_is_active' ) ) {
		return true;
	} else {
		return false;
	}
}

/*-----------------------------------------------------------------------------------------------------------------*/
/**
 * Function that checks if BbPress plugin is active
 *
 * @since 1.0.0
 */
function accessbuddy_is_bbp_active() {
	if ( class_exists( 'bbPress' ) ) {
		return true;
	} else {
		return false;
	}
}

/*-----------------------------------------------------------------------------------------------------------------*/
/**
 * Define function to show the notification at menu side
 *
 * @since 1.0.0
 */
if( ! function_exists( 'accessbuddy_notifications_menu' ) ):
	function accessbuddy_notifications_menu() {
		if ( accessbuddy_is_bp_active() ) {
			global $bp;

			if ( !is_user_logged_in() )
			    return false;

			echo '<div class="ab-top-notification">';
			_e( 'Alerts', 'accessbuddy' );

			if ( $notifications = bp_notifications_get_notifications_for_user( $bp->loggedin_user->id ) ) { ?>
			    <span><?php echo count( $notifications ) ?></span>
			<?php
			}

			echo '<ul>';

			if ( $notifications ) {
			    $counter = 0;
			    for ( $i = 0; $i < count($notifications); $i++ ) {
			        $alt = ( 0 == $counter % 2 ) ? ' class="alt"' : ''; ?>

			        <li<?php echo $alt ?>><?php echo $notifications[$i] ?></li>

			        <?php $counter++;
			    }
			} else { ?>

			    <li><a href="<?php echo esc_url( $bp->loggedin_user->domain ); ?>"><?php _e( 'You have no new alerts.', 'accessbuddy' ); ?></a></li>

			<?php
			}

			echo '</ul>';
				
			echo '</div>';
			
		}
	}
endif;


/*-----------------------------------------------------------------------------------------------------------------*/
/**
 * Add admin gravator in Nav Section
 *
 * @since 1.0.0
 */
function accessbuddy_user_profile_link() {
	if ( accessbuddy_is_bp_active() ) {
	if ( is_user_logged_in() ) {
		
?>

		<div class="ab-user-links">
			<a class="user-link" href="<?php echo bp_core_get_user_domain( get_current_user_id() ); ?>">
				<span class="name"><?php echo bp_core_get_user_displayname( get_current_user_id() ); ?></span>
				<span class="user-img-holder">
					<?php bp_loggedin_user_avatar( 'type=full&width=150&height=150' ); ?>
				</span>
			</a>
			<div class="item-list-tabs no-ajax" id="object-nav">
   				<ul class="menu">
                    <?php bp_get_loggedin_user_nav(); ?>
                </ul>
                <?php /*
   					bp_nav_menu(); 
   					bp_get_nav_menu_items();
                ?>
   				<span class="ab-logout">
					<a href="<?php echo esc_url( wp_logout_url() ); ?>" alt="<?php esc_attr_e( 'Logout', 'accessbuddy' ); ?>">
						<?php _e( 'Logout', 'accessbuddy' ); ?>
					</a>
				</span>
                <?php */ ?>
   			</div>
   		</div><!-- .ab-user-links -->		
<?php
	} else {
?>
		<span class="ab-login">
			<a href="<?php echo esc_url( wp_login_url() ); ?>" alt="<?php esc_attr_e( 'Login', 'accessbuddy' ); ?>">
    			<?php _e( 'Login', 'accessbuddy' ); ;?>
			</a>
		</span>
<?php
	}
}
}


/*-----------------------------------------------------------------------------------------------------------------*/
/**
 * Remove certain admin bar links useful as we using admin bar invisibly
 * @since 1.0.0
 *
 */
function accessbuddy_remove_admin_bar_links() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu( 'wp-logo' );
	$wp_admin_bar->remove_menu( 'search' );

	if ( !current_user_can( 'administrator' ) ):
		$wp_admin_bar->remove_menu( 'site-name' );
	endif;
}

add_action( 'wp_before_admin_bar_render', 'accessbuddy_remove_admin_bar_links' );
/*-----------------------------------------------------------------------------------------------------------------*/
/**
 * Replace admin bar "Howdy" text
 *
 * @since 1.0.0
 *
 */
function accessbuddy_replace_howdy( $wp_admin_bar ) {

	if ( is_user_logged_in() ) {

		$my_account	 = $wp_admin_bar->get_node( 'my-account' );
		$newtitle	 = str_replace( 'Howdy,', '', $my_account->title );
		$wp_admin_bar->add_node( array(
			'id'	 => 'my-account',
			'title'	 => $newtitle,
		) );
	}
}

add_filter( 'admin_bar_menu', 'accessbuddy_replace_howdy', 25 );

/*---------------------------------------------------------------------------------------------------------------*/
/**
 * Hide wp admin bar at front
 */

//add_filter( 'show_admin_bar', '__return_false' );

/*-----------------------------------------------------------------------------------------------------------------*/
/**
 * Get activity count by user
 *
 * @param int / array
 * @return int
 * @since 1.0.0
 */
function accessbuddy_get_activity_count_by_user() {
	if(accessbuddy_is_bp_active()){
	$args = array(
		'per_page' => 10000,
		'show_hidden' => true
	);

	if ( bp_has_activities( $args ) ) {
		global $activities_template;
		$count = $activities_template->activity_count;
	} else {
	$count = 0;
	}

	return $count;
}
}
/*
$followers = bp_follow_total_follow_counts();
var_dump($followers);*/

if ( ! defined( 'BP_AVATAR_THUMB_WIDTH' ) ) {
	define( 'BP_AVATAR_THUMB_WIDTH', 150 ); //change this with your desired thumb width
}

if ( ! defined( 'BP_AVATAR_THUMB_HEIGHT' ) ) {
	define( 'BP_AVATAR_THUMB_HEIGHT', 150 ); //change this with your desired thumb height
}

//bp_loggedin_user_avatar( 'type=full&width=150&height=150' );