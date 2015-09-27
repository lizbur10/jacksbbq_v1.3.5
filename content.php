<?php

/* ======================================================================
	content.php
	Template for post and page content.
 * ====================================================================== */

if ( get_post_type() === 'events' ) {
	$event_details = get_post_meta( $post->ID, 'kraken_event_details', true );
}

?>

<article class="row space-bottom">

	<?php // Blog & Index Supporting Image ?>
	<?php if ( ( is_home() || is_search() || is_archive() ) && !is_post_type_archive('events') && has_post_thumbnail() ) {
		$img = get_the_post_thumbnail(
			$post->ID,
			'medium',
			array(
				'class'	=> 'img-fullbleed'
			)
		);
	?>
		<aside class="grid-third grid-flip">
			<p><?php echo $img; ?></p>
		</aside>
	<?php } ?>

	<?php // Body Content ?>
	<?php if ( is_page_template('page-img.php') ) : ?>
		<div class="grid-full">
	<?php elseif ( get_post_type() === 'events' ) : ?>
		<div class="grid-half">
	<?php elseif ( is_home() || is_search() || is_archive() || is_front_page() ) : ?>
		<div class="grid-two-thirds">
	<?php else : ?>
		<div class="grid-two-thirds float-center">
	<?php endif; ?>

		<header>
			<?php if ( is_single() || is_post_type_archive('menu') ) : ?>
				<h1 <?php if ( is_post_type_archive('menu') ) { echo 'class="space-bottom-small"'; } ?>><?php the_title(); ?></h1>
			<?php elseif ( is_page() ) : ?>
				<?php if ( !is_page_template( 'page-plain.php' ) ) : ?>
					<h1><?php the_title(); ?></h1>
				<?php endif; ?>
			<?php else : ?>
				<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
			<?php endif; ?>
			<?php if ( get_post_type() !== 'events' && get_post_type() !== 'menu' && ( is_single() || is_home() || is_search() || ( is_archive() && !is_post_type_archive('events') ) ) ) : ?>
				<aside>
					<p>
						<time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate><?php the_time( 'F j, Y' ) ?></time>
					</p>
				</aside>
			<?php endif; ?>
		</header>

		<?php the_content( '<p>' . __( 'Read More...', 'kraken' ) . '</p>' ); ?>

		<?php // Price for Menu Items ?>
		<?php if ( is_post_type_archive('menu') ) : ?>
			<?php
				$menu_price = get_post_meta( $post->ID, 'kraken_menu_price', true );
				if ( !empty( $menu_price ) ) :
			?>
				<p>$<?php echo esc_attr( $menu_price ); ?></p>
			<?php endif; ?>
		<?php endif; ?>

		<?php // Make a Reservation Link on Landing Page ?>
		<?php if ( is_front_page() ) : ?>
			<?php
				$contact_page = get_page_by_title( 'Contact' );
				$contact_url = get_page_link( $contact_page->ID );
			?>
			<p><a class="btn btn-large" href="<?php echo $contact_url; ?>">Make a Reservation</a></p>
		<?php endif; ?>

		<?php if ( get_post_type() === 'events' ) : ?>
			<?php $event_details = get_post_meta( $post->ID, 'kraken_event_details', true ); ?>
				<?php if ( $event_details['date'] === '' && $event_details['time'] === '' ) : ?>
					<p><em><?php _e( 'More event details coming soon.', 'kraken' ); ?></em></p>
				<?php else : ?>
					<p>
						<strong>Date:</strong> <?php echo esc_attr( $event_details['date'] ); ?><br>
						<strong>Time:</strong> <?php echo esc_attr( $event_details['time'] ); ?><br>
						<strong>Where:</strong><br>
						<?php echo nl2br( esc_attr( $event_details['location'] ) ); ?>
					</p>
				<?php endif; ?>
				<?php if ( $event_details['register'] === '' ) : ?>
					<p><em><?php _e( 'Registration details coming soon.', 'kraken' ); ?></em></p>
				<?php elseif ( current_time( 'timestamp', false ) > strtotime( $event_details['date'] ) ) : ?>
					<p><em><?php _e( 'This event has ended.', 'kraken' ); ?></em></p>
				<?php else : ?>
					<p><a class="btn" target="_blank" href="<?php esc_url( $event_details['register'] ); ?>">Register</a></p>
				<?php endif; ?>
		<?php endif; ?>

	</div>

	<?php // Event Maps ?>
	<?php if ( get_post_type() === 'events' && !empty( $event_details['map'] ) ) : ?>
		<aside class="grid-half">
			<p><?php echo $event_details['map']; ?></p>
		</aside>
	<?php endif; ?>

	<?php // Landing Page Supporting Image ?>
	<?php if ( is_front_page() ) : ?>
		<aside class="grid-third">
			<?php if ( get_theme_mod( 'kraken_landing_image' ) ) : ?>
				<p><img class="img-fullbleed" src="<?php echo get_theme_mod( 'kraken_landing_image' ); ?>"></p>
			<?php else : ?>
				<p><img class="img-fullbleed" src="<?php bloginfo('stylesheet_directory'); ?>/img/hero-landing.jpg"></p>
			<?php endif; ?>
		</aside>
	<?php endif; ?>

</article>

<?php if ( !is_last_post($wp_query) ) : ?>
	<hr>
<?php endif; ?> 