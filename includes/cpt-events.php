<?php

/* ======================================================================

	Events (Custom Post Type) v1.0
	Add events to site.

	Uses the WP Custom Post Type API
	http://codex.wordpress.org/Post_Types#Custom_Post_Types

 * ====================================================================== */

// Add custom post type variables
function kraken_cpt_events() {
	$labels = array(
		'name'               => _x( 'Events', 'post type general name' ),
		'singular_name'      => _x( 'Event', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'event' ),
		'add_new_item'       => __( 'Add New Event' ),
		'edit_item'          => __( 'Edit Event' ),
		'new_item'           => __( 'New Event' ),
		'all_items'          => __( 'All Events' ),
		'view_item'          => __( 'View Event' ),
		'search_items'       => __( 'Search Events' ),
		'not_found'          => __( 'No events found' ),
		'not_found_in_trash' => __( 'No events found in the Trash' ),
		'parent_item_colon'  => '',
		'menu_name'          => 'Events',
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Create and publish events.',
		'public'        => true,
		'menu_position' => 5,
		'menu_icon'     => 'dashicons-calendar',
		'supports'      => array( 'title', 'editor', 'thumbnail' ),
		'has_archive'   => true,
		'hierarchical'  => false,
	);
	register_post_type( 'events', $args );
}
add_action( 'init', 'kraken_cpt_events' );





// Create event details metabox
function kraken_add_metabox_event_details() {
	add_meta_box('kraken_event_details', 'Event Details', 'kraken_metabox_fields_event_details', 'events', 'normal', 'default');
}
add_action('add_meta_boxes', 'kraken_add_metabox_event_details');


// Create metabox fields
function kraken_metabox_fields_event_details() {

	global $post;
	$event_details = get_post_meta( $post->ID, 'kraken_event_details', true );
	?>

	<?php wp_nonce_field( 'kraken-event-details-fields-nonce', 'kraken-event-details-fields' ); ?>

	<p>
		<label class="description" for="kraken-event-details-date">
			<?php _e( 'Date' , 'kraken' ); ?>
		</label>
		<input type="text" name="kraken-event-details-date" id="kraken-event-details-date" value="<?php if ( isset( $event_details['date'] ) ) { echo esc_attr( $event_details['date'] ); } ?>" class="large-text">
	</p>

	<p>
		<label class="description" for="kraken-event-details-time">
			<?php _e( 'Time' , 'kraken' ); ?>
		</label>
		<input type="text" name="kraken-event-details-time" id="kraken-event-details-time" value="<?php if ( isset( $event_details['time'] ) ) { echo esc_attr( $event_details['time'] ); } ?>" class="large-text">
	</p>

	<p>
		<label class="description" for="kraken-event-details-location">
			<?php _e( 'Location', 'kraken' ); ?>
		</label>
		<textarea name="kraken-event-details-location" id="kraken-event-details-location" class="large-text"><?php if ( isset( $event_details['location'] ) ) { echo esc_attr( $event_details['location'] ); } ?></textarea>

	</p>

	<p>
		<label class="description" for="kraken-event-details-register">
			<?php _e( 'Registration Link' , 'kraken' ); ?>
		</label>
		<input type="url" name="kraken-event-details-register" id="kraken-event-details-register" value="<?php if ( isset( $event_details['register'] ) ) { echo esc_url( $event_details['register'] ); } ?>" class="large-text">
	</p>

	<p>
		<label class="description" for="kraken-event-details-map">
			<?php _e( 'Google Map Embed Code' , 'kraken' ); ?>
		</label>
		<input type="text" name="kraken-event-details-map" id="kraken-event-details-map" value="<?php if ( isset( $event_details['map'] ) ) { echo esc_attr( $event_details['map'] ); } ?>" class="large-text">
	</p>

	<?php
}


// Save metabox values
function kraken_save_metabox_event_details( $post_id, $post ) {

	// Don't update on WP editor autosave
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
		return $post->ID;
	}

	// Verify data came from edit screen and user has permission to edit post
	if ( isset( $_POST['kraken-event-details-fields'] ) && isset( $_POST['kraken-event-details-fields'] ) && wp_verify_nonce( $_POST['kraken-event-details-fields'], 'kraken-event-details-fields-nonce' ) && current_user_can( 'edit_post', $post->ID ) ) {

		if ( filter_var($_POST['kraken-event-details-register'], FILTER_VALIDATE_URL) ) {
			$register = wp_filter_nohtml_kses( $_POST['kraken-event-details-register'] );
		} else {
			$register = '';
		}

		$event_details = array(
			'date' => wp_filter_nohtml_kses( $_POST['kraken-event-details-date'] ),
			'time' => wp_filter_nohtml_kses( $_POST['kraken-event-details-time'] ),
			'location' => wp_filter_nohtml_kses( $_POST['kraken-event-details-location'] ),
			'register' => $register,
			'map' => $_POST['kraken-event-details-map']
		);
		update_post_meta( $post->ID, 'kraken_event_details', $event_details );

	} else {
		return $post->ID;
	}

}
add_action('save_post', 'kraken_save_metabox_event_details', 1, 2);



// Adds active page highlighting to navigation
function cpt_events_active_item_classes(  $classes, $item ) {
	if ( $item->title === 'Events' && ( is_post_type_archive('events') || get_post_type() === 'events' ) ) {
		$classes[] = 'current-menu-item';
	}
	return $classes;
}
add_filter( 'nav_menu_css_class', 'cpt_events_active_item_classes', 10, 2 );


?>