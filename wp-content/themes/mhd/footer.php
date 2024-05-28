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
	<div class="footer-logo desktop-hide">
		<img src="/wp-content/themes/mhd/assets/images/mobile-footer-top.png" />
	</div>
	<div class="footer__primary">
		<div class="footer__primary__container container">
			<div class="footer__primary__container__left">
				<h3>Contact</h3>
				<a href="tel:813-948-0202">813-948-0202</a>
				<a href="tel:561-363-2407">561-363-2407</a>
				<a href="tel:833-643-4636">833-MHD-INFO</a>
				<a href="tel:813-699-5001">813-699-5001</a>
				<a href="mailto:info@mhdit.com">info@mhdit.com</a>
				<a style="margin-top: 35px;" class="button-arrow" target="_blank" href="https://mhdit.hostedrmm.com:8040/ ">Initiate Remote Support</a>
				<?php get_template_part('template-parts/social-links'); ?>
			</div>
			<div class="footer__primary__container__center">
				<h3>Locations</h3>
				<a target="_blank" href="https://maps.app.goo.gl/n9teBxqS9Yjbm7he8">5808 Breckenridge Pkwy<br />Suite G<br />Tampa, FL 33610</a>
				<a target="_blank" href="https://maps.app.goo.gl/v4eGEQEi44RLkXYy9">1750 N. Florida Mango Road<br />Suite 413<br />West Palm Beach, FL 33409</a>
			</div>
			<div class="footer__primary__container__right">
				<h3>Quicklinks</h3>
				<a class="button-arrow" target="_blank" href="https://mhdit.myportallogin.com/">Portal Login</a>
				<a class="button-arrow" href="/services/managed-it-services/">Managed IT Services</a>
				<a class="button-arrow" href="/services/managed-it-security/">Managed IT Security</a>
				<a class="button-arrow" href="/services/cabling-services/">Network Cabling Services</a>
				<a class="button-arrow" href="/services/audio-visual-systems/">Audio/Visual Systems </a>
				<a class="button-arrow" href="/services/access-control-systems/">Access Control Systems</a>
				<a class="button-arrow" href="/services/surveillance-systems/">Surveillance Systems</a>
				<a class="button-arrow" href="/services/phone-systems/">Phone Systems </a>
				<a class="button-arrow" href="/services/office-moving-services/">Office Moving Services</a>
				<a class="button-arrow" href="/services/wireless-survey-services/">Wireless Site Surveys </a>
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