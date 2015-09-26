<?php

/* ======================================================================

	Theme Options v1.1
	Adjust theme settings from the admin dashboard.
	Find and replace `kraken` with your own namespacing.

	Functions by Michael Fields.
	https://gist.github.com/mfields/4678999

	Forked by Chris Ferdinandi.
	http://gomakethings.com

	Free to use under the MIT License.
	http://gomakethings.com/mit/

 * ====================================================================== */


/* ======================================================================
	THEME OPTION FIELDS
	Create the theme option fields.

	Each option field requires its own uniquely named function.
	Select options and radio buttons also require an additional
	uniquely named function with an array of option choices.
 * ====================================================================== */

// General Settings
function kraken_settings_field_url_facebook() {
	$options = kraken_get_theme_options();
	?>
	<input type="text" name="kraken_theme_options[url_facebook]" class="large-text" id="url-facebook" value="<?php echo esc_url( $options['url_facebook'] ); ?>" />
	<label class="description" for="url-facebook"><?php _e( 'URL for the company Facebook account', 'kraken' ); ?></label>
	<?php
}

function kraken_settings_field_url_twitter() {
	$options = kraken_get_theme_options();
	?>
	<input type="text" name="kraken_theme_options[url_twitter]" class="large-text" id="url-twitter" value="<?php echo esc_url( $options['url_twitter'] ); ?>" />
	<label class="description" for="url-twitter"><?php _e( 'URL for the company Twitter account', 'kraken' ); ?></label>
	<?php
}

function kraken_settings_field_url_linkedin() {
	$options = kraken_get_theme_options();
	?>
	<input type="text" name="kraken_theme_options[url_linkedin]" class="large-text" id="url-linkedin" value="<?php echo esc_url( $options['url_linkedin'] ); ?>" />
	<label class="description" for="url-linkedin"><?php _e( 'URL for the company LinkedIn account', 'kraken' ); ?></label>
	<?php
}

// Sample textarea field
function kraken_settings_field_company_address() {
    $options = kraken_get_theme_options();
    ?>
    <textarea class="large-text" type="text" name="kraken_theme_options[company_address]" id="company-address" cols="50" rows="6" /><?php echo esc_textarea( $options['company_address'] ); ?></textarea>
    <label class="description" for="company-address"><?php _e( 'Street, City, State and Zip', 'kraken' ); ?></label>
    <?php
}


// Landing Info Section 1
function kraken_settings_field_landing_info_1_title() {
	$options = kraken_get_theme_options();
	?>
	<input type="text" name="kraken_theme_options[landing_info][info_1][title]" class="large-text" id="landing-info-1-title" value="<?php echo esc_attr( $options['landing_info']['info_1']['title'] ); ?>" />
	<?php
}

function kraken_settings_field_landing_info_1_content() {
	$options = kraken_get_theme_options();
	$content = $options['landing_info']['info_1']['content'];
	$settings = array(
		'textarea_name' => 'kraken_theme_options[landing_info][info_1][content]',
		'textarea_rows' => 8
	);
	?>
	<?php wp_editor( $content, 'landing-info-1-content', $settings ); ?>
	<?php
}


// Landing Info Section 2
function kraken_settings_field_landing_info_2_title() {
	$options = kraken_get_theme_options();
	?>
	<input type="text" name="kraken_theme_options[landing_info][info_2][title]" class="large-text" id="landing-info-2-title" value="<?php echo esc_attr( $options['landing_info']['info_2']['title'] ); ?>" />
	<?php
}

function kraken_settings_field_landing_info_2_content() {
	$options = kraken_get_theme_options();
	$content = $options['landing_info']['info_2']['content'];
	$settings = array(
		'textarea_name' => 'kraken_theme_options[landing_info][info_2][content]',
		'textarea_rows' => 8
	);
	?>
	<?php wp_editor( $content, 'landing-info-2-content', $settings ); ?>
	<?php
}


// Landing Info Section 3
function kraken_settings_field_landing_info_3_title() {
	$options = kraken_get_theme_options();
	?>
	<input type="text" name="kraken_theme_options[landing_info][info_3][title]" class="large-text" id="landing-info-3-title" value="<?php echo esc_attr( $options['landing_info']['info_3']['title'] ); ?>" />
	<?php
}

