<div id="myCarousel" class="carousel slide " data-ride="carousel">

  <!-- Wrapper for slides -->
  <div class="carousel-inner">

      <?php
      if ( is_home() && !is_paged() ) :
          $args = array (
            // display the first sticky post, if none return the last post published
            'posts_per_page'      => 5,
            'post_status' => 'publish',
            'meta_key' => 'meta-checkbox',
            'meta_value' => 'yes'
          );
          $query = new WP_Query( $args );
          $count_slide=0;
          while ($query->have_posts()) : $query->the_post();
            if($count_slide==0){ echo '<div class="item active">'; } else { echo '<div class="item">';  }
            $count_slide++;
            ?>
            <a class="post-thumbnail" aria-hidden="true" href="<?php echo esc_url(get_permalink()); ?>">
          <?php  the_post_thumbnail('fad_slider'); ?>
          </a>

            <div class="carousel-caption">
             <a class="label label-primary" href="<?php echo  esc_url( get_permalink() ); ?>" target="_blank">Featured</a>
              <?php
                the_title( '<h4><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );
                ?>
             <p><?php   the_excerpt(); ?></p>
             <div class="post_details"><span><img src="<?php echo  get_template_directory_uri() .'/images/time.png' ?>" /><?php echo get_the_date(); ?></span><img src="<?php echo  get_template_directory_uri() .'/images/author.png'; ?>"><span>by <?php echo the_author_posts_link(); ?></span>
             </div>
            </div>
            </div><!-- End Item -->
             <?php

             wp_link_pages(
               array(
                 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'fad' ),
                 'after'  => '</div>',
               )
             );
             ?>
            <?php
          endwhile;

        endif;
?>
</div>
