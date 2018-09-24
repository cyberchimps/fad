<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package fad
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="container">
			<div class="row">

		<div id="sidebar_footer" class=" col-md-12 col-sm-12">

		<?php dynamic_sidebar( 'footer-widget' ); ?>


		</div><!-- #footer -->
		<div class="fad-footer-image">
			<?php $fad_footer_image = get_theme_mod( 'fad_footer_image' ); ?>
			<?php
			if ( ! empty( $fad_footer_image ) ) {
				?>
				<img src="<?php echo esc_attr( $fad_footer_image ); ?>" alt="<?php esc_attr_e( 'footer image', 'fad' ); ?>" />
				<?php
			}
			?>
		</div>
		<div class="cc-credit-text col-md-6">
			<?php $footer_copyright_text = get_theme_mod( 'footer_copyright_text' ); ?>
				<?php
				if ( ! empty( $footer_copyright_text ) ) {
					?>
						<span>
						<?php
						echo $footer_copyright_text;
				} else {
					?>
						<a target="_blank" href="<?php echo esc_url( __( 'https://cyberChimps.com/', 'fad' ) ); ?>">
						<?php
						/* translators: %s: CMS name, i.e. WordPress. */
						printf( esc_html__( ' %s WordPress Themes', 'fad' ), 'CyberChimps' );
						?>
						</a>

					</div>
						<div class="sep  col-md-6">
							<?php
							/* translators: 1: Theme name, 2: Theme author. */
							printf( esc_html__( '@ %1$s %2$s', 'fad' ), 'Fad', 'Free Theme' );
							?>
						</div>
								<?php
				}


				?>

		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
