<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package fad
 */

?>

				<h1 class="page-title">
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', 'fad' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>

				               <div class="row">
				               	<div class="col-md-8 col-sm-12">
<br><br><br>

				                         <?php
				                         while ( have_posts() ) :
				                           the_post();
				                           ?>
				                           <div class=" postlisting">
				                             <div class="row">
				                             <div class="col-md-6">
				                             <?php

				                                 the_title( '<h3 class="marginnone">', '</h3>' );

				                               if ( 'post' === get_post_type() ) :
				                                 ?>

				                                 <div class="post_details"><span><img src="<?php echo  get_template_directory_uri() .'/images/time_grey.png' ?>" /><?php echo get_the_date(); ?></span><img src="<?php echo  get_template_directory_uri() .'/images/author01.png'; ?>"><span>by <?php echo the_author_posts_link(); ?></span>
				                                 </div>
				                               <?php    the_excerpt(); ?>
				 		                  </div>
				                       <div class="col-md-6">
																 <a class="post-thumbnail" aria-hidden="true" href="<?php echo esc_url(get_permalink()); ?>">
																 <?php	if(has_post_thumbnail()) the_post_thumbnail('fad_archive');?>
															 </a>
															 </div>

				                     </div>
				                     </div>
				                 <?php endif;
				               endwhile;
				                  ?>
				                </div>


				 <?php


			the_posts_navigation();