function kraken_settings_field_landing_info_3_content() {
	$options = kraken_get_theme_options();
	$content = $options['landing_info']['info_3']['content'];
	$settings = array(
		'textarea_name' => 'kraken_theme_options[landing_info][info_3][content]',
		'textarea_rows' => 8
	);
	?>
	<?php wp_editor( $content, 'landing-info-3-content', $settings ); ?>
	<?php
}


// Message from Jack
function kraken_settings_field_landing_jack_title() {
	$options = kraken_get_theme_options();
	?>
	<input type="text" name="kraken_theme_options[jack][title]" class="large-text" id="landing-jack-title" value="<?php echo esc_attr( $options['jack']['title'] ); ?>" />
	<?php
}

function kraken_settings_field_landing_jack_content() {
	$options = kraken_get_theme_options();
	$content = $options['jack']['content'];
	$settings = array(
		'textarea_name' => 'kraken_theme_options[jack][content]',
		'textarea_rows' => 8
	);
	?>
	<?php wp_editor( $content, 'landing-jack-content', $settings ); ?>
	<?php
}




/* ======================================================================
	THEME OPTIONS DEFAULTS & SANITIZATION
	The defaults and sanitization methods for the theme options.

	Each option field requires a default value under kraken_get_theme_options(),
	and an if statement under kraken_theme_options_validate();
 * ====================================================================== */

// Get the current options from the database.
// If none are specified, use these defaults.
function kraken_get_theme_options() {
	$saved = (array) get_option( 'kraken_theme_options' );
	$defaults = array(
		'url_facebook' => '',
		'url_twitter' => '',
		'url_linkedin' => '',
		'company_address' => '',
		'landing_info' => array(
			'info_1' => array(
				'title' => '',
				'content' => ''
			),
			'info_2' => array(
				'title' => '',
				'content' => ''
			),
			'info_3' => array(
				'title' => '',
				'content' => ''
			),
		),
		'jack' => array(
			'title' => '',
			'content' => ''
		)
	);

	$defaults = apply_filters( 'kraken_default_theme_options', $defaults );

	$options = wp_parse_args( $saved, $defaults );
	$options = array_intersect_key( $options, $defaults );

	return $options;
}



// Sanitize and validate updated theme options
function kraken_theme_options_validate( $input ) {
	$output = array();

	if ( isset( $input['url_facebook'] ) && ! empty( $input['url_facebook'] ) )
		$output['url_facebook'] = wp_filter_nohtml_kses( $input['url_facebook'] );

	if ( isset( $input['url_twitter'] ) && ! empty( $input['url_twitter'] ) )
		$output['url_twitter'] = wp_filter_nohtml_kses( $input['url_twitter'] );

	if ( isset( $input['url_linkedin'] ) && ! empty( $input['url_linkedin'] ) )
		$output['url_linkedin'] = wp_filter_nohtml_kses( $input['url_linkedin'] );

	if ( isset( $input['company_address'] ) && ! empty( $input['company_address'] ) )
		$output['company_address'] = wp_filter_nohtml_kses( $input['company_address'] );

	if ( isset( $input['landing_info']['info_1']['title'] ) && ! empty( $input['landing_info']['info_1']['title'] ) )
		$output['landing_info']['info_1']['title'] = wp_filter_nohtml_kses( $input['landing_info']['info_1']['title'] );

	if ( isset( $input['landing_info']['info_1']['content'] ) && ! empty( $input['landing_info']['info_1']['content'] ) )
		$output['landing_info']['info_1']['content'] = wp_filter_post_kses( $input['landing_info']['info_1']['content'] );

	if ( isset( $input['landing_info']['info_2']['title'] ) && ! empty( $input['landing_info']['info_2']['title'] ) )
		$output['landing_info']['info_2']['title'] = wp_filter_nohtml_kses( $input['landing_info']['info_2']['title'] );

	if ( isset( $input['landing_info']['info_2']['content'] ) && ! empty( $input['landing_info']['info_2']['content'] ) )
		$output['landing_info']['info_2']['content'] = wp_filter_post_kses( $input['landing_info']['info_2']['content'] );

	if ( isset( $input['landing_info']['info_3']['title'] ) && ! empty( $input['landing_info']['info_3']['title'] ) )
		$output['landing_info']['info_3']['title'] = wp_filter_nohtml_kses( $input['landing_info']['info_3']['title'] );

	if ( isset( $input['landing_info']['info_3']['content'] ) && ! empty( $input['landing_info']['info_3']['content'] ) )
		$output['landing_info']['info_3']['content'] = wp_filter_post_kses( $input['landing_info']['info_3']['content'] );

	if ( isset( $input['jack']['title'] ) && ! empty( $input['jack']['title'] ) )
		$output['jack']['title'] = wp_filter_nohtml_kses( $input['jack']['title'] );

	if ( isset( $input['jack']['content'] ) && ! empty( $input['jack']['content'] ) )
		$output['jack']['content'] = $input['jack']['content'];

	return apply_filters( 'kraken_theme_options_validate', $output, $input );
}





