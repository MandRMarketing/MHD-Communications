<?php
$column_left = get_option('options_footer_column_left');
$column_center = get_option('options_footer_column_center');
$column_right = get_option('options_footer_column_right');
?>
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
				<?= $column_left ?>
				<?php get_template_part('template-parts/social-links'); ?>
			</div>
			<div class="footer__primary__container__center">
				<?= $column_center ?>
			</div>
			<div class="footer__primary__container__right">
				<?= $column_right ?>
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