<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package AccessPress Themes
 * @subpackage AccessBuddy
 * @since 1.0.0
 */

	if( !is_front_page() ) {
		echo '</div><!-- .ab-container -->';
	}
?>

	</div><!-- #content -->
	<?php
		/**
		 * Footer widget area with sub footer
		 *
		 * @hooked 
		 *
		 * @since 1.0.0
		 *
		 */
		do_action( 'accessbuddy_footer' );
	?>
	
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
