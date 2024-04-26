<?php

/**
 * The Home Page
 */

get_header(); ?>

<?php get_template_part('template-parts/slider'); ?>

<main id="primary-wrap" class="primary-content">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php get_template_part('template-parts/advanced-layout'); ?>
	<?php endwhile;
	endif; ?>
</main>

<?php get_footer(); ?>