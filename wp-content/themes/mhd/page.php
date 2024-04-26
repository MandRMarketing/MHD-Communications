<?php get_header(); ?>
<main id="primary-wrap" class="primary-content">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('page post-holder'); ?>>
                <div class="container">
                    <?php get_template_part('template-parts/title'); ?>
                </div>
                <?php 
                    if ( ! post_password_required( $post ) ) :
                        get_template_part( 'template-parts/advanced-layout' ); 
                    else : 
                ?>
                        <div class="container">
                            <?= do_shortcode('[spacer]') ?>
                            <?= get_the_password_form(); ?>
                        </div>
                <?php
                    endif;
                ?>
            </article>
    <?php endwhile;
    endif; ?>
</main>
<?php get_footer(); ?>