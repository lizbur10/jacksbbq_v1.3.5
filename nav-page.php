<?php

/* ======================================================================
	nav-page.php
	Template for older/newer page navigation.
 * ====================================================================== */

?>

<?php if ( is_paginated() ) : ?>
	<hr>
	<nav>
		<p><?php posts_nav_link( ' / ', '&larr; ' . __( 'Newer', 'kraken' ), __( 'Older', 'kraken' ) . ' &rarr;' ); ?></p>
	</nav>
<?php endif; ?>