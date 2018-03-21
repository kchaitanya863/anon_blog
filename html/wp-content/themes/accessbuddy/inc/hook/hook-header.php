<?php
/**
 * Hook define about header part
 *
 * @package AccessPress Themes
 * @subpackage AccessBuddy
 * @since 1.0.0
 */

/*------------------------------------------------------------------------------------------------------------------*/
/**
 * Top header before
 */
if( ! function_exists( 'accessbuddy_top_header_before' ) ):
	function accessbuddy_top_header_before() {
		echo '<div class="ab-top-header clearfix"> <div class="ab-container">';
	}
endif;

/**
 * Top header current date
 */
if( ! function_exists( 'accessbuddy_current_date' ) ):
	function accessbuddy_current_date(){
		$ab_date_option = get_theme_mod( 'ab_top_current_date', 'show' );
		if( $ab_date_option !='hide' ) {
			echo '<div class="ab-date-now">'.date_i18n( 'l, F j, Y' ).'</div>';
		}
	}
endif;

/**
 * Top header nav section
 */
if( ! function_exists( 'accessbuddy_top_nav' ) ):
	function accessbuddy_top_nav(){
?>
		<nav id="top-site-navigation" class="top-navigation" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'accessbuddy_top_menu', 'menu_id' => 'top-menu', 'fallback_cb' => false  ) ); ?>
		</nav><!-- #site-navigation -->
<?php
	}
endif;

/**
 * Top header after
 */
if( ! function_exists( 'accessbuddy_top_header_after' ) ):
	function accessbuddy_top_header_after() {
		echo '</div><!-- .ab-top-header --></div><!-- .ab-container -->';
	}
endif;

add_action( 'accessbuddy_top_header', 'accessbuddy_top_header_before', 5 );
add_action( 'accessbuddy_top_header', 'accessbuddy_current_date', 10 );
add_action( 'accessbuddy_top_header', 'accessbuddy_top_nav', 15 );
add_action( 'accessbuddy_top_header', 'accessbuddy_top_header_after', 20 );

/*-----------------------------------------------------------------------------------------------------------------*/
/**
 * Header before
 */
if( ! function_exists( 'accessbuddy_main_header_before' ) ):
	function accessbuddy_main_header_before() {

?>
		<header id="masthead" class="site-header" role="banner">
			<div class="ab-container">
<?php
	}
endif;

/**
 * Before Site logo and ads
 */
if( ! function_exists( 'accessbuddy_site_logo_ads_before' ) ):
	function accessbuddy_site_logo_ads_before() {
		echo '<div class="logo-ad-wrapper clearfix">';
	}
endif;

/**
 * AccessBuddy Site logo
 */
if( ! function_exists( 'accessbuddy_site_logo' ) ):
	function accessbuddy_site_logo() {
?>
		<div class="site-branding">
			<?php
				if ( function_exists( 'the_custom_logo' ) ) {
					the_custom_logo();
				}
			?>

			<div class="site-title-wrapper">
				<?php
				if ( is_front_page() && is_home() ) : ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php else : ?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
				endif;

				$description = get_bloginfo( 'description', 'display' );
				if ( $description || is_customize_preview() ) : ?>
					<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
				<?php
				endif; ?>
			</div>
		</div><!-- .site-branding -->
<?php
	}
endif;

/**
 * AccessBuddy header ads
 */
if( ! function_exists( 'accessbuddy_header_ads' ) ):
	function accessbuddy_header_ads() {
?>
		<div class="header-ad-wrapper">
			<?php
	        	if( is_active_sidebar( 'accessbuddy_header_ads_area' ) ) {
	            	if ( !dynamic_sidebar( 'accessbuddy_header_ads_area' ) ):
	            	endif;
	         	}
	        ?>
		</div><!-- .header-ad-wrapper -->
<?php
	}
endif;

/**
 * After Site logo and ads
 */
if( ! function_exists( 'accessbuddy_site_logo_ads_after' ) ):
	function accessbuddy_site_logo_ads_after() {
		echo '</div><!-- .logo-ad-wrapper -->';
	}
endif;

/**
 * After Header
 */
if( ! function_exists( 'accessbuddy_main_header_after' ) ):
	function accessbuddy_main_header_after() {
?>
			</div><!-- .ab-container -->
		</header><!-- #masthead -->
<?php
	}
endif;

/**
 * AccessBuddy Primary menu 
 */
if( ! function_exists( 'accessbuddy_primary_menu' ) ):
	function accessbuddy_primary_menu() {
?>
		<div class="ab-primary-menu-wrapper clearfix">
			<div class="ab-container">
				<div class="ab-menu-toggle"><i class="fa fa-navicon"></i></div>
				<nav id="site-navigation" class="main-navigation ab-primary-menu" role="navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'accessbuddy_primary_menu', 'menu_id' => 'primary-menu' ) ); ?>
				</nav><!-- #site-navigation -->
				<div class="ab-user-holder">
					<?php accessbuddy_notifications_menu(); ?>
					<?php accessbuddy_user_profile_link(); ?>
				</div><!-- .ab-user-holder -->
			</div><!-- .ab-container -->
		</div><!-- .ab-primary-menu-wrapper -->		
<?php
	}
endif;

add_action( 'accessbuddy_main_header', 'accessbuddy_main_header_before', 5 );
add_action( 'accessbuddy_main_header', 'accessbuddy_site_logo_ads_before', 10 );
add_action( 'accessbuddy_main_header', 'accessbuddy_site_logo', 15 );
add_action( 'accessbuddy_main_header', 'accessbuddy_header_ads', 20 );
add_action( 'accessbuddy_main_header', 'accessbuddy_main_header_after', 25 );
add_action( 'accessbuddy_main_header', 'accessbuddy_site_logo_ads_after', 30 );
add_action( 'accessbuddy_main_header', 'accessbuddy_primary_menu', 35 );