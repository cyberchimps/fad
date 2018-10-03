<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Fad
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="container">
			<div class="row">
				<div id="sidebar_footer" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<?php dynamic_sidebar( 'footer-widget' ); ?>
				</div>

					<div class="site-info col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 text-left cc-credit-text">
						<a href="<?php echo esc_url( __( 'https://cyberchimps.com', 'fad' ) ); ?>">
							<?php
							/* translators: %s: CMS name, i.e. WordPress. */
							printf( '%s WordPress Themes', 'CyberChimps' );
							?>
						</a>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 text-right sep">
							<a href="<?php echo esc_url( __( 'https://cyberchimps.com/fad', 'fad' ) ); ?>">
							<?php
							/* translators: 1: Theme name, 2: Theme author. */
							printf( '%1$s ', '@ Fad Free Theme' );
							?>
							</a>
						</div>
					</div>
					</div><!-- .site-info -->
				</div>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
