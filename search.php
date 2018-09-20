<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package fad
 */

get_header();
?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) :
			get_template_part( 'template-parts/content', 'search' );

		else :

		get_template_part( 'template-parts/content', 'none' );

		endif;

if ( fad_set_page_post_layout() == 'right-sidebar' ) {
 get_sidebar();
}
?>
</div>
</div>
<?php
get_footer();
