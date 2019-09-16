<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @version 1.0
 * @package Codename
 */

?>

	</div><!-- #content -->

	<?php do_action( 'codename_before_footer' ); ?>

	<footer id="colophon" class="site-footer">

		<?php do_action( 'codename_footer_menu' ); ?>
		<?php get_template_part( 'template-parts/footer/footer', 'copyright' ); ?>

	</footer><!-- #colophon -->

	<?php do_action( 'codename_after_footer' ); ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
