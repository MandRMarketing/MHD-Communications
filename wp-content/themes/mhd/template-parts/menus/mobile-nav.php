<?php
$menu = 'primary-navigation';
$primary_navigation = wp_get_nav_menu_items($menu);
?>
<div class="mobile-nav desktop-hide">
    <div id="mobile-header" class="mobile-nav__header mobile-header">
        <div class="mobile-header__inner">
            <p class="mobile-header__logo">
                <a class="mobile-header__logo__link" href="<?= bloginfo('url'); ?>/">
                    <img class="mobile-header__logo__image" src="<?= bloginfo('template_url'); ?>/assets/images/logo.svg" alt="<?= bloginfo('name'); ?> logo" />
                </a>
                <span class="sr-only"><?= bloginfo('name'); ?></span>
            </p>
            <button id="mobile-trigger" type="button" class="mobile-header__button button--clear" aria-expanded="false">
                <span class="mobile-header__button__text sr-only">Menu</span>
                <span class="mobile-header__button__icon top"></span>
                <span class="mobile-header__button__icon middle"></span>
                <span class="mobile-header__button__icon bottom"></span>
            </button>
        </div>
    </div>

    <nav role="navigation" id="mobile-navigation" class="mobile-nav__menu mobile-menu" aria-hidden="true">
        <div class="mobile-menu__wrap menu-center force">
            <div id="mobile-menu" class="mobile-menu__panel">
                <?php
                //Not always needed in design, functionality set up in the various menu javascript files
                /*
                <button id="close-nav-menu" class="mobile-menu__close button--clear">
                    <span class="ikes-cross" aria-hidden="true"></span>
                </button>
                */
                ?>
                <div id="mobile-menu-primary" class="mobile-menu__group">
                    <?php mobile_nav_build_primary($primary_navigation); ?>
                </div>
            </div>
        </div>
    </nav>
</div>

<?php
/**
 * Build out primary-menu 
 */
function mobile_nav_build_primary($nav)
{
    if (empty($nav)) {
        return false;
    }

    $nav = mobile_nav_extend_nav_menu_items($nav);

    // Now, begin building the HTML
    ob_start();
?>
    <ul class="mobile-menu__navigation mobile-menu-primary" data-level="1">
        <?php
        foreach ($nav as $item) :
            // Skip if not a top level item
            if ($item->menu_item_parent !== '0') {
                continue;
            }

            $classes = mobile_nav_build_classes('mobile-menu-primary__item', $item);
        ?>
            <li id="mobile-item-<?= $item->ID; ?>" class="<?= $classes; ?>">
                <?php
                mobile_nav_build_parent_link($item);

                // Secondary menu level
                if (count($item->submenu_items) > 0) :
                    mobile_nav_build_sub_menu($item, $item->submenu_items);
                endif;
                ?>
            </li>
        <?php
        endforeach;
        ?>
    </ul>
    <?php
    $output = ob_get_contents();
    ob_end_clean();
    echo $output;
}

/**
 * Create a map/dictionary where each parent menu item's index position is saved to array
 * 
 * @param Object $nav Reference to the navigation object
 * 
 */
function mobile_nav_create_submenu_index_map($nav)
{
    $map = [];
    foreach ($nav as $index => $item) {
        if ($item->menu_item_parent) {
            if (!isset($map[$item->menu_item_parent])) {
                $map[$item->menu_item_parent] = array_search($item->menu_item_parent, array_column($nav, 'ID'));
            }
        }
    }

    return $map;
}

/**
 * Extend menu item object w/ 3 custom properties
 * 
 * @param Object $nav Reference to the navigation object
 * 
 */
function mobile_nav_extend_nav_menu_items($nav)
{

    // Ref array that maps parent menu id to its index
    $map = mobile_nav_create_submenu_index_map($nav);

    foreach ($nav as $item) {
        $isParent = $item->menu_item_parent;

        // Initialize a custom object property containing an array of objects
        $item->submenu_items = [];
        if ($item->menu_item_parent) {
            $parent_menu_item = $nav[$map[$item->menu_item_parent]];

            // If object has menu item parent, map menu item parent to nav index 
            // Push submenu items into new custom subemnu_item property
            array_push($parent_menu_item->submenu_items, $item);
        }

        // Check menu item ID matches current page
        $item->current_page = false;
        if (get_the_id() === (int)$item->object_id) {
            $item->current_page = true;
        }
    }

    return $nav;
}

/**
 * Build out list item class string
 * 
 * @param String $initial_class The initial starting class string
 * @param Object $item The menu item object
 * 
 */
