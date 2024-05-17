</div>
<!-- <footer id="footer" class="footer">
	<div class="footer__primary">
		<div class="footer__primary__container container">
			<?php get_template_part('template-parts/social-links'); ?>
			<?php get_template_part('template-parts/contact-info'); ?>
		</div>
	</div>
	<div id="footer-copyright" class="footer__copyright">
		<div role="contentinfo" class="footer__copyright__container container">
			<?= do_shortcode(get_option('options_contact_info')); ?>
		</div>
	</div>
</footer> -->
<footer id="footer" class="footer">
	<div class="footer__primary">
		<div class="footer__primary__container container">
			<div class="footer__primary__container__left">
				<h3>Contact</h3>
				<a href="#">813-948-0202</a>
				<a href="#">561-363-2407</a>
				<a href="#">833-MHD-INFO</a>
				<a href="#">813-699-5001</a>
				<a href="#">info@mhdit.com</a>
				<a class="button-arrow" href="#">Initiate Remote Support</a>
				<?php get_template_part('template-parts/social-links'); ?>
			</div>
			<div class="footer__primary__container__center">
				<h3>Locations</h3>
				<a href="#">5808 Breckenridge Pkwy<br />Suite G<br />Tampa, FL 33610</a>
				<a href="#">1750 N. Florida Mango Road<br />Suite 413<br />West Palm Beach, FL 33409</a>
			</div>
			<div class="footer__primary__container__right">
				<h3>Quicklinks</h3>
				<a class="button-arrow" href="#">Portal Login</a>
				<a class="button-arrow" href="#">Managed IT Services</a>
				<a class="button-arrow" href="#">Network Cabling Services</a>
				<a class="button-arrow" href="#">Audio/Visual Systems </a>
				<a class="button-arrow" href="#">Access Control Systems Surveillance Systems </a>
				<a class="button-arrow" href="#">Phone Systems </a>
				<a class="button-arrow" href="#">Office Moving Services</a>
			</div>
		</div>
	</div>
	<div id="footer-copyright" class="footer__copyright">
		<div role="contentinfo" class="footer__copyright__container container">
			<?= do_shortcode(get_option('options_contact_info')); ?>
		</div>
	</div>
</footer>

<span id="navigation-overlay" class="navigation-overlay" title="Close navigation menu"></span>
<?php wp_footer(); ?>
</body>

</html>