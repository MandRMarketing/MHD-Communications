<?php
$section_id = get_sub_field('section_id');
$section_classes = get_sub_field('section_classes');
$section_background_color = get_sub_field('section_background_color');
$content = get_sub_field('content');
$category = get_sub_field('category');

// Can't just print an empty id and have id="", so build printout here instead
$id = !empty($section_id) ? "id=\"{$section_id}\"" : '';

// Apply color scheme and padding class
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
            $category_term = get_term($category);
            if ($category_term instanceof WP_Term) {
                $category_slug = $category_term->slug;
            } else {
                $category_slug = null;
            }
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 1,
                'category_name' => $category_slug
            );

            $articles_query = new WP_Query($args);
            $count = 0; // To track the first article
            if ($articles_query->have_posts()) :
                while ($articles_query->have_posts()) : $articles_query->the_post();
                    $ID = get_the_id();
                    $title = get_the_title($ID);
                    $link = get_the_permalink($ID);
                    $categories = get_the_category($ID);
                    $date = get_the_date('F j, Y', $ID); // Format the date

                    // Get the featured image URL for the first article
                    $featured_image = ($count === 0) ? get_the_post_thumbnail_url($ID, 'full') : '';

                    $count++; // Increment count

            ?>
                    <div class="news-feed__container__article">
                        <img src="<?= $featured_image ?>" alt="<?= $title ?>" class="featured-image">
                        <a href="<?= $link ?>">
                            <h3> <?= $title ?> </h3>
                        </a>
                        <p class="post-date"><?= $date ?></p> <!-- Display the date -->
                        <p class="categories">
                            <?php
                            if ($categories) :
                                $category_names = array();
                                foreach ($categories as $category) :
                                    $category_names[] = '<a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a>';
                                endforeach;
                                //this prints all the categories with comma separators
                                echo implode(' | ', $category_names);
                            endif;
                            ?>
                        </p>
                        <a class="button-arrow" href="<?= $link ?>">Read Article</a>
                    </div>
                <?php
                endwhile;
                // Reset the post data
                wp_reset_postdata();
            else :
                ?>
                <p style="display: block; text-align: center;">There are no blog articles posted yet. Stay tuned!</p>
            <?php
            endif;
            ?>
        </div>

        <div class="news-feed__container">
            <?php
            $category_term = get_term($category);
            if ($category_term instanceof WP_Term) {
                $category_slug = $category_term->slug;
            } else {
                $category_slug = null;
            }
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 4,
                // 'category_name' => $category_slug
            );

            $articles_query = new WP_Query($args);
            $count = 0; // To track the first article
            if ($articles_query->have_posts()) :
                while ($articles_query->have_posts()) : $articles_query->the_post();
                    $ID = get_the_id();
                    $title = get_the_title($ID);
                    $link = get_the_permalink($ID);
                    $categories = get_the_category($ID);
                    $date = get_the_date('F j, Y', $ID); // Format the date

                    // Get the featured image URL for the first article
                    $featured_image = ($count === 0) ? get_the_post_thumbnail_url($ID, 'full') : '';

                    $count++; // Increment count

            ?>
                    <?php if ($count !== 1) : ?>

                        <div class="news-feed__container__article">
                            <a href="<?= $link ?>">
                                <h3> <?= $title ?> </h3>
                            </a>
                            <p class="post-date"><?= $date ?></p> <!-- Display the date -->
                            <p class="categories">
                                <?php
                                if ($categories) :
                                    $category_names = array();
                                    foreach ($categories as $category) :
                                        $category_names[] = '<a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a>';
                                    endforeach;
                                    //this prints all the categories with comma separators
                                    echo implode(' | ', $category_names);
                                endif;
                                ?>
                            </p>
                            <a class="button-arrow" href="<?= $link ?>">Read Article</a>
                        </div>
                    <?php endif; ?>

            <?php
                endwhile;
                // Reset the post data
                wp_reset_postdata();

            endif;
            ?>
        </div>
        <a class="button" href="/blog/">View All Articles</a>

    </div>
</section>