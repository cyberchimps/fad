<?php if( is_home() ) :// blog post pages ?>
  		<?php if( get_option( 'fad_post_excerpts') != 0 ): ?>
  			<section class="entry-content">
			<?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>
        			<?php the_excerpt(); ?>
				<div class="entry-links"><?php wp_link_pages(); ?></div>
      			</section>
    <?php else: ?>
		    	<section class="entry-content">
				<?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>
				<?php the_content( __( 'Continue reading', 'fad' ) . '<span class="meta-nav">&rarr;</span>' ); ?>
				<div class="entry-links"><?php wp_link_pages(); ?></div>
			</section>
    <?php endif; ?>
	
	<?php else: ?>
		<section class="entry-content">
			<?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>
			<?php the_content(); ?>
			<div class="entry-links"><?php wp_link_pages(); ?></div>
		</section>
		
	<?php endif; ?>
