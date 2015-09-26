<?php

/* ======================================================================
	Comments.php
	Template for post comments.
 * ====================================================================== */

?>

<?php
	// If post is password protected, don't display comments
	if ( post_password_required() ) {
		return;
	}
?>

<?php if ( have_comments() ) : // If there are comments ?>

	<h2 id="comments"><?php comments_number( __( 'Comment', 'kraken' ), __( '1 Comment', 'kraken' ), __( '% Comments', 'kraken' ) ); ?></h2>

	<?php
		wp_list_comments( array(
			'style' => 'div',
			'avatar_size' => 120,
			'callback' => 'kraken_comment_layout' // Custom comment structure (in `functions.php`)
		) );
	?>

	<?php if ( !comments_open() ) : // if there are no comments ?>
		<p><?php _e( 'Comments are closed.', 'kraken' ) ?></p>
	<?php endif; ?>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // if paginated comments ?>
		<nav>
			<hr>
			<p>
				<?php previous_comments_link( __( '&larr; Older', 'kraken' ) ); ?>
				<?php if ( get_previous_comments_link() && get_next_comments_link() ) { echo ' / '; } ?>
				<?php next_comments_link( __( 'Newer &rarr;', 'kraken' ) ); ?>
			</p>
		</nav>
	<?php endif; ?>

<?php endif; ?>


<?php if ( comments_open() ) : // If comments are allowed ?>
	<?php kraken_comment_form(); // Custom comment form (in `functions.php`) ?>
<?php endif; // end if comments are open ?>