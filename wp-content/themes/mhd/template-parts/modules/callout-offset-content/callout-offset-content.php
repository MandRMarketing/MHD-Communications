<?php
$section_id = get_sub_field('section_id');
$section_classes = get_sub_field('section_classes');
$callout_position = get_sub_field('callout_position');
$callout_content = get_sub_field('callout_content');
$cards = get_sub_field('cards');
$bottom_content = get_sub_field('content');
$section_classes .= ' columns';

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

<section <?= $section_id; ?> class="section-wrap callout-offset-content <?= $section_classes; ?> <?= $callout_position === true ? 'callout-top' : 'callout-bottom' ?>">
    <div class="callout-offset-content__container container">
        <div class="callout-offset-content__container__callout">
            <img src="/wp-content/themes/mhd/assets/images/callout-logo.svg" alt="MHD logo" />
            <div> <?= $callout_content ?>
            </div>
        </div>
        <div class="callout-offset-content__container__content">
            <?= $bottom_content ?>
        </div>
    </div>
</section>