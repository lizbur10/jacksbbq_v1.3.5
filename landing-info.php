<?php

/* ======================================================================
	landing-info.php
	Landing Page Content
 * ====================================================================== */

$landing_content = kraken_get_theme_options()['landing_info'];
$jack_message = kraken_get_theme_options()['jack'];
$completed_content = array();

foreach ( $landing_content as $key => $content ) {
	if ( $content['title'] && $content['content'] ) {
		$completed_content[] = $content;
	}
}

$content_count = count( $completed_content );

if ( $content_count === 1 ) {
	$grid_size = 'grid-half float-center';
} elseif ( $content_count === 2 ) {
	$grid_size = 'grid-half';
} elseif ( $content_count === 3 ) {
	$grid_size = 'grid-third';
}

?>

<?php if ( is_front_page() && $content_count !== 0 ) : ?>
	<div class="bg">
		<section class="container">
			<div class="row">

				<?php
					foreach ( $completed_content as $key => $content ) {
						?>
						<article class="<?php echo $grid_size; ?> space-bottom">
							<h3 class="no-space-top"><?php echo stripslashes( esc_attr($content['title']) ); ?></h3>
							<hr class="line-secondary">
							<?php echo $content['content']; ?>
						</article>
						<?php
					}
				?>

			</div>
		</section>
	</div>
<?php endif; ?>


<?php if ( is_front_page() && !empty( $jack_message ) ) : ?>
	<section class="container">
		<article class="space-top space-bottom group">

			<?php if ( get_theme_mod( 'kraken_frank_image' ) ) : ?>
				<img class="img-franks alignright space-top" src="<?php echo get_theme_mod( 'kraken_frank_image' ); ?>">
			<?php else : ?>
				<img class="img-franks alignright space-top" src="<?php bloginfo('stylesheet_directory'); ?>/img/bbq-icon.png">
			<?php endif; ?>

			<?php if ( !empty( $jack_message['title'] ) ) : ?>
				<h2><?php echo stripslashes( esc_attr( $jack_message['title'] ) ); ?></h2>
			<?php endif; ?>

			<?php if ( !empty( $jack_message['content'] ) ) : ?>
				<?php echo nl2br( $jack_message['content'] ); ?>
			<?php endif; ?>

		</article>

	</section>
<?php endif; ?>