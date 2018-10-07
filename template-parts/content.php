<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Fad
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	if ( is_singular() ) :
		?>
		<header class="entry-header">
			<?php
				the_title( '<h1 class="entry-title">', '</h1>' );
			if ( 'post' === get_post_type() ) :
				?>
				<div class="entry-meta">
					<div class="post_details">
						<span>
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/time_grey.png' ); ?>" />
							<?php fad_posted_on(); ?>
						</span>
						<span>
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/author01.png' ); ?>">
							<?php fad_posted_by(); ?>
						</span>
					</div>
				</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->
		<?php
		fad_post_thumbnail();
		?>

		<div class="entry-content">
			<?php
			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'fad' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'fad' ),
					'after'  => '</div>',
				)
			);

			?>
			</div><!-- .entry-content -->
				<footer class="entry-footer">
					<?php fad_entry_footer(); ?>
				</footer><!-- .entry-footer -->
			<?php
	else :
		?>

	<div class="entry-content">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<header class="entry-header">
					<?php
						the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

					if ( 'post' === get_post_type() ) :
						?>
						<div class="entry-meta">
							<div class="post_details">
								<span>
									<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/time_grey.png' ); ?>" />
									<?php fad_posted_on(); ?>
								</span>
								<span>
								<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/author01.png' ); ?>">
									<?php fad_posted_by(); ?>
								</span>
							</div>
						</div><!-- .entry-meta -->
					<?php endif; ?>
				</header><!-- .entry-header -->

					<?php the_excerpt(); ?>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<?php fad_post_thumbnail(); ?>
				</div>
			</div>
		</div><!-- .entry-content -->
		<?php
	endif;
	?>
</article><!-- #post-<?php the_ID(); ?> -->
