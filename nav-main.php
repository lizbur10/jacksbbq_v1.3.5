<?php

/* ======================================================================
	nav-main.php
	Template for main site navigation.
 * ====================================================================== */

?>

<section class="bg bg-secondary bg-condensed">
	<div class="container">

		<nav class="nav-wrap nav-navbar">
			<a class="logo" href="<?php echo site_url(); ?>">
				<?php if ( get_theme_mod( 'kraken_logo_header' ) ) : ?>
					<img class="logo-header" src="<?php echo get_theme_mod( 'kraken_logo_header' ); ?>">
					<span class="screen-reader"><?php bloginfo( 'name' ); ?></span>
				<?php else : ?>
					<img class="logo-header" src="<?php bloginfo('stylesheet_directory'); ?>/img/logo-header.png">
					<span class="screen-reader"><?php bloginfo( 'name' ); ?></span>
				<?php endif; ?>
			</a>
			<a class="nav-toggle" data-nav-toggle="#nav-menu-main" href="#">Menu</a>
			<div class="nav-collapse" id="nav-menu-main">
				<?php
					wp_nav_menu( array(
						'theme_location' => 'header-menu',
						'menu_class' => 'nav',
						'container' => false,
						'depth' => -1,
						'fallback_cb' => false
					) );
				?>
			</div>
		</nav>

	</div>
</section>