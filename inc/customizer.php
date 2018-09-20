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


	return $wp_customize;
}




function newtheme_customize_reset_control( $wp_customize ) {
	/**
	 * Reset Control
	 */
	class newtheme_Customize_reset_Control extends WP_Customize_Control {

		public $type = 'button';

		public function render_content() {
			?>
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

		</label>
			<?php
		}
	}
}
add_action( 'customize_register', 'newtheme_customize_reset_control', 1, 1 );




/**
 * Customizer partial refresh
 *
 * @param array $wp_customize Customizer options.
 */
function fad_customize_edit_links( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

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
			'selector'        => '.blog-description p',
			'render_callback' => 'fad_customize_partial_blogdescription',
		)
	);

	$wp_customize->selective_refresh->add_partial(
		'fad_header_option',
		array(
			'selector' => '#copyright',
		)
	);
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

function fad_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}
