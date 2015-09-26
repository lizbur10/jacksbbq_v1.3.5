<?php

/* ======================================================================
	archive-menu.php
	Template for displaying all menu items.
 * ====================================================================== */

$get_menu_items = new WP_Query(
	array(
		'post_type' => 'menu',
		'posts_per_page' => -1,
		'orderby' => 'menu_order'
	)
);

get_header(); ?>


<?php if ( $get_menu_items->have_posts() ) : ?>

	<h1 class="heading-plain"><?php _e( 'Menu', 'kraken' ); ?></h1>

	<?php
		while ( $get_menu_items->have_posts() ) : $get_menu_items->the_post();
		$post = $get_menu_items->post;
	?>
		<?php get_template_part( 'content', 'Post Content' ); ?>
	<?php endwhile; ?>

	<?php
		$contact_page = get_page_by_title( 'Contact' );
		$contact_url = get_page_link( $contact_page->ID );
	?>
	<p><a class="btn btn-large" href="<?php echo $contact_url; ?>">Make a Reservation</a></p>


	<!-- Previous/Next page navigation -->
	<?php get_template_part( 'nav-page', 'Page Navigation' ); ?>


<?php else : ?>
	<article>
		<header>
			<h1><?php _e( 'No events to display', 'kraken' ) ?></h1>
		</header>
	</article>
<?php endif; ?>

<?php wp_reset_postdata(); ?>


<?php get_footer(); ?>