/* ======================================================================
	THEME OPTIONS MENU
	Create the theme options menu.

	Each option field requires its own add_settings_field function.
 * ====================================================================== */

// Create theme options menu
// The content that's rendered on the menu page.
function kraken_theme_options_render_page() {
	?>
	<div class="wrap">
		<?php $theme_name = function_exists( 'wp_get_theme' ) ? wp_get_theme() : get_current_theme(); ?>
		<h2><?php printf( __( '%s Theme Options', 'kraken' ), $theme_name ); ?></h2>
		<?php settings_errors(); ?>

		<form method="post" action="options.php">
			<?php
				settings_fields( 'kraken_options' );
				do_settings_sections( 'theme_options' );
				submit_button();
			?>
		</form>
	</div>
	<?php
}


// Register the theme options page and its fields
function kraken_theme_options_init() {

	register_setting( 'kraken_options', 'kraken_theme_options', 'kraken_theme_options_validate' );

	add_settings_section( 'general', 'General Site Settings',  '__return_false', 'theme_options' );
	add_settings_field( 'url_facebook', __( 'Facebook Account', 'kraken' ), 'kraken_settings_field_url_facebook', 'theme_options', 'general' );
	add_settings_field( 'url_twitter', __( 'Twitter Account', 'kraken' ), 'kraken_settings_field_url_twitter', 'theme_options', 'general' );
	add_settings_field( 'url_linkedin', __( 'LinkedIn Account', 'kraken' ), 'kraken_settings_field_url_linkedin', 'theme_options', 'general' );
	add_settings_field( 'company_address', __( 'Company Address', 'kraken' ), 'kraken_settings_field_company_address', 'theme_options', 'general' );

	add_settings_section( 'landing1', 'Landing Page Section 1',  '__return_false', 'theme_options' );
	add_settings_field( 'landing_info_1_title', __( 'Title', 'kraken' ), 'kraken_settings_field_landing_info_1_title', 'theme_options', 'landing1' );
	add_settings_field( 'landing_info_1_content', __( 'Content', 'kraken' ), 'kraken_settings_field_landing_info_1_content', 'theme_options', 'landing1' );

	add_settings_section( 'landing2', 'Landing Page Section 2',  '__return_false', 'theme_options' );
	add_settings_field( 'landing_info_2_title', __( 'Title', 'kraken' ), 'kraken_settings_field_landing_info_2_title', 'theme_options', 'landing2' );
	add_settings_field( 'landing_info_2_content', __( 'Content', 'kraken' ), 'kraken_settings_field_landing_info_2_content', 'theme_options', 'landing2' );

	add_settings_section( 'landing3', 'Landing Page Section 3',  '__return_false', 'theme_options' );
	add_settings_field( 'landing_info_3_title', __( 'Title', 'kraken' ), 'kraken_settings_field_landing_info_3_title', 'theme_options', 'landing3' );
	add_settings_field( 'landing_info_3_content', __( 'Content', 'kraken' ), 'kraken_settings_field_landing_info_3_content', 'theme_options', 'landing3' );

	add_settings_section( 'landing_jack', 'Message from Jack',  '__return_false', 'theme_options' );
	add_settings_field( 'landing_jack_title', __( 'Title', 'kraken' ), 'kraken_settings_field_landing_jack_title', 'theme_options', 'landing_jack' );
	add_settings_field( 'landing_jack_content', __( 'Content', 'kraken' ), 'kraken_settings_field_landing_jack_content', 'theme_options', 'landing_jack' );

}
add_action( 'admin_init', 'kraken_theme_options_init' );



// Add the theme options page to the admin menu
function kraken_theme_options_add_page() {
	$theme_page = add_theme_page( __( 'Theme Options', 'kraken' ), __( 'Theme Options', 'kraken' ), 'edit_theme_options', 'theme_options', 'kraken_theme_options_render_page' );
}
add_action( 'admin_menu', 'kraken_theme_options_add_page' );



// Restrict access to the theme options page to admins
function kraken_option_page_capability( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_kraken_options', 'kraken_option_page_capability' );

?>