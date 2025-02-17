<?php
$section_id = get_sub_field('section_id');
$section_classes = get_sub_field('section_classes');
$toggles = get_sub_field('toggles'); // repeater
$content = get_sub_field('content');

// Can't just print an empty id and have id="", so build printout here instead
$id = !empty($section_id) ? "id=\"{$section_id}\"" : '';

// Apply padding class
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
<section <?= $id; ?> class="section-wrap toggles <?= $section_classes; ?>">
    <div class="toggles__content container">
        <?= $content = get_sub_field('content'); ?>
    </div>
    <div class="toggles__container container">
        <?php
        foreach ($toggles as $toggle) :

            $title = $toggle['toggle_title']; // text
            $content = $toggle['toggle_content']; // WYSIWYG
        ?>
            <div class="toggle">
                <button class="toggle__trigger" aria-expanded="false">
                    <span class="toggle__trigger-icon" aria-hidden="true"></span>
                    <span class="toggle__trigger-text sr-only" data-show="display" data-hide="collapse">Display</span>
                    <h3><?= $title; ?></h3>
                </button>
                <div class="toggle__box" aria-hidden="true">
                    <?= do_shortcode($content); ?>
                </div>
            </div>
        <?php
        endforeach;
        ?>
    </div>
</section>