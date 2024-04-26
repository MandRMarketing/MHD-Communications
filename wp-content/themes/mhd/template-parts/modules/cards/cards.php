<?php
$section_id = get_sub_field('section_id');
$section_classes = get_sub_field('section_classes');
$include_padding = get_sub_field('padding_between_sections');
$content = get_sub_field('content');
$slides = get_sub_field('slides'); // gallery
$display_type = "Overlay";

// Can't just print an empty id and have id="", so build printout here instead
$id = !empty($section_id) ? "id=\"{$section_id}\"" : '';

// padding class
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

// Set image column style class
$section_classes .= ' pages--overlay';

// Set slider scroll classes for js
$section_classes .= ' slider-scroll';
$scroll_container_class = ' slider-container';
$scroll_content_class = ' slider-content';
?>
<section <?= $id; ?> class="section-wrap pages <?= $section_classes; ?>">
    <div class="pages__container pages__container--list">
        <?php
        if ($slides) :
            $total = count($slides);
        ?>
            <div class="pages__inner container <?= $scroll_container_class; ?>" data-count="<?= $total; ?>">
                <ul class="pages__list <?= $scroll_content_class; ?>">
                    <?php
                    $classes = 'pages__list-item page';

                    // Determing single column width class
                    // if (count($slides) === 2) {
                    //     $column = 'one-half';
                    //     $classes .= ' one-half';
                    // } elseif (count($slides) >= 4) {
                    //     $column = 'one-fourth';
                    //     $classes .= ' one-fourth med-one-half';
                    // }

                    $cx = 0;
                    foreach ($slides as $slide) :
                        $cx++;
                        $image = $slide['image']; // image
                        $title = $slide['title']; // text
                        $link = $slide['button_link']; // link
                        $link_text = $slide['button_text'];

                        $column_class = $classes;

                        // Check for first column in row
                        // if ($column === 'one-half') {
                        //     $column_class .= $cx % 2 === 1 ? ' first' : '';
                        // } elseif ($column === 'one-fourth') {
                        //     $column_class .= $cx % 2 === 1 ? ' med-first' : '';
                        //     $column_class .= $cx % 4 === 1 ? ' first' : '';
                        // }

                    ?>
                        <li class="<?= $column_class; ?>">

                            <a class="page__link" href="<?= $link; ?>">
                                <?php
                                if ($image) :
                                ?>
                                    <picture class="page__picture">
                                        <img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>" />
                                    </picture>
                                <?php
                                endif;
                                ?>
                                <div class="page__content">
                                    <?= $title; ?>
                                    <span class="btn-arrow"><?= $link_text; ?></span>
                                </div>
                            </a>

                        </li>
                    <?php
                    endforeach;
                    ?>
                </ul>
            </div>
        <?php
        endif;
        ?>
    </div>
</section>