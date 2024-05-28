<?php
$id = $args['id'];

if (!$id) {
    return;
}

$title = get_the_title($id);
$link = get_the_permalink($id);
$excerpt = get_the_advanced_acf_excerpt($id);
$categories = get_the_category();

$featured_img = acf_get_attachment(get_post_thumbnail_id($id));
if ($featured_img) {
    if ((int)$featured_img['width'] !== 600 || (int)$featured_img['height'] !== 600) {
        $image_url = aq_resize($featured_img['url'], 600, 600, true, true, true);
    } else {
        $image_url = $featured_img['url'];
    }
}

?>
<article class="section-wrap blog-listing blog-listing--has-thumbnail">
    <?php
    if ($featured_img) :
    ?>
        <figure class="blog-listing__figure">
            <img class="blog-listing__image" src="<?= $image_url; ?>" alt="<?= $featured_img['alt']; ?>">
        </figure>
    <?php
    endif;
    ?>
    <div class="blog-listing__content white-bg">
        <header class="blog-listing__header">
            <a href="<?= $link; ?>">
                <h3 class="blog-listing__header__title"><?= $title; ?></h3>
            </a>
            <time class="blog-listing__header__time" datetime="<?php the_time('Y-m-d\TH:i'); ?>"><?php the_time('F j, Y'); ?></time>
            <div class="categories">
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
            </div>
        </header>
        <a class="blog-listing__button button-arrow" href="<?= $link; ?>"><span class="text-wrap">Read More</span></a>
    </div>
</article>