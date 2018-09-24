<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package fad
 */

get_header();
?>

<div id="primary" class="content-area">



  <main id="main" class="site-main" role="main">
	<div class="container">
	  <div class="row">
			<div class="col-md-12 col-sm-12">

		<?php  get_template_part( 'template-parts/content', 'featured' ); ?>
</div>
<div class="recentposts col-md-12 col-sm-12">	<h2>Recent Posts</h2></div>
<div id="recentpost" class="col-md-8 col-sm-12 col-sm-12">
		<?php
		if ( have_posts() ) :
				$args = array (
	        'meta_key' => 'meta-checkbox',
	        'meta_value' => 'yes'
				);
				$query = new WP_Query( $args );
        $do_not_duplicate =[];
				          while ($query->have_posts()) : $query->the_post();
				            $do_not_duplicate[]= $post->ID;
									endwhile;
				          wp_reset_query();
    if($do_not_duplicate !=0){
				          $args = array (
				              // display the rest of the posts, except for the post shown above (featured)
    				              'posts_per_page' => 9,
                        	'offset' => 0,
                        	'category' => 0,
                        	'orderby' => 'post_date',
                        	'order' => 'DESC',
                        	'include' => '',
                        	'exclude' => '',
                        	'meta_key' => '',
                        	'meta_value' =>'',
                        	'post_type' => 'post',
                        	'post_status' => 'publish',
                        	'suppress_filters' => true,
				              'ignore_sticky_posts' => 1,
				              'post__not_in' => $do_not_duplicate
				          );
                }else{
        // display the rest of the posts, except for the post shown above (featured)
                  $args = array (
                        	'numberposts' => 10,
                        	'offset' => 0,
                        	'category' => 0,
                        	'orderby' => 'post_date',
                        	'order' => 'DESC',
                        	'include' => '',
                        	'exclude' => '',
                        	'meta_key' => '',
                        	'meta_value' =>'',
                        	'post_type' => 'post',
                        	'post_status' => 'publish',
                        	'suppress_filters' => true
                        );

            }
				          $query = new WP_Query( $args );

				          if( $query->have_posts() ) :
										/* Start the Loop */

				            while ($query->have_posts()) :
    											?>
    												<div class="col-md-6 col-sm-6">
                              <div class="imgbox">
                                <a class="post-thumbnail" aria-hidden="true" href="<?php echo esc_url(get_permalink()); ?>">
    											<?php
                        $query->the_post();
    				              if($do_not_duplicate && $post->ID == $do_not_duplicate ) continue;

        								if(has_post_thumbnail()){
                           the_post_thumbnail('fad_archive');
                            $get_cat_ID=get_cat_ID(get_the_category()[0]->name);
                            $get_category_link=get_category_link($get_cat_ID);
                           ?></a>
                              <a class="label label-primary pinkd" href="<?php echo esc_url($get_category_link) ; ?>" target="_blank"><?php echo get_the_category()[0]->name ; ?></a>
                              <?php
                                }
                                ?>
                       				</div>
                              <h3>
            					             <?php

            					               the_title( '<a href="'.esc_url(get_permalink()).'" rel="bookmark">', '</a>' );
            					                 ?>
                                       </h3>
                                       <div class="post_details"><span><img src="<?php echo  get_template_directory_uri().'/images/time_grey.png' ?>" /><?php echo get_the_date(); ?></span><img src="<?php echo  get_template_directory_uri() .'/images/author01.png'; ?>"><span>by <?php echo the_author_posts_link(); ?></span>
                                       </div>
                                        <?php	             the_excerpt();    ?>
                                        </div>
            					             <?php
        											/*
        											 * Include the Post-Type-specific template for the content.
        											 * If you want to override this in a child theme, then include a file
        											 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
        											 */
        											?>
    											<?php
				            endwhile;
				          endif;
				the_posts_navigation();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
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
