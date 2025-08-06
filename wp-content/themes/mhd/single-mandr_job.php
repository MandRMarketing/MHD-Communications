<?php
get_header();
?>
<main id="primary-wrap" class="primary-content">
    <?php if (have_posts()) : while (have_posts()) : the_post();
            $id = get_the_ID();
    ?>
            <article id="post-<?= $id ?>" <?php post_class('post post-holder single-post'); ?>>
                <section class="section-wrap single-career">
                    <div class="title">
                        <div class="container">
                            <h1><?= the_title(); ?></h1>
                        </div>
                    </div>
                    <div class="container">


                        <?php
                        $blog_page_id = get_option('page_for_posts');
                        if ($blog_page_id) :
                        ?>
                            <div class="breadcrumbs">
                                <a href="/careers/">
                                    <span class="ikes-chevron-left" aria-hidden="true"></span>
                                    Back to Careers
                                </a>
                            </div>
                        <?php
                        endif;
                        ?>
                        <div class="post-content">
                            <?php the_post_thumbnail() ?>
                            <?php the_content(); ?>
                        </div>

                    </div>
                </section>
                <section class="section-wrap blue-bg columns double-padding" style="color:#ffffff !important;">
                    <div class="columns__container container">
                        <div class="columns__content">
                            <div class="columns__row no-row-padding">
                                <div class="column ">
                                    <?php echo get_field('application_benefits_info')['how_to_apply'] ?> 
                                </div>
                            </div>
                            <div class="columns__row no-row-padding">
                                <div class="column one-third first">
                                    <img decoding="async" class="alignnone size-full wp-image-775" src="/wp-content/uploads/2024/05/Component-8-–-1.png" alt="" width="151" height="131">
                                    <p>A competitive starting salary with the opportunity to receive a raise at each review</p>
                                </div>
                                <div class="column one-third">
                                    <img decoding="async" class="alignnone size-full wp-image-769" src="/wp-content/uploads/2024/05/Component-9-–-1.png" alt="" width="151" height="131">
                                    <p>Paid holidays</p>
                                </div>
                                <div class="column one-third">
                                    <img loading="lazy" decoding="async" class="alignnone size-full wp-image-772" src="/wp-content/uploads/2024/05/Component-10-–-1.png" alt="" width="151" height="131">
                                    <p>Health, vision, and dental insurance</p>
                                </div>
                            </div>
                            <div class="columns__row no-row-padding">
                                <div class="column one-third first">
                                    <img loading="lazy" decoding="async" class="alignnone size-full wp-image-771" src="/wp-content/uploads/2024/05/Component-7-–-1.png" alt="" width="151" height="131">
                                    <p>100% company-paid life insurance</p>
                                </div>
                                <div class="column one-third">
                                    <img loading="lazy" decoding="async" class="alignnone size-full wp-image-774" src="/wp-content/uploads/2024/05/Component-12-–-1.png" alt="" width="151" height="131">
                                    <p>Paid vacation and sick time</p>
                                </div>
                                <div class="column one-third">
                                    <img loading="lazy" decoding="async" class="alignnone size-full wp-image-768" src="/wp-content/uploads/2024/05/Component-11-–-1.png" alt="" width="151" height="131">
                                    <p>Cost coverage for your certifications</p>
                                </div>
                            </div>
                            <div class="columns__row no-row-padding">
                                <div class="column ">
                                    <img loading="lazy" decoding="async" class="alignnone size-full wp-image-773" src="/wp-content/uploads/2024/05/Component-13-–-1.png" alt="" width="151" height="131">
                                    <p>401(k) with matching contributions</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <span class="columns__background abs-cover bg-image" style="background-color:#003c71;"></span>
                </section>
            </article>
    <?php endwhile;
    endif; ?>
</main>
<?php get_footer(); ?>