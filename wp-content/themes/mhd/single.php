<?php
get_header();
?>
<main id="primary-wrap" class="primary-content">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class('post post-holder single-post'); ?>>
				<section class="section-wrap single-post-meta">
					<div class="container">

						<?php get_template_part('template-parts/title'); ?>

						<?php
						$blog_page_id = get_option('page_for_posts');
						if ($blog_page_id) :
						?>
							<div class="breadcrumbs">
								<a href="<?= get_the_permalink($blog_page_id); ?>">
									<span class="ikes-chevron-left" aria-hidden="true"></span>
									Back to <?= get_the_title($blog_page_id); ?></a>
							</div>
						<?php
						endif;
						?>

						<time datetime="<?php the_time('Y-m-d\TH:i'); ?>"><?php the_time('F j, Y'); ?></time>

						<?= blog_categories(); ?>

						<?= blog_tags(); ?>

					</div>
				</section>
				<?php get_template_part('template-parts/advanced-layout'); ?>
			</article>
	<?php endwhile;
	endif; ?>
</main>
<?php get_footer(); ?>