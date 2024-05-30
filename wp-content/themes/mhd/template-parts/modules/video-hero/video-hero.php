<?php
$section_id = get_sub_field('section_id');
$section_classes = get_sub_field('section_classes');
$youtube_or_vimeo = get_sub_field('youtube_or_vimeo');
$content_video = get_sub_field('video_content');
$video_description = get_sub_field('video_description');

// Can't just print an empty id and have id="", so build printout here instead
if (!empty($section_id)) {
    $id = 'id="' . $section_id . '"';
} else {
    $id = '';
}
?>
<section <?= $id; ?> class="fullwidth-background-section <?= $section_classes; ?>">
    <div class="video_wrapper">
        <div class="video-layout-full">
            <span class="visually-hidden description"><?= $video_description ?></span>
            <div class="video">
                <?php
                $video_id = get_sub_field('vimeo_video_id');
                $video_preview_url = 'https://vimeo.com/' . $video_id;

                //$video_url = '//player.vimeo.com/video/' . $video_id;
                ?>
                <div id="background-video"></div>
                <script>
                    var options02 = {
                        url: '<?= $video_preview_url ?>',
                        width: 1920,
                        controls: false,
                        muted: true,
                        quality: '720p'
                    };

                    window['videoPlayer'] = new Vimeo.Player('background-video', options02);

                    window['videoPlayer'].setVolume(0);
                    window['videoPlayer'].play();
                    window['videoPlayer'].setLoop(true);
                    window['videoPlayer'].setAutopause(false);
                </script>
            </div>
        </div>

        <div class="video_content container">
            <div class="content-wrap">
                <?php echo $content_video ?>
            </div>
        </div>
    </div>
</section>