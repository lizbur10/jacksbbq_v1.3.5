<?php

/* ======================================================================
	img-carousel.php
	Image Carousel for landing page
 * ====================================================================== */

?>



	<section class="space-bottom">

		<?php if ( is_front_page() ) : ?>

			<aside>
				<div class="flexslider">
					<ul class="slides">
						<?php
							$header_images = get_uploaded_header_images();
							foreach ( $header_images as $image ) {
								?>
								<li>
									<img src="<?php echo $image['url']; ?>">
								</li>
								<?php
							}
						?>
					</ul>
				</div>
			</aside>

		<?php elseif ( is_home() && get_option('page_for_posts') ) : ?>

			<aside>
				<?php
					$img = get_the_post_thumbnail(
						get_option('page_for_posts'),
						'full',
						array(
							'class'	=> 'img-fullbleed'
						)
					);
					echo $img;
				?>
			</aside>

		<?php elseif ( is_post_type_archive('events') ) : ?>

			<?php if ( get_theme_mod( 'kraken_events_image' ) ) : ?>
				<aside>
					<img class="img-fullbleed" src="<?php echo get_theme_mod( 'kraken_events_image' ); ?>">
				</aside>
			<?php else : ?>
				<aside>
					<img class="img-fullbleed" src="<?php bloginfo('stylesheet_directory'); ?>/img/banner-events.jpg">
				</aside>
			<?php endif; ?>

		<?php elseif ( get_post_type() === 'events' ) : ?>
			<?php if ( get_theme_mod( 'kraken_events_image' ) ) : ?>
				<aside>
					<img class="img-fullbleed" src="<?php echo get_theme_mod( 'kraken_events_image' ); ?>">
				</aside>
			<?php endif; ?>

		<?php elseif ( is_post_type_archive('menu') ) : ?>

			<?php if ( get_theme_mod( 'kraken_menu_image' ) ) : ?>
				<aside>
					<img class="img-fullbleed" src="<?php echo get_theme_mod( 'kraken_menu_image' ); ?>">
				</aside>
			<?php else : ?>
				<aside>
					<img class="img-fullbleed" src="<?php bloginfo('stylesheet_directory'); ?>/img/banner-menu.jpg">
				</aside>
			<?php endif; ?>

		<?php elseif ( has_post_thumbnail() ) : ?>

			<aside>
				<?php
					$img = get_the_post_thumbnail(
						$post->ID,
						'full',
						array(
							'class'	=> 'img-fullbleed'
						)
					);
					echo $img;
				?>
			</aside>

		<?php endif; ?>

	</section>