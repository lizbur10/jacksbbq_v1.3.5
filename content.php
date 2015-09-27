<?php

/* ======================================================================
	content.php
	Template for post and page content.
 * ====================================================================== */

if ( get_post_type() === 'events' ) {
	$event_details = get_post_meta( $post->ID, 'kraken_event_details', true );
}

?>

<article class="space-bottom">

	<?php if ( is_front_page() ) : ?>
		<div class="inside-stuff">
	<?php else : ?>
		<div>
	<?php endif; 
			  // Blog & Index Supporting Image ?>
			<?php if ( ( is_home() || is_search() || is_archive() ) && !is_post_type_archive('events') && has_post_thumbnail() ) {
				$img = get_the_post_thumbnail(
					$post->ID,
					'medium',
					array(
						'class'	=> 'img-fullbleed'
					)
				); ?>

			<aside class="grid-third grid-flip">
				<p><?php echo $img; ?></p>
			</aside>
		<?php } ?>

	 	<?php // Landing Page Supporting Image ?>
		<?php if ( is_front_page() ) : ?>
			<aside class="landing-img">
				<?php if ( get_theme_mod( 'kraken_landing_image' ) ) : ?>
					<p><img class="img-fullbleed" src="<?php echo get_theme_mod( 'kraken_landing_image' ); ?>"></p>
				<?php else : ?>
					<p><img class="img-fullbleed" src="<?php bloginfo('stylesheet_directory'); ?>/img/hero-landing.jpg"></p>
				<?php endif; ?>
			</aside>
		<?php endif; ?>


		<?php // Body Content ?>
		<?php if ( is_page_template('page-img.php') ) : ?>
			<div class="grid-full">
		<?php elseif ( get_post_type() === 'events' ) : ?>
			<div class="grid-half">
		<?php elseif ( is_front_page() ) : ?>
			<div class="grid-60pct inline-block">
		<?php elseif ( is_home() || is_search() || is_archive() ) : ?>
			<div class="grid-two-thirds inline-block">
		<?php else : ?>
			<div class="grid-two-thirds float-center">
		<?php endif; ?>

			<header>
				<?php if ( is_single() || is_post_type_archive('menu') ) : ?>
					<h1 <?php if ( is_post_type_archive('menu') ) { echo 'class="space-bottom-small"'; } ?>><?php the_title(); ?></h1>
				<?php elseif ( is_page() ) : ?>
					<?php if ( !is_page_template( 'page-plain.php' ) ) : ?>
						<h1><?php the_title(); ?></h1>
					<?php endif; ?>
				<?php else : ?>
					<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
				<?php endif; ?>
				<?php if ( get_post_type() !== 'events' && get_post_type() !== 'menu' && ( is_single() || is_home() || is_search() || ( is_archive() && !is_post_type_archive('events') ) ) ) : ?>
					<aside>
						<p>
							<time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate><?php the_time( 'F j, Y' ) ?></time>
						</p>
					</aside>
				<?php endif; ?>
			</header>

			<?php the_content( '<p>' . __( 'Read More...', 'kraken' ) . '</p>' ); ?>

			<?php // Price for Menu Items ?>
			<?php if ( is_post_type_archive('menu') ) : ?>
				<?php
					$menu_price = get_post_meta( $post->ID, 'kraken_menu_price', true );
					if ( !empty( $menu_price ) ) :
				?>
					<p>$<?php echo esc_attr( $menu_price ); ?></p>
				<?php endif; ?>
			<?php endif; ?>

			<?php // Make a Reservation Link on Landing Page ?>
			<?php if ( is_front_page() ) : ?>
				<?php
					$contact_page = get_page_by_title( 'Contact' );
					$contact_url = get_page_link( $contact_page->ID );
				?>
				<p><a class="btn btn-large" href="<?php echo $contact_url; ?>">Make a Reservation</a></p>
			<?php endif; ?>

			<?php if ( get_post_type() === 'events' ) : ?>
				<?php $event_details = get_post_meta( $post->ID, 'kraken_event_details', true ); ?>
					<?php if ( $event_details['date'] === '' && $event_details['time'] === '' ) : ?>
						<p><em><?php _e( 'More event details coming soon.', 'kraken' ); ?></em></p>
					<?php else : ?>
						<p>
							<strong>Date:</strong> <?php echo esc_attr( $event_details['date'] ); ?><br>
							<strong>Time:</strong> <?php echo esc_attr( $event_details['time'] ); ?><br>
							<strong>Where:</strong><br>
							<?php echo nl2br( esc_attr( $event_details['location'] ) ); ?>
						</p>
					<?php endif; ?>
					<?php if ( $event_details['register'] === '' ) : ?>
						<p><em><?php _e( 'Registration details coming soon.', 'kraken' ); ?></em></p>
					<?php elseif ( current_time( 'timestamp', false ) > strtotime( $event_details['date'] ) ) : ?>
						<p><em><?php _e( 'This event has ended.', 'kraken' ); ?></em></p>
					<?php else : ?>
						<p><a class="btn" target="_blank" href="<?php esc_url( $event_details['register'] ); ?>">Register</a></p>
					<?php endif; ?>
			<?php endif; ?>

		</div>

		<?php // Event Maps ?>
		<?php if ( get_post_type() === 'events' && !empty( $event_details['map'] ) ) : ?>
			<aside class="grid-half">
				<p><?php echo $event_details['map']; ?></p>
			</aside>
		<?php endif; ?>
	</div>

