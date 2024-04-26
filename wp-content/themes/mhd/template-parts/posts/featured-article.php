<?php
if (is_archive()) return false;

$args = array(
    'post_type'         => 'post',
    'post_status'         => 'publish',
    'posts_per_page'     => 1,
    'category_name'     => 'featured',
    'no_found_rows'     => true
);

// Overwrite default $wp_query
$query = new WP_Query($args);

if ($query->have_posts()) :
    while ($query->have_posts()) :
        $query->the_post();

        $id = get_the_ID();
        $title = get_the_title($id);
        $link = get_the_permalink($id);
        $excerpt = get_the_advanced_acf_excerpt($id);

        if (has_post_thumbnail($id)) {
            $featured_img = acf_get_attachment(get_post_thumbnail_id($id));
            if ((int)$featured_img['width'] !== 600 || (int)$featured_img['height'] !== 600) {
                $image_url = aq_resize($featured_img['url'], 600, 600, true, true, true);
            } else {
                $image_url = $featured_img['url'];
            }
        }

        $class = has_post_thumbnail($id) ? 'section-wrap blog-listing blog-listing--has-thumbnail blog-listing--featured' : 'section-wrap blog-listing blog-listing--featured';

        $image_class = has_post_thumbnail($id) ? 'two-thirds' : '';
        $content_class = has_post_thumbnail($id) ? 'two-thirds' : '';
?>
        <article class="<?= $class; ?>">
            <?php
            if (has_post_thumbnail($id)) :
            ?>
                <figure class="blog-listing__figure one-third first">
                    <img class="blog-listing__image" src="<?= $image_url; ?>" alt="<?= $featured_img['alt']; ?>">
                </figure>
            <?php
            endif;
            ?>

            <div class="blog-listing__content <?= $content_class; ?>">
                <h2 class="blog-listing__title"><?= $title; ?></h2>

                <p class="blog-listing__meta">
                    <?php
                    if (blog_categories($id)) :
                        echo blog_categories($id);
                        echo ' | ';
                    endif;
                    ?>

                    <time class="blog-listing__meta__time" datetime="<?php the_time('Y-m-d\TH:i'); ?>"><?php the_time('F j, Y'); ?></time>
                </p>

                <?php
                if ($excerpt) :
                ?>
                    <div class="blog-listing__excerpt">
                        <?= get_the_advanced_acf_excerpt($id); ?>
                    </div>
                <?php
                endif;
                ?>

                <a class="blog-listing__button button" href="<?= $link; ?>">Read More</a>
            </div>
        </article>
<?php
    endwhile;
endif;
