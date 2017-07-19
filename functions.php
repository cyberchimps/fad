<?php

require( get_template_directory() . '/admin-about.php' );

add_action( 'after_setup_theme', 'fad_setup' );
function fad_setup()
{
load_theme_textdomain( 'fad', get_template_directory() . '/languages' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
global $content_width;
if ( ! isset( $content_width ) ) $content_width = 640;
register_nav_menus(
array( 'main-menu' => __( 'Main Menu', 'fad' ) , 'top-menu' => __( 'Top Menu', 'fad' ))
);

add_theme_support( 'title-tag' );

}
add_action( 'wp_enqueue_scripts', 'fad_load_scripts' );
function fad_load_scripts()
{
wp_enqueue_script( 'jquery' );
wp_register_script( 'fad-videos', get_template_directory_uri() . '/js/videos.js' );
wp_enqueue_script( 'fad-videos' );
}
add_action( 'wp_head', 'fad_print_custom_scripts', 99 );
function fad_print_custom_scripts()
{
if ( !is_admin() ) {
?>
<script type="text/javascript">
jQuery(document).ready(function($){
$("#wrapper").vids();
});
</script>
<?php
}
}
add_action( 'comment_form_before', 'fad_enqueue_comment_reply_script' );
function fad_enqueue_comment_reply_script()
{
if ( get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}
add_filter( 'the_title', 'fad_title' );
function fad_title( $title ) {
if ( $title == '' ) {
return '&rarr;';
} else {
return $title;
}
}
add_filter( 'wp_title', 'fad_filter_wp_title' );
function fad_filter_wp_title( $title )
{
return $title . esc_attr( get_bloginfo( 'name' ) );
}
add_action( 'widgets_init', 'fad_widgets_init' );
function fad_widgets_init()
{
register_sidebar( array (
'name' => __( 'Sidebar Widget Area', 'fad' ),
'id' => 'primary-widget-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => "</li>",
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
}
function fad_custom_pings( $comment )
{
$GLOBALS['comment'] = $comment;
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
<?php
}
add_filter( 'get_comments_number', 'fad_comments_number' );
function fad_comments_number( $count )
{
if ( !is_admin() ) {
global $id;
$comments_by_type = get_comments( 'status=approve&post_id=' . $id );
return count( $comments_by_type );
} else {
return $count;
}
}

add_action( 'customize_register', 'fad_customizer' );
function fad_customizer( $wp_customize ) {

	$wp_customize->add_section( 'fad_design_section', array(
			'title' => __( 'Colors', 'fad' ),
			'priority' => 35,
	) );

// Background Color

$wp_customize->add_setting( 'fad_background_colorpicker', array(
		'default' => '#225277',
		'type' => 'option',
		'sanitize_callback' => 'fad_text_sanitization'
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'background_colorpicker', array(
		'label' => __( 'Background Color', 'fad' ),
		'section' => 'fad_design_section',
		'settings' => 'fad_background_colorpicker',
) ) );

//Main Menu Text Color
$wp_customize->add_setting( 'fad_main_menu_text_colorpicker', array(
		'default' => '#225277',
		'type' => 'option',
		'sanitize_callback' => 'fad_text_sanitization'
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'main_menu_text_colorpicker', array(
		'label' => __( 'Main Menu Text Color', 'fad' ),
		'section' => 'fad_design_section',
		'settings' => 'fad_main_menu_text_colorpicker',
) ) );

// Top Menu Text Color
$wp_customize->add_setting( 'fad_top_menu_text_colorpicker', array(
		'default' => '#333333',
		'type' => 'option',
		'sanitize_callback' => 'fad_text_sanitization'
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'top_menu_text_colorpicker', array(
		'label' => __( 'Top Menu Text Color', 'fad' ),
		'section' => 'fad_design_section',
		'settings' => 'fad_top_menu_text_colorpicker',
) ) );

$wp_customize->add_section( 'fad_blog_section', array(
		'title' => __( 'Blog Options', 'fad' ),
		'priority' => 36,
) );

$wp_customize->add_setting( 'fad_post_excerpts', array(
		'type' => 'option',
		'sanitize_callback' => 'fad_sanitize_checkbox'
) );
$wp_customize->add_control( 'post_excerpts', array(
		'label' => __( 'Post Excerpts', 'fad' ),
		'section' => 'fad_blog_section',
		'settings' => 'fad_post_excerpts',
		'type' => 'checkbox'
) );


$wp_customize->add_setting( 'fad_options_blog_read_more_text', array(
		'type' => 'option',
		'sanitize_callback' => 'fad_text_sanitization'
) );
$wp_customize->add_control( 'fad_blog_read_more_text', array(
		'label' => __( 'Read More Text', 'fad' ),
		'section' => 'fad_blog_section',
		'default' => __( 'Read More...', 'fad' ),
		'settings' => 'fad_options_blog_read_more_text',
		'type' => 'text'
) );

//Post Excerpts Length
$wp_customize->add_setting( 'fad_options_blog_excerpt_length', array(
		'type' => 'option',
		'sanitize_callback' => 'fad_text_sanitization'
) );
$wp_customize->add_control( 'fad_blog_excerpt_length', array(
		'label' => __( 'Excerpt Length', 'fad' ),
		'section' => 'fad_blog_section',
		'default' => 55,
		'settings' => 'fad_options_blog_excerpt_length',
		'type' => 'text'
) );

}

function fad_text_sanitization( $text ) {
	return sanitize_text_field( $text );
}

function fad_sanitize_checkbox( $input ) {
	if( $input ) {
		$output = '1';
	}
	else {
		$output = false;
	}

	return $output;
}

add_action( 'wp_head', 'fad_css_styles', 50 );
function fad_css_styles(){
	$main_menu_color = get_option('fad_main_menu_text_colorpicker');
	$top_menu_color = get_option('fad_top_menu_text_colorpicker');
	$background_color = get_option('fad_background_colorpicker');
	?>

	<style type="text/css" media="all">
	<?php if ( !empty( $main_menu_color ) ) : ?>
				#menu ul li a {
				color:<?php echo $main_menu_color; ?>;
				}
	<?php endif; ?>

	<?php if ( !empty( $top_menu_color ) ) : ?>
				.top-menu li a {
				color:<?php echo $top_menu_color; ?>;
				}
	<?php endif; ?>

	<?php if ( !empty( $background_color ) ) : ?>
				body {
				background:<?php echo $background_color; ?>;
				}
	<?php endif; ?>

	</style>
	<?php
}

function fad_excerpt_more( $more ) {

	$read_more_text = get_option( 'fad_options_blog_read_more_text');
	if($read_more_text != ''){
	global $post;
	return '<p><a href="' . esc_url(get_permalink( $post->ID )) . '">' . $read_more_text . '</a></p>';
	}else{
		return $more;
	}
}
add_filter( 'excerpt_more', 'fad_excerpt_more' );

function fad_custom_excerpt_length( $length ) {
	$read_more_length = get_option( 'fad_options_blog_excerpt_length');

	if($read_more_length != ''){
	return $read_more_length;
	}else{
		return $length;
	}
}
add_filter( 'excerpt_length', 'fad_custom_excerpt_length', 999 );
add_action( 'admin_notices', 'my_admin_notice' );
function my_admin_notice(){
	global $fad_check_screen;
	$fad_check_screen = get_admin_page_title();

   if ( $fad_check_screen == 'Manage Themes' )
{
          echo '<div class="notice notice-info is-dismissible"><p class="fad-upgrade-callout" style="font-size:18px; "><a href="https://cyberchimps.com/free-download-50-stock-images-use-please/?utm_source=Fad" target="_blank" style="text-decoration:none;">FREE - Download CyberChimps\' Pack of 50 High-Resolution Stock Images Now</a></p></div>';
}
}

function fad_customize_edit_links( $wp_customize ) {


   $wp_customize->selective_refresh->add_partial( 'blogname', array(
'selector' => '#site-title h1'
) );

	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '#site-description'
	) );

}
add_action( 'customize_register', 'fad_customize_edit_links' );
add_theme_support( 'customize-selective-refresh-widgets' );

add_action( 'admin_notices', 'fad_admin_notice' );
function fad_admin_notice(){

	$admin_check_screen = get_admin_page_title();

	if( !class_exists('SlideDeckPlugin') )
	{
	$plugin='slidedeck/slidedeck.php';
	$slug = 'slidedeck';
	$installed_plugins = get_plugins();
	
	 if ( $admin_check_screen == 'Manage Themes' )
	{
		?>
		<div class="notice notice-info is-dismissible" style="margin-top:15px;">
		<p>
		<?php if( isset( $installed_plugins[$plugin] ) )
		{
		?>
			 <a href="<?php echo admin_url( 'plugins.php' ); ?>">Activate the SlideDeck Lite plugin</a>
		 <?php
		}
		else
		{
		 ?>
		 <a href="<?php echo wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=' . $slug ), 'install-plugin_' . $slug ); ?>">Install the SlideDeck Lite plugin</a>
		 <?php } ?>
		</p>
		</div>
		<?php
	}
	}

	if( !class_exists('WPForms') )
	{
	$plugin   = 'wpforms-lite/wpforms.php';
	$slug = 'wpforms-lite';
	$installed_plugins = get_plugins();
	
	 if ( $admin_check_screen == 'Manage Themes' )
	{
		?>
		<div class="notice notice-info is-dismissible" style="margin-top:15px;">
		<p>
		<?php if( isset( $installed_plugins[$plugin] ) )
		{
		?>
			 <a href="<?php echo admin_url( 'plugins.php' ); ?>">Activate the WPForms Lite plugin</a>
		 <?php
		}
		else
		{
		 ?>	 
 		 <a href="<?php echo wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=' . $slug ), 'install-plugin_' . $slug ); ?>">Install the WP Forms Lite plugin</a>
		 <?php } ?>
		</p>
		</div>
		<?php
	}
	}

	if ( $admin_check_screen == 'Manage Themes' )
	{
	?>
		<div class="notice notice-success is-dismissible">
				<b><p>Liked this theme? <a href="https://wordpress.org/support/theme/fad/reviews/#new-post" target="_blank">Leave us</a> a ***** rating. Thank you! </p></b>
		</div>
		<?php
	}

}
