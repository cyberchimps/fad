<?php
/**
 * The front-page template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Fad
 */

get_header();
?>
<div id="content" class="site-content">
			<?php
			if ( have_posts() ) :


					get_template_part( 'template-parts/content', 'slider' );

			endif;
			?>
		<div class="container">
			<div class="row">
				<div  id="recentpost" class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
					<div id="primary" class="content-area">
						<main id="main" class="site-main">
				<h2><?php esc_html_e( 'Recent Posts', 'fad' ); ?></h2>
				<div class="row">
				<?php
				$args  = array(
					'numberposts'      => 10,
					'offset'           => 0,
					'category'         => 0,
					'orderby'          => 'post_date',
					'order'            => 'DESC',
					'post_type'        => 'post',
					'post_status'      => 'publish',
					'suppress_filters' => true,
				);
				$query = new WP_Query( $args );

				if ( $query->have_posts() ) :
					/* Start the Loop */
					while ( $query->have_posts() ) :
						$query->the_post();
						?>
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<?php if ( has_post_thumbnail() ) { ?>

							<div class="imgbox">
								<?php
								fad_post_thumbnail();
								$get_cat_name      = get_the_category()[0]->name;
								$get_cat_id        = get_cat_ID( $get_cat_name );
								$get_category_link = get_category_link( $get_cat_id );
								?>
							<a class="label label-primary" href="<?php echo esc_url( $get_category_link ); ?>" target="_blank"><?php echo esc_html( $get_cat_name ); ?></a>
							</div>
						<?php } ?>
							<h2 class="entry-title">
								<?php the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a>' ); ?>
							</h2>
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
								<?php the_excerpt(); ?>

						</div>
						<?php
					endwhile;
				endif;
				?>
			</div><!-- .col -->
		</div>

								</main><!-- #main -->
							</div><!-- #primary -->
		<?php get_sidebar(); ?>
	</div><!-- .row -->
</div><!-- .container -->

</div><!-- #content -->

<?php
get_footer();
