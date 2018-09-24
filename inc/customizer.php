<?php
/**
 * fad Theme Customizer
 *
 * @package fad
 */

add_action( 'customize_register', 'fad_customize' );
function fad_customize( $wp_customize ) {

	/**
	 * Class Cyberchimps_Form
	 *
	 * Creates a form input type with the option to add description and placeholders
	 */
	class Cyberchimps_Form extends WP_Customize_Control {

		public function render_content() {
			switch ( $this->type ) {
				case 'textarea':
					?>
					<label>
						<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
						<textarea value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> style="width: 97%; height: 200px;"></textarea>
					</label>
					<?php
					break;
			}
		}
	}

	/*
	 --------------------------------------------------------------
	// Header SECTION
	-------------------------------------------------------------- */

	$wp_customize->add_section(
		  'fad_demo_section', array(
			'title'    => __( 'Header Option', 'fad' ),
			'priority' => 60,
		)
	);

		$wp_customize->add_setting(
			  'fad_header_search', array(
				'default' => 1,
				'sanitize_callback' => 'fad_sanitize_checkbox',
			)
		);

		$wp_customize->add_control( 'fad_header_search', array(
					'label' => __( 'Show Hide Header Search', 'fad' ),
					'section' => 'fad_demo_section',
					'settings' => 'fad_header_search',
					'type' => 'checkbox',
				)
		);

	$wp_customize->add_setting(
		  'fad_title_toggle_logo', array(
			'default' => 1,
			'sanitize_callback' => 'fad_sanitize_checkbox',
		)
	);

	$wp_customize->add_control( 'fad_title_toggle_logo', array(
				'label' => __( 'disable site title and description', 'fad' ),
				'section' => 'title_tagline',
				'settings' => 'fad_title_toggle_logo',
				'type' => 'checkbox',
			)
	);


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


	return $wp_customize;
}


/**
 * Customizer partial refresh - blogname
 */
function fad_customize_partial_blogname() {
	 bloginfo( 'name' );
}

/**
 * Customizer partial refresh - blog-description
 */
function fad_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

add_action( 'customize_register', 'fad_customize_edit_links' );
