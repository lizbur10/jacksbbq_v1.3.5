<?php

/* ======================================================================
	footer.php
	Template for footer content.
 * ====================================================================== */

$footer_content = kraken_get_theme_options();

?>

			</section>
		</div>


		<div data-sticky-footer>

			<?php get_template_part( 'landing-info', 'Landing Page Content' ); ?>

			<div class="bg bg-secondary">
				<div class="container">

					<footer class="row">

						<article class="grid-third space-bottom">
							<h4 class="no-space-top space-bottom-small">
								<?php if ( get_theme_mod( 'kraken_logo_footer' ) ) : ?>
									<img class="logo-footer" src="<?php echo get_theme_mod( 'kraken_logo_footer' ); ?>">
									<span class="screen-reader"><?php bloginfo( 'name' ); ?></span>
								<?php else : ?>
									<img class="logo-footer" src="<?php bloginfo('stylesheet_directory'); ?>/img/logo-footer.png">
									<span class="screen-reader"><?php bloginfo( 'name' ); ?></span>
								<?php endif; ?>
							</h4>
							<?php echo nl2br( esc_attr($footer_content['company_address']), false); ?>
						</article>

						<article class="grid-two-thirds space-bottom">
							<?php get_template_part( 'nav-secondary', 'Site Navigation Footer' ); ?>
							<?php if ( $footer_content['url_facebook'] !== '' || $footer_content['url_twitter'] !== '' || $footer_content['url_linkedin'] !== '' ) : ?>
								<nav class="nav-wrap nav-social">
									<ul class="nav">
										<?php if ( $footer_content['url_facebook'] !== '' ) : ?>
											<li>
												<a href="<?php echo esc_url( $footer_content['url_facebook'] ); ?>">
													<i class="icon-facebook"></i>
													<span class="icon-fallback-text">Facebook</span>
												</a>
											</li>
										<?php endif; ?>
										<?php if ( $footer_content['url_twitter'] !== '' ) : ?>
											<li>
												<a href="<?php echo esc_url( $footer_content['url_twitter'] ); ?>">
													<i class="icon-twitter"></i>
													<span class="icon-fallback-text">Twitter</span>
												</a>
											</li>
										<?php endif; ?>
										<?php if ( $footer_content['url_linkedin'] !== '' ) : ?>
											<li>
												<a href="<?php echo esc_url( $footer_content['url_linkedin'] ); ?>">
													<i class="icon-linkedin"></i>
													<span class="icon-fallback-text">LinkedIn</span>
												</a>
											</li>
										<?php endif; ?>
									</ul>
								</nav>
							<?php endif; ?>
						</article>

					</footer>

				</div>
			</div>

		</div> <!-- /[data-sticky-footer] -->

		<?php wp_footer(); ?>

	</body>
</html>