<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package fad
 */

get_header();
?>

  <main id="main" class="site-main" role="main">
	<div class="container">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'fad' ); ?></h1>
				</header><!-- .page-header -->


					<div class="row">
						<div class="col-md-8">

							<div class="col-md-12">

					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'fad' ); ?></p>
</div>
<div class="col-md-12">

		<?php
		get_search_form();

		the_widget( 'WP_Widget_Recent_Posts' );
		?>
</div>
<div class="col-md-12">

					<div class="widget widget_categories">
						<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'fad' ); ?></h2>
						<ul>
									<?php
									wp_list_categories(
									array(
										'orderby'    => 'count',
										'order'      => 'DESC',
										'show_count' => 1,
										'title_li'   => '',
										'number'     => 10,
									)
									);
									?>
						</ul>
					</div><!-- .widget -->
				</div><!-- .widget -->

<div class="col-md-12">

				<?php
				/* translators: %1$s: smiley */
				$fad_archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'fad' ), convert_smilies( ':)' ) ) . '</p>';
				the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$fad_archive_content" );

				the_widget( 'WP_Widget_Tag_Cloud' );
				?>
			</div>
		</div>

		<?php

		if ( fad_set_page_post_layout() == 'right-sidebar' ) {
		 get_sidebar();
		}
		?>

					</div>
				</div>
			</div>

				  </main><!-- #main -->


<?php
get_footer();
