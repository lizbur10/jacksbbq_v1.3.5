<?php

/* ======================================================================

	menu (Custom Post Type) v1.0
	Add menu to site.

	Uses the WP Custom Post Type API
	http://codex.wordpress.org/Post_Types#Custom_Post_Types

 * ====================================================================== */

// Add custom post type variables
function kraken_cpt_menu() {
	$labels = array(
		'name'               => _x( 'Menu', 'post type general name' ),
		'singular_name'      => _x( 'Menu Item', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'menu' ),
		'add_new_item'       => __( 'Add New Menu Item' ),
		'edit_item'          => __( 'Edit Menu Item' ),
		'new_item'           => __( 'New Menu Item' ),
		'all_items'          => __( 'All Menu Items' ),
		'view_item'          => __( 'View Menu Item' ),
		'search_items'       => __( 'Search Menu Items' ),
		'not_found'          => __( 'No menu items found' ),
		'not_found_in_trash' => __( 'No menu items found in the Trash' ),
		'parent_item_colon'  => '',
		'menu_name'          => 'Menu',
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Create and publish menu.',
		'public'        => true,
		'menu_position' => 5,
		'menu_icon'     => 'dashicons-welcome-write-blog',
		'supports'      => array( 'title', 'editor', 'thumbnail' ),
		'has_archive'   => true,
		'hierarchical'  => false,
	);
	register_post_type( 'menu', $args );
}
add_action( 'init', 'kraken_cpt_menu' );





// Create menu details metabox
function kraken_add_metabox_menu_details() {
	add_meta_box('kraken_menu_details', 'Menu Details', 'kraken_metabox_fields_menu_details', 'menu', 'normal', 'default');
}
add_action('add_meta_boxes', 'kraken_add_metabox_menu_details');


// Create metabox fields
function kraken_metabox_fields_menu_details() {

	global $post;
	$menu_price = get_post_meta( $post->ID, 'kraken_menu_price', true );
	?>

	<?php wp_nonce_field( 'kraken-menu-details-fields-nonce', 'kraken-menu-details-fields' ); ?>

	<p>
		<strong><?php _e( 'Price', 'coursebuilder' ); ?></strong><br>
		<input type="text" name="kraken-menu-price" id="kraken-menu-price" value="<?php if ( isset( $menu_price ) ) { echo esc_attr( $menu_price ); } ?>" class="large-text">
		<label class="description" for="kraken-menu-price">
			<?php _e( 'No "$" needed.' , 'kraken' ); ?>
		</label>
	</p>

	<?php
}


// Save metabox values
function kraken_save_metabox_menu_details( $post_id, $post ) {

	// Don't update on WP editor autosave
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
		return $post->ID;
	}

	// Verify data came from edit screen and user has permission to edit post
	if ( isset( $_POST['kraken-menu-details-fields'] ) && isset( $_POST['kraken-menu-details-fields'] ) && wp_verify_nonce( $_POST['kraken-menu-details-fields'], 'kraken-menu-details-fields-nonce' ) && current_user_can( 'edit_post', $post->ID ) ) {

		$price = str_replace( '$', '', $_POST['kraken-menu-price'] );
		update_post_meta( $post->ID, 'kraken_menu_price', wp_filter_nohtml_kses( $price ) );

	} else {
		return $post->ID;
	}

}
add_action('save_post', 'kraken_save_metabox_menu_details', 1, 2);


// Adds active page highlighting to navigation
function cpt_menu_active_item_classes(  $classes, $item ) {
	if ( $item->title === 'Menu' && ( is_post_type_archive('menu') || get_post_type() === 'menu' ) ) {
		$classes[] = 'current-menu-item';
	}
	return $classes;
}
add_filter( 'nav_menu_css_class', 'cpt_menu_active_item_classes', 10, 2 );


?>