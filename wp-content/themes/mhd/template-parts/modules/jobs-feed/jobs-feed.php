<?php
$section_id = get_sub_field('section_id');
$section_classes = get_sub_field('section_classes');
$section_background_color = get_sub_field('section_background_color');
$content = get_sub_field('content');

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
<section class="section-wrap jobs-feed <?= $section_classes; ?>" <?= $id ?>>
    <div class="jobs-feed__header-content-container container"> <?= $content ?> </div>
    <div class="jobs-feed__container container">
        <?php
        $args = array(
            'post_type' => 'mandr_job',
            'posts_per_page' => -1,
        );
        $articles_query = new WP_Query($args);
        $count = 0; // To track the first article
        if ($articles_query->have_posts()) :
            while ($articles_query->have_posts()) : $articles_query->the_post();
                $ID = get_the_id();
                $title = get_the_title($ID);
                $link = get_the_permalink($ID);
        ?>
                <div class="jobs-feed__container__job">
                    <a href="<?= $link ?>">
                        <h2> <?= $title ?> </h2>
                    </a>
                    <a class="button" href="<?= $link ?>">Learn More</a>
                </div>
            <?php
            endwhile;
            // Reset the post data
            wp_reset_postdata();
        else :
            ?>
            <p style="display: block; text-align: center;">There are no jobs posted as of right now. Stay tuned!</p>
        <?php
        endif;
        ?>

    </div>

    </div>
</section>