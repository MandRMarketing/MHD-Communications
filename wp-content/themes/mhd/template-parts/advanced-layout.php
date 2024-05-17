<?php
if (have_rows('page_layouts')) :
    while (have_rows('page_layouts')) :
        the_row();

        /* Standard Section */
        if (get_row_layout() == 'module_standard') :
            get_template_part('template-parts/modules/columns/columns');

        /* callout-content */
        elseif (get_row_layout() == 'module_callout_content') :
            get_template_part('template-parts/modules/callout-content/callout-content');

        /* callout-offset-content */
        elseif (get_row_layout() == 'module_callout_content_cards') :
            get_template_part('template-parts/modules/callout-content-cards/callout-content-cards');

        /* callout-content-cards */
        elseif (get_row_layout() == 'module_callout_offset_content') :
            get_template_part('template-parts/modules/callout-offset-content/callout-offset-content');

        /* cards */
        elseif (get_row_layout() == 'module_cards_slider') :
            get_template_part('template-parts/modules/cards/cards');

        /* faqs-feed */
        elseif (get_row_layout() == 'module_faqs_feed') :
            get_template_part('template-parts/modules/faqs-feed/faqs-feed');

        /* Toggle Layout */
        elseif (get_row_layout() == 'module_toggles') :
            get_template_part('template-parts/modules/toggles/toggles');

        /* jobs-feed */
        elseif (get_row_layout() == 'module_jobs_feed') :
            get_template_part('template-parts/modules/jobs-feed/jobs-feed');

        /* locations-feed */
        elseif (get_row_layout() == 'module_locations_feed') :
            get_template_part('template-parts/modules/locations-feed/locations-feed');

        /* news-feed */
        elseif (get_row_layout() == 'module_news_feed') :
            get_template_part('template-parts/modules/news-feed/news-feed');

        /* offset-content-bg */
        elseif (get_row_layout() == 'module_offset_content_background') :
            get_template_part('template-parts/modules/offset-content-bg/offset-content-bg');

        /* Team Layout */
        elseif (get_row_layout() == 'module_team') :
            get_template_part('template-parts/modules/team/team');

        /* Hero Video Layout */
        elseif (get_row_layout() == 'module_hero_video') :
            get_template_part('template-parts/modules/video-hero/video-hero');

        endif; // end if switching statement over layout types
    endwhile; // end while(layouts) loop
endif; // end have(layouts) check