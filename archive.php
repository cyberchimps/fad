<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package fad
 */

get_header();
?>

<div id="primary" class="content-area">


							<h1 id="post_header_title"><?php the_archive_title(); ?></h1>
<br><br><br>
</div>

              <div class="row">
              	<div class="col-md-8 col-sm-12">


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
	if ( fad_set_page_post_layout() == 'right-sidebar' ) {
		get_sidebar();
	}
	?>
</div>
</div>
<?php

get_footer();
?>
