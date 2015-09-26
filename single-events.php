<?php

/* ======================================================================
	single-events.php
	Template for individual events.
 * ====================================================================== */

get_header(); ?>


<?php if (have_posts()) : ?>

	<?php while (have_posts()) : the_post(); ?>
		<?php get_template_part( 'content', 'Post Content' ); ?>
	<?php endwhile; ?>

<?php else : ?>
	<article>
		<header>
			<h1><?php _e( 'No events to display', 'kraken' ) ?></h1>
		</header>
	</article>
<?php endif; ?>


<?php get_footer(); ?>