function mobile_nav_build_classes($initial_class, $item)
{
    //echo var_export($item);
    $hasSubMenu = false;

    if (!empty($item->submenu_items)) {
        $hasSubMenu = true;
    }

    $isCurrentPage = $item->current_page;

    $class = $initial_class;
    if ($hasSubMenu) {
        $class .= ' has-submenu';
    }
    if ($isCurrentPage) {
        $class .= ' current-menu-item';
    }

    return $class;
}

/**
 * Build out parent menu link & button
 * 
 * @param Object $item The menu item object
 * @param String $class Custom class name prefix
 * @param Boolean $hasSubMenuMenu Determines if this menu item has a sub menu
 * 
 */
function mobile_nav_build_parent_link($item, $class = 'mobile-menu-primary')
{
    $id = $item->ID;
    $title = $item->title;
    $url = $item->url;
    $hasSubMenuMenu = count($item->submenu_items) > 0;

    $isNewTab = $item->target !== '' ? 'target="_blank"' : '';
    $isEmpty = $item->url == '#' ? true : false;

    $hasUrlAndSubMenu = !$isEmpty && $hasSubMenuMenu;
    $hasUrlAndNoSubMenu = !$isEmpty && !$hasSubMenuMenu;
    $hasNoUrlAndSubMenu = $isEmpty && $hasSubMenuMenu;
    $hasNoUrlAndNoSubMenu = $isEmpty && !$hasSubMenuMenu;

    if ($hasUrlAndSubMenu) :
    ?>
        <a class="<?= $class; ?>__item__link" href="<?= $url; ?>" <?= $isNewTab; ?>>
            <?= $title; ?>
        </a>
        <button type="button" class="<?= $class; ?>__toggle button--clear" data-open="sub-menu-<?= $id; ?>" aria-expanded="false">
            <span class="<?= $class; ?>__toggle__icon no-touch"></span>
            <span class="<?= $class; ?>__toggle__text sr-only no-touch">Open <?= $title; ?></span>
        </button>
    <?php
    endif;
    if ($hasNoUrlAndSubMenu) :
    ?>
        <button type="button" class="<?= $class; ?>__item__link button--clear" data-open="sub-menu-<?= $id; ?>" style="text-align: left;" aria-expanded="false">
            <?= $title; ?>

            <span type="button" class="<?= $class; ?>__toggle no-touch">
                <span class="<?= $class; ?>__toggle__icon"></span>
                <span class="<?= $class; ?>__toggle__text sr-only">Open <?= $title; ?></span>
            </span>
        </button>
    <?php
    endif;
    if ($hasUrlAndNoSubMenu || $hasNoUrlAndNoSubMenu) :
    ?>
        <a class="<?= $class; ?>__item__link" href="<?= $url; ?>" <?= $isNewTab; ?>>
            <?= $title; ?>
        </a>
    <?php
    endif;
}

/**
 * Build out recursive sub-menu 
 * 
 * @param Object $item The menu item object
 * @param Array $submenu Array of item objects from parent
 * 
 */
function mobile_nav_build_sub_menu($parent_item, $submenu, $data_level = 2)
{
    $parent_id = $parent_item->ID;
    $parent_title = $parent_item->title;
    ?>
    <ul id="sub-menu-<?= $parent_id; ?>" class="mobile-menu__navigation mobile-sub-menu" data-level="<?= $data_level; ?>" aria-hidden="true">
        <li class="mobile-sub-menu__close">
            <button type="button" class="mobile-sub-menu__toggle button--clear" data-close="mobile-item-<?= $parent_id; ?>">
                <span class="mobile-sub-menu__toggle__icon no-touch" aria-hidden="true"></span>
                <span class="mobile-sub-menu__toggle__text no-touch">
                    <span class="ikes-arrow reverse no-touch" aria-hidden="true"></span>
                    Back to <?= $parent_title; ?>
                </span>
            </button>
        </li>
        <?php
        foreach ($submenu as $item) :
            $classes = mobile_nav_build_classes('mobile-sub-menu__item', $item);
        ?>
            <li id="mobile-item-<?= $item->ID; ?>" class="<?= $classes; ?>">
                <?php
                mobile_nav_build_parent_link($item, 'mobile-sub-menu');

                // Secondary menu level
                if (count($item->submenu_items) > 0) :
                    mobile_nav_build_sub_menu($item, $item->submenu_items, $data_level + 1);
                endif;
                ?>
            </li>
        <?php
        endforeach;
        ?>
    </ul>
<?php
}
