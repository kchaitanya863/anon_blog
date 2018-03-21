<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package VMag
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php do_action( 'vmag_before' ); ?>
<div id="page" class="site">
	<?php do_action( 'vmag_before_header' ); ?>
	<div class="vmag-top-header clearfix">
		<div class="vmag-container">
			<?php do_action( 'vmag_header_date' ); ?>
			<nav id="top-site-navigation" class="top-navigation" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'top_menu', 'menu_id' => 'top-menu', 'fallback_cb' => false  ) ); ?>
			</nav><!-- #site-navigation -->
		</div>
	</div><!-- .vmag-top-header -->
	<header id="masthead" class="site-header" role="banner">
		<div class="logo-ad-wrapper clearfix">
			<div class="vmag-container">
				<div class="site-branding">
					
					<?php vmag_the_custom_logo(); ?>

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
				<div class="header-ad-wrapper">
					<?php
			        	if( is_active_sidebar( 'vmag_header_ads_area' ) ) {
			            	if ( !dynamic_sidebar( 'vmag_header_ads_area' ) ):
			            	endif;
			         	}
			        ?>
				</div><!-- .header-ad-wrapper -->
			</div><!-- .vmag-container -->
		</div><!-- .logo-ad-wrapper -->
		<div class="vmag-container">			
			<nav id="site-navigation" class="main-navigation clearfix" role="navigation">
				<div class="nav-wrapper">
					<div class="nav-toggle hide">
		                <span> </span>
		                <span> </span>
		                <span> </span>
		            </div>
					<?php wp_nav_menu( array( 'theme_location' => 'primary_menu', 'menu_id' => 'primary-menu' ) ); ?>
				</div><!-- .nav-wrapper -->
				<div class="icons-wrapper clearfix">
					<?php 
						$vmag_search_icon = get_theme_mod( 'vmag_menu_search_option', 'show' );
						if( $vmag_search_icon != 'hide' ) {
					?>
					<span class="icon-search vmag-search-in-primary"></span>
					<?php } ?>
					<?php do_action( 'vmag_menu_random_icon' ); ?>
				</div><!-- .icons-wrapper -->
				<?php 
					if( $vmag_search_icon != 'hide' ) {
				?>
						<div class="vmag-search-form-primary"><?php get_search_form(); ?></div>
				<?php
					}
				?>
			</nav><!-- #site-navigation -->

		</div><!-- .vmag-container -->
	</header><!-- #masthead -->
	<?php do_action( 'vmag_after_header' ); ?>
	<?php do_action( 'vmag_before_main' ); ?>
	<div id="content" class="site-content">
