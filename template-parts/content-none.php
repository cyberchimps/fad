<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package fad
 */

?>

		<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'fad' ); ?></h1>

			<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-12">
				<br><br><br>

		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :

			printf(
				'<p>' . wp_kses(
					/* translators: 1: link to WP admin new post page. */
					__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'fad' ),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);

		elseif ( is_search() ) :
			?>
			<div class="col-md-12 col-lg-12 col-sm-12">

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'fad' ); ?></p>
		</div>

			<div class="col-md-12 col-lg-12 col-sm-12">
				<br><br>				<br><br>


			<?php
			get_search_form();

		else :
			?>
		</div>

			<div class="col-md-12 col-lg-12 col-sm-12">

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'fad' ); ?></p>
		</div>

			<div class="col-md-12 col-lg-12 col-sm-12">
				<br><br>
				<br><br>

			<?php
			get_search_form();

		endif;
		?>
	</div>
</div>
