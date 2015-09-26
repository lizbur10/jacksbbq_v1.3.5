<?php

/* ======================================================================

	Logo Uploader v1.0
	Add a custom logo to your WordPress site.

	Functions by Scott Bolinger.
	http://scottbolinger.com/add-a-custom-logo-uploader-to-the-wordpress-theme-customizer/

	Forked by Chris Ferdinandi.
	http://gomakethings.com

	Uses the WP Theme Customizer API
	https://codex.wordpress.org/Theme_Customization_API

 * ====================================================================== */

// Add section to upload logos
function kraken_add_upload_logo( $wp_customize ) {
	$wp_customize->add_section(
		'kraken_upload_logos' ,
		array(
		    'title' => __( 'Logos', 'kraken' ),
		    'priority' => 30,
		)
	);
}
add_action( 'customize_register', 'kraken_add_upload_logo' );

// Add header logo uploader
function kraken_upload_logo_header( $wp_customize ) {
	$wp_customize->add_setting( 'kraken_logo_header' );
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'kraken_logo_header',
			array(
				'label' => __( 'Header Logo', 'kraken' ),
				'section' => 'kraken_upload_logos',
				'settings' => 'kraken_logo_header',
			)
		)
	);
}
add_action( 'customize_register', 'kraken_upload_logo_header' );

// Add footer logo uploader
function kraken_upload_logo_footer( $wp_customize ) {
	$wp_customize->add_setting( 'kraken_logo_footer' );
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'kraken_logo_footer',
			array(
				'label' => __( 'Footer Logo', 'kraken' ),
				'section' => 'kraken_upload_logos',
				'settings' => 'kraken_logo_footer',
			)
		)
	);
}
add_action( 'customize_register', 'kraken_upload_logo_footer' );

// Add landing page image uploader
function kraken_upload_landing_page_image( $wp_customize ) {
	$wp_customize->add_setting( 'kraken_landing_image' );
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'kraken_landing_image',
			array(
				'label' => __( 'Landing Page Image', 'kraken' ),
				'section' => 'kraken_upload_logos',
				'settings' => 'kraken_landing_image',
			)
		)
	);
}
add_action( 'customize_register', 'kraken_upload_landing_page_image' );

// Add events image uploader
function kraken_upload_events_image( $wp_customize ) {
	$wp_customize->add_setting( 'kraken_events_image' );
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'kraken_events_image',
			array(
				'label' => __( 'Events Image', 'kraken' ),
				'section' => 'kraken_upload_logos',
				'settings' => 'kraken_events_image',
			)
		)
	);
}
add_action( 'customize_register', 'kraken_upload_events_image' );

// Add menu image uploader
function kraken_upload_menu_image( $wp_customize ) {
	$wp_customize->add_setting( 'kraken_menu_image' );
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'kraken_menu_image',
			array(
				'label' => __( 'Menu Image', 'kraken' ),
				'section' => 'kraken_upload_logos',
				'settings' => 'kraken_menu_image',
			)
		)
	);
}
add_action( 'customize_register', 'kraken_upload_menu_image' );

// Add jack's Message Image
function kraken_upload_jack_image( $wp_customize ) {
	$wp_customize->add_setting( 'kraken_jack_image' );
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'kraken_jack_image',
			array(
				'label' => __( 'Message from Jack Image', 'kraken' ),
				'section' => 'kraken_upload_logos',
				'settings' => 'kraken_jack_image',
			)
		)
	);
}
add_action( 'customize_register', 'kraken_upload_jack_image' );

?>