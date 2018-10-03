<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Fad
 */

?>
<div class="container">
	<div id="myCarousel" class="carousel slide " data-ride="carousel">
		<!-- Wrapper for slides -->
		<div class="carousel-inner">
			<?php
			$the_query = new WP_Query(
				array(
					'tag'         => 'slider',
					'post_status' => 'publish',
				)
			);
			if ( $the_query->have_posts() ) :
				/* Start the Loop */
				$count_slide = 0;
				while ( $the_query->have_posts() ) :
					$the_query->the_post();
					// Look for the tag.
					if ( $count_slide == 0 ) {
						echo '<div class="carousel-item active">';
					}
					else {
						echo '<div class="carousel-item">';
					}
					$count_slide++;
					?>

						<?php
						fad_post_thumbnail();
						$get_cat_name      = get_the_category()[0]->name;
						$get_cat_id        = get_cat_ID( $get_cat_name );
						$get_category_link = get_category_link( $get_cat_id );
						?>


						<div class="carousel-caption">
						<a class="label label-primary" href="<?php echo esc_url( $get_category_link ); ?>" target="_blank"><?php echo esc_html( $get_cat_name ); ?></a>
						<?php
						the_title( '<h4><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );
						?>
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
						</div>
						</div><!-- End Item -->
						<?php

				endwhile;
			endif;
			?>
		</div><!--  -->
	</div><!--		-->
</div>
