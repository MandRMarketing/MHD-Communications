<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="dns-prefetch" href="https://www.googletagmanager.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <?php
    blog_audience_parameter();
    wp_head();
    ?>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#loading-delay').delay(400).fadeOut(300);
            setTimeout(function() {
                $(document.body).trigger('siteLoaded');
                $(document.body).addClass('site-loaded');
            }, 700);
        });
    </script>

    <?php
    $site_key = get_option('options_captcha_site_key');
    if ($site_key) :
    ?>
        <script src="https://www.google.com/recaptcha/api.js?render=<?= esc_attr($site_key); ?>"></script>
    <?php
    endif;
    ?>

</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <div id="loading-delay"></div>

    <a class="skip-content" href="#primary-wrap" title="Skip to main content of page" tabindex="0">Skip to Content</a>

    <div id="main">
        <header role="banner" id="header" class="header">
            <div class="header__secondary-container">
                <a class="button-arrow" href="https://mhdit.hostedrmm.com:8040/ " target="_blank" rel="noreferrer">Initiate Remote Support</a>
                <a class="button-arrow" target="_blank" href="https://mhdit.myportallogin.com/" rel="noreferrer">Portal Login</a>
            </div>
            <div class="header__container mobile-hide">
                <p class="header__logo site-title">
                    <a class="header__logo__link" href="<?php bloginfo('url'); ?>/">
                        <img class="header__logo__image" src="<?php bloginfo('template_url'); ?>/assets/images/logo.svg" alt="<?php echo bloginfo('name'); ?> logo" />
                    </a>
                    <span class="header__logo__text sr-only"><?php echo bloginfo('name'); ?></span>
                </p>

                <nav role="navigation" class="header__navigation primary-nav" aria-label="Header navigation">
                    <?php
                    wp_nav_menu(array(
                        'container'       => 'ul',
                        'menu_class'      => 'primary-menu',
                        'menu_id'         => '',
                        'depth'           => 0,
                        'theme_location' => 'header_menu'
                    ));
                    ?>
                </nav>
            </div>

            <?php get_template_part('template-parts/menus/mobile-nav'); ?>
        </header>