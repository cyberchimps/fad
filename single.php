<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package fad
 */

get_header();
?>

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-12">
		<div class=" postlisting">


			<?php
			while ( have_posts() ) :
				the_post();


							the_title( '<h3>', '</h3>' );

						if ( 'post' === get_post_type() ) :
							?>

							<div class="post_details"><span><img src="<?php echo  get_template_directory_uri() .'/images/time_grey.png' ?>" /><?php echo get_the_date(); ?></span><img src="<?php echo  get_template_directory_uri() .'/images/author01.png'; ?>"><span>by <?php echo the_author_posts_link(); ?></span>
							</div>

						<?php endif; ?>

					<?php fad_post_thumbnail(); ?>

					<p>
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
				</p><!-- .entry-content -->



				<div class="navigation">
					<div class="row">
						<div class="col-xs-6 col-md-6 ht-prev-post">
							<?php
							$single_prev_post = get_previous_post();

							if ( ! empty( $single_prev_post ) ) {
								?>
										<?php previous_post_link( '%link', 'Previous' ); ?>
								<?php
							}
							?>
						</div>
					<div class="col-xs-6 col-md-6 ht-next-post">
					<?php
					$single_next_post = get_next_post();

					if ( ! empty( $single_next_post ) ) {
						?>
								<?php next_post_link( '%link', 'Next' ); ?>
						<?php
					}
					?>
					</div>
				</div>
			</div>
		</div>
				<?php
				if ( fad_set_page_post_layout() === 'left-sidebar' ) {
					get_sidebar();
				}

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
			  endif;

			endwhile; // End of the loop.
			?>
			</div>
			<?php
			if ( fad_set_page_post_layout() == 'right-sidebar' ) {
				get_sidebar();
			}
			?>
			</div> <!-- .row -->
		</div><!-- .container -->
	</main><!-- #main -->
</div><!-- #primary -->

<?php

get_footer();
