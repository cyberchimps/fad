<?php
/**
 * Fad Theme Customizer
 *
 * @package Fad
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function fad_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'fad_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'fad_customize_partial_blogdescription',
			)
		);
	}

	$wp_customize->add_section(
		'fad_demo_section',
		array(
			'title'    => __( 'Header Search Option', 'fad' ),
			'priority' => 60,
		)
	);

	$wp_customize->add_setting(
		'fad_header_search',
		array(
			'default'           => 1,
			'sanitize_callback' => 'fad_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'fad_header_search',
		array(
			'label'    => __( 'Hide Header Search', 'fad' ),
			'section'  => 'fad_demo_section',
			'settings' => 'fad_header_search',
			'type'     => 'checkbox',
		)
	);

	// Main Menu Text Color.
	$wp_customize->add_setting(
		'fad_main_menu_text_colorpicker',
		array(
			'default'           => '#225277',
			'type'              => 'option',
			'sanitize_callback' => 'fad_text_sanitization',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'main_menu_text_colorpicker',
			array(
				'label'    => __( 'Main Menu Text Color', 'fad' ),
				'section'  => 'colors',
				'settings' => 'fad_main_menu_text_colorpicker',
			)
		)
	);

	// Top Menu Text Color.
	$wp_customize->add_setting(
		'fad_top_menu_text_colorpicker',
		array(
			'default'           => '#333333',
			'type'              => 'option',
			'sanitize_callback' => 'fad_text_sanitization',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'top_menu_text_colorpicker',
			array(
				'label'    => __( 'Top Menu Text Color', 'fad' ),
				'section'  => 'colors',
				'settings' => 'fad_top_menu_text_colorpicker',
			)
		)
	);

	$wp_customize->add_section(
		'fad_blog_section',
		array(
			'title'    => __( 'Blog Options', 'fad' ),
			'priority' => 36,
		)
	);

	$wp_customize->add_setting(
		'fad_post_excerpts',
		array(
			'type'              => 'option',
			'sanitize_callback' => 'fad_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'post_excerpts',
		array(
			'label'    => __( 'Post Excerpts', 'fad' ),
			'section'  => 'fad_blog_section',
			'settings' => 'fad_post_excerpts',
			'type'     => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'fad_options_blog_read_more_text',
		array(
			'type'              => 'option',
			'sanitize_callback' => 'fad_text_sanitization',
		)
	);
	$wp_customize->add_control(
		'fad_blog_read_more_text',
		array(
			'label'    => __( 'Read More Text', 'fad' ),
			'section'  => 'fad_blog_section',
			'default'  => __( 'Read More...', 'fad' ),
			'settings' => 'fad_options_blog_read_more_text',
			'type'     => 'text',
		)
	);

	// Post Excerpts Length.
	$wp_customize->add_setting(
		'fad_options_blog_excerpt_length',
		array(
			'type'              => 'option',
			'sanitize_callback' => 'fad_text_sanitization',
		)
	);

	$wp_customize->add_control(
		'fad_blog_excerpt_length',
		array(
			'label'    => __( 'Excerpt Length', 'fad' ),
			'section'  => 'fad_blog_section',
			'default'  => 55,
			'settings' => 'fad_options_blog_excerpt_length',
			'type'     => 'text',
		)
	);

	return $wp_customize;
}
add_action( 'customize_register', 'fad_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function fad_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function fad_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function fad_customize_preview_js() {
	wp_enqueue_script( 'fad-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'fad_customize_preview_js' );

/**
 * [fad_text_sanitization description]
 *
 * @param string $text [description].
 * @return string       [description].
 */
function fad_text_sanitization( $text ) {
			return sanitize_text_field( $text );
}

/**
 * [fad_sanitize_checkbox description]
 *
 * @param  [type] $input [description].
 * @return bool        [description]
 */
function fad_sanitize_checkbox( $input ) {
	if ( $input ) {
		$output = '1';
	}
	else {
		$output = false;
	}

	return $output;
}
