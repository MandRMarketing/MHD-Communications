</div>
<footer id="footer" class="footer">
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
</footer>

<span id="navigation-overlay" class="navigation-overlay" title="Close navigation menu"></span>
<?php wp_footer(); ?>
</body>

</html>