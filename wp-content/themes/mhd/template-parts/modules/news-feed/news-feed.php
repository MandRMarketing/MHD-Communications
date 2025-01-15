<?php
$section_id = get_sub_field('section_id');
$section_classes = get_sub_field('section_classes');
$content = get_sub_field('content');
$category = get_sub_field('category');

// Build ID attribute
$id = !empty($section_id) ? "id=\"{$section_id}\"" : '';

// Apply padding classes
$padding = get_sub_field('padding_between_sections');
$padding_top = $padding['section_padding_top'];
$padding_bottom = $padding['section_padding_bottom'];
if ($padding_top && $padding_bottom) {
    $section_classes .= ' double-padding';
} elseif ($padding_top) {
    $section_classes .= ' double-padding--top';
} elseif ($padding_bottom) {
    $section_classes .= ' double-padding--bot';
}
?>
<section class="section-wrap news-feed white-bg<?= $section_classes; ?>" <?= $id ?>>
    <div class="news-feed__header-content-container container">
        <?= $content ?>
        <a class="button" href="/blog/">View All Articles</a>
    </div>
    <div class="news-feed__wrapper container">
        <div class="news-feed__first-container">
            <?php
            // Prepare category slug if category is provided
            $category_slug = null;
            if ($category) {
                $category_term = get_term($category);
                if ($category_term instanceof WP_Term) {
                    $category_slug = $category_term->slug;
                }
            }

            // Build WP_Query args for the first article
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 5, // Fetch up to 5 to decide layout dynamically
            );
            if ($category_slug) {
                $args['category_name'] = $category_slug;
            }

            $articles_query = new WP_Query($args);

            // Check if no posts found, fallback to all categories
            if (!$articles_query->have_posts() && $category_slug) {
                $args['category_name'] = null; // Remove category restriction
                $articles_query = new WP_Query($args);
            }

            if ($articles_query->have_posts()) :
                $post_count = $articles_query->found_posts;

                // First article logic
                $articles_query->rewind_posts(); // Reset pointer to the beginning
                $articles_query->the_post();
                $ID = get_the_ID();
                $title = get_the_title($ID);
                $link = get_the_permalink($ID);
                $categories = get_the_category($ID);
                $date = get_the_date('F j, Y', $ID); // Format the date
                $featured_image = get_the_post_thumbnail_url($ID, 'full'); // Featured image
            ?>
                <div class="news-feed__container__article">
                    <?php if ($featured_image): ?>
                        <img src="<?= $featured_image ?>" alt="<?= $title ?>" class="featured-image">
                    <?php endif; ?>
                    <a href="<?= $link ?>">
                        <h3> <?= $title ?> </h3>
                    </a>
                    <p class="post-date"><?= $date ?></p>
                    <p class="categories">
                        <?php
                        if ($categories) :
                            $category_links = array_map(function ($cat) {
                                return '<a href="' . get_category_link($cat->term_id) . '">' . $cat->name . '</a>';
                            }, $categories);
                            echo implode(' | ', $category_links);
                        endif;
                        ?>
                    </p>
                    <a class="button-arrow" href="<?= $link ?>">Read Article</a>
                </div>
                <?php
                // Render additional articles section only if more than one article exists
                if ($post_count > 1) :
                ?>
                    <div class="news-feed__container">
                        <?php
                        // Output remaining articles
                        $counter = 0;
                        while ($articles_query->have_posts()) : $articles_query->the_post();
                            $counter++;
                            if ($counter == 1) continue; // Skip the first article already displayed

                            $ID = get_the_ID();
                            $title = get_the_title($ID);
                            $link = get_the_permalink($ID);
                            $categories = get_the_category($ID);
                            $date = get_the_date('F j, Y', $ID);
                        ?>
                            <div class="news-feed__container__article">
                                <a href="<?= $link ?>">
                                    <h3> <?= $title ?> </h3>
                                </a>
                                <p class="post-date"><?= $date ?></p>
                                <p class="categories">
                                    <?php
                                    if ($categories) :
                                        $category_links = array_map(function ($cat) {
                                            return '<a href="' . get_category_link($cat->term_id) . '">' . $cat->name . '</a>';
                                        }, $categories);
                                        echo implode(' | ', $category_links);
                                    endif;
                                    ?>
                                </p>
                                <a class="button-arrow" href="<?= $link ?>">Read Article</a>
                            </div>
                        <?php
                        endwhile;
                        ?>
                    </div>
                <?php
                endif; // End of additional articles condition
                wp_reset_postdata();
            else :
                ?>
                <p style="display: block; text-align: center;">There are no articles posted for this topic yet.</p>
            <?php
            endif;
            ?>
        </div>
        <a class="button" href="/blog/">View All Articles</a>
    </div>
</section>