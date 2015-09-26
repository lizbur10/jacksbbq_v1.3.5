<?php

/* ======================================================================
	nav-secondary.php
	Template for secondary site navigation.
 * ====================================================================== */

?>

<section>

	<nav class="nav-wrap nav-stacked">
		<?php
			wp_nav_menu( array(
				'theme_location' => 'footer-menu',
				'menu_class' => 'nav space-bottom-small',
				'container' => false,
				'depth' => -1,
				'fallback_cb' => false
			) );
		?>
	</nav>

</section>