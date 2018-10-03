<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Fad
 */

get_header();
?>
<div id="content" class="site-content">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
				<div id="primary" class="content-area">
					<main id="main" class="site-main">

					<?php
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/content', get_post_type() );

						the_post_navigation();
						?>
						<div class="authorbio">
							<h2><?php esc_html_e( 'About the Author', 'fad' ); ?></h2>
							<div class="row authorbio_content">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
								<div class="authorimg"><?php echo get_avatar( get_the_author_meta( 'ID' ), 120 ); ?></div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
								<div class="author_deatils"><div class="authorname"><?php the_author(); ?> </div>
								<span></span>
								<p><?php the_author_meta( 'description' ); ?></p>
								</div>
								</div>
							</div>
						</div>

							<?php
							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								?>
								<h2 class="comment_count">
									<?php
									echo esc_html( get_comments_number() );
									esc_html_e( ' Comments', 'fad' );
									?>
								</h2>
								<?php
								comments_template();
						endif;

					endwhile; // End of the loop.
					?>

					</main><!-- #main -->
				</div><!-- #primary -->
			</div><!-- .col -->
			<?php get_sidebar(); ?>
		</div><!-- .row -->
	</div><!-- .container -->
</div><!-- #content -->

<?php
get_footer();
