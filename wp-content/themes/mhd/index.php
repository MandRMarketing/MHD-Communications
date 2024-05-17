<?php
get_header();
?>

<main id="primary-wrap" class="primary-content" role="main">
	<div class="archive-holder">
		<?php get_template_part('template-parts/title'); ?>
		<div class="container">
			<?php
			// Get the featured post
			$featured_args = array(
				'post_type' => 'post',
				'category_name' => 'featured',
				'posts_per_page' => 1
			);
			$featured_query = new WP_Query($featured_args);
			// var_dump($featured_query);
			if ($featured_query->have_posts()) :
				while ($featured_query->have_posts()) :
					$featured_query->the_post();
					$title = get_the_title();
					$link = get_the_permalink();
					$content = get_the_content();
					$content = wp_strip_all_tags($content);
					$image = get_the_post_thumbnail();
					$max_length = 400; // maximum length of the truncated string
					$ellipsis = '...'; // ellipsis to be added

					if (strlen($content) > $max_length) {
						$content = substr($content, 0, $max_length) . $ellipsis;
					}
			?>
					<div class="featured-blog">
						<div class="featured-blog__content">
							<h5>Featured News Article</h5>
							<h1><?= $title ?></h1>
							<div class="featured-blog__content__excerpt">
								<p><?= $content ?></p>
							</div>
							<a class="blog-listing__button button btn" href="<?= $link; ?>">Read Article</a>
						</div>
						<div class="featured-blog__image">
							<?= $image ?>
						</div>
					</div>
			<?php
				endwhile;
			endif;

			// Reset the post data to loop through the other posts
			wp_reset_postdata();
			?>
			<div class="filter-bar">
				<form action="<?php echo esc_url(home_url('/')); ?>" method="get" class="filter-form">
					<select name="cat" class="category-filter" onchange="this.form.submit()">
						<option value="">Category</option>
						<?php
						$categories = get_categories();
						foreach ($categories as $category) {
							$selected = (isset($_GET['cat']) && $_GET['cat'] == $category->term_id) ? 'selected' : '';
							echo '<option value="' . esc_attr($category->term_id) . '" ' . $selected . '>' . esc_html($category->name) . '</option>';
						}
						?>
					</select>
					<select name="m" class="archive-filter" onchange="this.form.submit()">
						<option value="">Archive</option>
						<?php
						$years = $wpdb->get_col("SELECT DISTINCT YEAR(post_date) FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' ORDER BY post_date DESC");
						foreach ($years as $year) {
							$selected = (isset($_GET['m']) && $_GET['m'] == $year) ? 'selected' : '';
							echo '<option value="' . esc_attr($year) . '" ' . $selected . '>' . esc_html($year) . '</option>';
						}
						?>
					</select>
					<noscript><input type="submit" value="Filter"></noscript>
				</form>
			</div>

			<div id="posts" class="posts">
				<?php
				if ($wp_query->have_posts()) :
					while ($wp_query->have_posts()) :
						$wp_query->the_post();
						get_template_part('template-parts/posts/blog-listing', null, array('id' => get_the_ID()));
					endwhile;
					numbered_pagination();
				else :
				?>
					<div class="no-results">
						<p>We're sorry, but there are currently no posts in this area.</p>
					</div>
				<?php
				endif;
				?>
			</div>
		</div>
	</div>
</main>

<?php get_footer(); ?>