<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package fad
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>


<div id="secondary" class="col-md-4 col-sm-12">


	<div id="sidebar" class="widget-area">

	<?php dynamic_sidebar( 'sidebar-1' ); ?>


	</div><!-- #sidebar -->


</div><!-- #secondary -->