<?php if ( is_front_page() ) : ?>

	<div class="signup">
	<!--Begin CTCT Sign-Up Form-->
	<!-- EFD 1.0.0 [Thu Jul 23 09:49:45 EDT 2015] -->
	<link rel='stylesheet' type='text/css' href='https://static-pre-prod.ctctcdn.com/h/contacts-embedded-signup-assets/0.0.1-master-SNAPSHOT/css/signup-form.css'>
	<div class="ctct-embed-signup" style="font: 16px Open-Sans, Helvetica Neue, Arial, sans-serif; font: 1rem Helvetica Neue, Arial, sans-serif; line-height: 1.5; -webkit-font-smoothing: antialiased;">
	   <div style="color:#6D3429; background-color:#e8e8e8; border-radius:5px;">
	       <span id="success_message" style="display:none;">
	           <div style="text-align:center;">Thanks for signing up!</div>
	       </span>

	       <form data-id="embedded_signup:form" class="ctct-custom-form Form" name="embedded_signup" method="POST" action="https://visitor2.d1.constantcontact.com/api/signup">
	           <h2 style="margin:0; text-transform: capitalize; font-size: 150%; font-weight: bold; padding-bottom: 0.5em; padding-top: 0.5em;">Stay In Touch</h2>
	           <p>Never miss out on your favorite limited edition sandwich again!</p>
	           <!-- The following code must be included to ensure your sign-up form works properly. -->
	           <input data-id="ca:input" type="hidden" name="ca" value="5cd3a851-97dd-4c71-9a38-b5d293e7ac03">
	           <input data-id="source:input" type="hidden" name="source" value="EFD">
	           <input data-id="required:input" type="hidden" name="required" value="list,email">
	           <input data-id="url:input" type="hidden" name="url" value="">

	           <p data-id="Email Address:p" ><label data-id="Email Address:label" data-name="email" class="ctct-form-required">Email Address</label> <input data-id="Email Address:input" type="text" name="email" value="" maxlength="80"></p>
	           
	           <p data-id="First Name:p" ><label data-id="First Name:label" data-name="first_name">First Name</label> <input data-id="First Name:input" type="text" name="first_name" value="" maxlength="50"></p>
	           
	           <p data-id="Birthday:p" ><label data-id="Birthday:label" data-name="birthday_day,birthday_month">Birthday</label> <input data-id="Birthday:input" type="text" name="birthday_month" value="" placeholder="MM" style="width:75px; display: inline;" maxlength="2"> <span style="margin: .5em;"> / </span><input data-id="Birthday:input" type="text" name="birthday_day" value="" placeholder="DD" style="width:75px; display: inline;" maxlength="2"></p>
	           
	              <p data-id="Lists:p" ><label data-id="Lists:label" data-name="list" class="ctct-form-required">Email Lists</label><div><input data-id="Lists:input" type="checkbox" name="list_0" value="1824530898"><span data-id="Lists:span" style="font-size: 95%;">Jack's BBQ Birthday Coupons</span></div><div><input data-id="Lists:input" type="checkbox" name="list_1" value="1374614046"><span data-id="Lists:span" style="font-size: 95%;">Jack's BBQ Food Truck</span></div><div><input data-id="Lists:input" type="checkbox" name="list_2" value="1584259900"><span data-id="Lists:span" style="font-size: 95%;">Jack's BBQ Menu &amp; Specials</span></div><div><input data-id="Lists:input" type="checkbox" name="list_3" value="1994393936"><span data-id="Lists:span" style="font-size: 95%;">Jack's BBQ Special Events</span></div></p>

	           <button type="submit" class="Button ctct-button Button--block Button-secondary" style="color: rgb(255, 255, 255); padding: 8px 10px; text-shadow: none; border-radius: 0px; background-color: rgb(246, 82, 29);">Sign Up</button>

	       	<div><p class="ctct-form-footer">By submitting this form, you are granting: Jack's Backyard BBQ, 123 Main Street, Waltham, Massachusetts, 02451, United States, http://www.jacksbackyardbbq.com permission to email you. You may unsubscribe via the link found at the bottom of every email.  (See our <a href="http://www.constantcontact.com/legal/privacy-statement" target="_blank">Email Privacy Policy</a> for details.) Emails are serviced by Constant Contact.</p></div>
	       </form>
	   </div>
	</div>
	</div>

	<script type='text/javascript'>
	   var localizedErrMap = {};
	   localizedErrMap['required'] = 		'This field is required.';
	   localizedErrMap['ca'] = 			'An unexpected error occurred while attempting to send email.';
	   localizedErrMap['email'] = 			'Please enter your email address in name@email.com format.';
	   localizedErrMap['birthday'] = 		'Please enter birthday in MM/DD format.';
	   localizedErrMap['anniversary'] = 	'Please enter anniversary in MM/DD/YYYY format.';
	   localizedErrMap['custom_date'] = 	'Please enter this date in MM/DD/YYYY format.';
	   localizedErrMap['list'] = 			'Please select at least one email list.';
	   localizedErrMap['generic'] = 		'This field is invalid.';
	   localizedErrMap['shared'] = 		'Sorry, we could not complete your sign-up. Please contact us to resolve this.';
	   localizedErrMap['state_mismatch'] = 'Mismatched State/Province and Country.';
	   localizedErrMap['state_province'] = 'Select a state/province';
	   localizedErrMap['selectcountry'] = 	'Select a country';
	   var postURL = 'https://visitor2.d1.constantcontact.com/api/signup';
	</script>

	<script type='text/javascript' src='https://static-pre-prod.ctctcdn.com/h/contacts-embedded-signup-assets/0.0.1-master-SNAPSHOT/js/signup-form.js'></script>
	<!--End CTCT Sign-Up Form-->

<?php endif; ?>
</article>



<?php if ( !is_last_post($wp_query) ) : ?>
	<hr>
<?php endif; ?>