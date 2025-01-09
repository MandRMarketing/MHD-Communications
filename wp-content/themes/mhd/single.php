<?php
get_header();
?>
<main id="primary-wrap" class="primary-content">
	<?php if (have_posts()) : while (have_posts()) : the_post();
			$id = get_the_ID();
	?>
			<article id="post-<?= $id ?>" <?php post_class('post post-holder single-post'); ?>>
				<section class="section-wrap single-post-meta">
					<?php get_template_part('template-parts/title'); ?>

					<div class="container" style="margin-top: 50px;">


						<?php
						$blog_page_id = get_option('page_for_posts');
						if ($blog_page_id) :
						?>
							<div class="breadcrumbs">
								<a href="<?= get_the_permalink($blog_page_id); ?>">
									<span class="ikes-chevron-left" aria-hidden="true"></span>
									Back to Blogs</a>
							</div>
						<?php
						endif;
						?>

						<div class="post-meta">
							<p>Written by <?= get_the_author_meta('first_name'); ?> <?= get_the_author_meta('last_name'); ?></p>
							<time datetime="<?php the_time('Y-m-d\TH:i'); ?>"><?php the_time('F j, Y'); ?></time>
						</div>

					</div>
				</section>
				<section class="section-wrap blog-content">
					<div class="container">
						<?= the_content(); ?>
					</div>
				</section>
				<?php get_template_part('template-parts/advanced-layout'); ?>
				<section class="section-wrap single-post-meta">
					<div class="container" style="margin-bottom: 50px;">
						<div class="post-meta">
							<?= blog_categories($id); ?>
						</div>

						<?php
						$blog_page_id = get_option('page_for_posts');
						if ($blog_page_id) :
						?>
							<div class="breadcrumbs">
								<a href="<?= get_the_permalink($blog_page_id); ?>">
									<span class="ikes-chevron-left" aria-hidden="true"></span>
									Back to Blogs</a>
							</div>
						<?php
						endif;
						?>

					</div>
				</section>

			</article>
	<?php endwhile;
	endif; ?>
</main>
<?php get_footer(); ?>