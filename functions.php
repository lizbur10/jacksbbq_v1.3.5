<?php

/* ======================================================================
	functions.php
	For modifying and expanding core WordPress functionality.
 * ====================================================================== */

// Load theme scripts in the footer
function kraken_load_theme_js() {
	wp_register_script('feature-test-js', get_template_directory_uri() . '/js/feature-test.min.js', false, null, false);
	wp_enqueue_script('feature-test-js');
	wp_register_script('kraken-theme-js', get_template_directory_uri() . '/js/kraken.min.js', false, null, true);
	wp_enqueue_script('kraken-theme-js');
	if ( is_single() && comments_open() && get_option('thread_comments') ) {
		wp_enqueue_script( 'comment-reply' ); // Handles threaded comments
	}
}
add_action('wp_enqueue_scripts', 'kraken_load_theme_js');



// Initialize theme scripts
function kraken_initialize_theme_js( $query ) {
	echo
		'<script>' .
			'astro.init();' .
			'stickyFooter.init({' .
				'offset: 0,' .
			'});' .
			'jQuery(window).load(function() {' .
				'jQuery(".flexslider").flexslider({' .
					'directionNav: false,' .
				'});' .
			'});' .
		'</script>';
}
add_action('wp_footer', 'kraken_initialize_theme_js', 30);



// Override JetPack Contact Form Styling
function kraken_remove_grunion_style() {
	wp_deregister_style('grunion.css');
}
add_action('wp_print_styles', 'kraken_remove_grunion_style');



// Add a shortcode for the search form
function kraken_wpsearch() {
	$form = get_search_form();
	return $form;
}
add_shortcode( 'searchform', 'kraken_wpsearch' );



// Replace default password-protected post messaging with custom language
function kraken_post_password_form() {
	global $post;
	$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	$form =
		'<form class="text-center" action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post"><p>' . __( 'This is a password protected post.', 'kraken' ) . '</p><label class="screen-reader" for="' . $label . '">' . __( 'Password', 'kraken' ) . '</label><input id="' . $label . '" name="post_password" type="password"><input type="submit" name="Submit" value="' . __( 'Submit', 'kraken' ) . '"></form>';
	return $form;
}
add_filter( 'the_password_form', 'kraken_post_password_form' );



// Add Navigation Menu
function kraken_register_menus() {
	register_nav_menus(
		array(
			'header-menu' => __( 'Header Menu' ),
			'footer-menu' => __( 'Footer Menu' )
		)
	);
}
add_action( 'init', 'kraken_register_menus' );



// Home Menu Icon
// Let's you use the house icon for home in the navigation
function wpwebapp_menu_home_icon( $menu ){
	$home_icon = '<i class="icon-home"></i><span class="icon-fallback-text">Home</span>';
	return str_replace( '[get_home_icon]', preg_replace( '~^(?:f|ht)tps?://~i', '', $home_icon ), do_shortcode( $menu ) );
}
add_filter('wp_nav_menu', 'wpwebapp_menu_home_icon');



// Featured Images in Posts
add_theme_support( 'post-thumbnails', array( 'post', 'page', 'menu' ) );



// Set content width
if ( !isset( $content_width ) ) {
	$content_width = 1240;
}



// Add custom header images
add_theme_support(
	'custom-header',
	array(
		'default-image'          => '',
		'random-default'         => false,
		'width'                  => 1300,
		'height'                 => 260,
		'flex-height'            => false,
		'flex-width'             => false,
		'default-text-color'     => '',
		'header-text'            => false,
		'uploads'                => true,
		'wp-head-callback'       => '',
		'admin-head-callback'    => '',
		'admin-preview-callback' => '',
	)
);



// Make the `wp_title` function more useful
function kraken_pretty_wp_title( $title, $sep ) {

	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name
	$title .= get_bloginfo( 'name' );

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'kraken' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'kraken_pretty_wp_title', 10, 2 );



// Custom comment callback
// Called in `comments.php`
function kraken_comment_layout($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' === $args['style'] ) {
		$tag = 'div';
	} else {
		$tag = 'li';
	}
