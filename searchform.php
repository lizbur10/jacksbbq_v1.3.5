<?php

/* ======================================================================
	searchform.php
	Template for search form.
	`.screen-reader` class hides label when used with Kraken boilerplate.
 * ====================================================================== */

?>

<form method="get" id="searchform" action="<?php echo esc_url( home_url('/') ); ?>" >
	<label class="screen-reader" for="s"><?php _e( 'Search this site:', 'kraken' ) ?></label>
	<input type="text" id="s" name="s" placeholder="<?php _e( 'Search this site...', 'kraken' ) ?>" value="<?php get_search_query(); ?>">
	<button type="submit" class="btn" id="searchsubmit"><?php _e( 'Search', 'kraken' ) ?></button>
</form>