?>

	<<?php echo $tag ?> <?php if ( $depth > 1 ) { echo 'class="comment-nested"'; } ?> id="comment-<?php comment_ID() ?>">

		<hr <?php if ( $depth > 1 ) { echo 'class="line-nested"'; } ?>>

		<article>

			<?php if ($comment->comment_approved == '0') : // If the comment is held for moderation ?>
				<p><em><?php _e( 'Your comment is being held for moderation.', 'kraken' ) ?></em></p>
			<?php endif; ?>

			<header class="space-bottom-small group">
				<figure>
					<?php if ( $args['avatar_size'] !== 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
				</figure>
				<h3 class="no-space">
					<?php comment_author_link() ?>
				</h3>
				<aside>
					<time datetime="<?php comment_date( 'Y-m-d' ); ?>" pubdate><?php comment_date('F jS, Y') ?></time>
					<?php edit_comment_link('Edit', ' / ', ''); ?>
				</aside>
			</header>

			<?php comment_text(); ?>
			<?php
				// Add inline reply link
				// Only displays if nested comments are enabled
				comment_reply_link( array_merge(
					$args,
					array(
						'add_below' => 'comment',
						'depth' => $depth,
						'max_depth' => $args['max_depth'],
						'before' => '<p>',
						'after' => '</p>'
					)
				) );
			?>

		</article>

<?php
}



// Custom Comment Form
function kraken_comment_form() {

	$commenter = wp_get_current_commenter();

	$must_log_in =
		'<p>' .
			sprintf(
				__( 'You must be <a href="%s">logged in</a> to post a comment.' ),
				wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
			) .
		'</p>';

	$logged_in_as =
		'<p>' .
			sprintf(
				__( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s">Log out.</a>' ),
				admin_url( 'profile.php' ),
				$user_identity,
				wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
			) .
		'</p>';

	$notes_before = '';
	$notes_after = '';

	$field_author =
		'<div>' .
			'<label for="author">' . __( 'Name' ) . '</label>' .
			'<input type="text" name="author" id="author" value="' . esc_attr( $commenter['comment_author'] ) . '" required>' .
		'</div>';

	$field_email =
		'<div>' .
			'<label for="email">' . __( 'Email' ) . '</label>' .
			'<input type="email" name="email" id="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" required>' .
		'</div>';

	$field_url =
		'<div>' .
			'<label for="url">' . __( 'Website (optional)' ) . '</label>' .
			'<input type="url" name="url" id="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '">' .
		'</div>';

	$field_comment =
		'<div>' .
			'<textarea name="comment" id="comment" required></textarea>' .
		'</div>';

	$args = array(
		'title_reply' => __( 'Leave a Comment' ),
		'title_reply_to' => __( 'Reply to %s' ),
		'cancel_reply_link' => __( '[Cancel]' ),
		'label_submit' => __( 'Submit Comment' ),
		'comment_field' => $field_comment,
		'must_log_in' => $must_log_in,
		'logged_in_as' => $logged_in_as,
		'comment_notes_before' => $notes_before,
		'comment_notes_after' => $notes_after,
		'fields' => apply_filters(
			'comment_form_default_fields',
			array(
				'author' => $field_author,
				'email' => $field_email,
				'url' => $field_url
			)
		),
	);

	return comment_form( $args );

}



// Custom Menu Highlighting
function kraken_active_item_classes(  $classes, $item ) {
	if ( $item->title === 'Blog' && is_single() && get_post_type() !== 'events' ) {
		$classes[] = 'current-menu-item';
	}
	return $classes;
}
add_filter( 'nav_menu_css_class', 'kraken_active_item_classes', 10, 2 );



// If more than one page exists, return TRUE.
function is_paginated() {
	global $wp_query;
	if ( $wp_query->max_num_pages > 1 ) {
		return true;
	} else {
		return false;
	}
}



// If last post in query, return TRUE.
function is_last_post($wp_query) {
	$post_current = $wp_query->current_post + 1;
	$post_count = $wp_query->post_count;
	if ( $post_current == $post_count ) {
		return true;
	} else {
		return false;
	}
}



// Include Theme Settings
require_once( dirname( __FILE__ ) . '/includes/theme-options.php' );
require_once( dirname( __FILE__ ) . '/includes/logo-uploader.php' );
require_once( dirname( __FILE__ ) . '/includes/cpt-events.php' );
require_once( dirname( __FILE__ ) . '/includes/cpt-menu.php' );

?>