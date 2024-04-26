<?php

function display_single_blog_listing($id)
{
    get_template_part('template-parts/posts/blog-listing', null, array('id' => $id));
}


function blog_categories($id = null)
{
    $id = $id ? $id : get_the_id();

    $terms = get_the_terms($id, 'category');
    $cat_array = array();

    if ($terms) :
        ob_start();
?>
        <div class="cat-list">
            <?php
            foreach ($terms as $term) {
                if ($term->slug !== 'uncategorized') {
                    $cat = '<a href="' . get_site_url() . '/category/' . $term->slug . '/" rel="category tag">' . $term->name . '</a>';
                    array_push($cat_array, $cat);
                }
            }

            if (!empty($cat_array)) {
                echo 'This entry was posted in ';
            }

            foreach ($cat_array as $cat) {
                echo $cat . ' ';
            }
            ?>
        </div>
    <?php
        return ob_get_clean();
    endif;
}

function blog_tags($id = null)
{
    $id = $id ? $id : get_the_id();

    $tags = wp_get_post_tags($id);

    if ($tags) :
        ob_start();
    ?>
        <div class="tags-list">
            <p>
                <strong>Tags: </strong>
                <?php
                foreach ($tags as $tag) :
                    $tag_name = $tag->name;
                ?>
                    <span class="post-tag"><?= $tag_name; ?></span>
                <?php
                endforeach;
                ?>
            </p>
        </div>
    <?php
        return ob_get_clean();
    endif;
}

/**
 * Display numbered pagination for blog / archive
 */
function numbered_pagination($query = null)
{
    if ($query === null) {
        global $wp_query;
        $query = $wp_query;
    }

    $total = $query->max_num_pages;
    if ($total > 1) :
    ?>
        <aside class="blog-pagination">
            <nav class="blog-pagination__navigation" role="navigation" aria-label="Pagination for articles">
                <?php
                $current = max(1, get_query_var('paged'));

                $big = 999999;
                $translated = 'Page';

                echo paginate_links(array(
                    'base'                  => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                    'format'                => '&paged=%#%',
                    'current'               => $current,
                    'total'                 => $total,
                    'prev_text'             => '<span class="blog-pagination__navigation__prev ikes-arrow reverse" aria-hidden="true"><span class="visually-hidden">Previous Page</span></span>',
                    'next_text'             => '<span class="blog-pagination__navigation__next ikes-arrow normal" aria-hidden="true"><span class="visually-hidden">Next Page</span></span>',
                    'type'                  => 'list',
                    'before_page_number'    => '<span class="screen-reader-text">' . $translated . ' </span>'
                ));
                ?>
            </nav>
            <!--.oldernewer-->
        </aside>
<?php
    endif;
}

// Use get_the_advanced_acf_excerpt, but this is the main legwork for that function
// to get and trim excerpt from ACF content
function wp_trim_advanced_acf_excerpt($text = '', $post = null)
{
    $raw_excerpt = $text;
    if ('' == $text) {
        $post = get_post($post);
        $meta = get_post_meta($post->ID);

        if (isset($meta['page_layouts_0_column_1'])) {
            $text .= $meta['page_layouts_0_column_1'][0];
        }
        if (isset($meta['page_layouts_0_column_2'])) {
            $text .= $meta['page_layouts_0_column_2'][0];
        }
        if (isset($meta['page_layouts_1_column_1'])) {
            $text .= $meta['page_layouts_1_column_1'][0];
        }
        if (isset($meta['page_layouts_1_column_2'])) {
            $text .= $meta['page_layouts_1_column_2'][0];
        }
        if (isset($meta['page_layouts_2_column_1'])) {
            $text .= $meta['page_layouts_2_column_1'][0];
        }
        if (isset($meta['page_layouts_2_column_2'])) {
            $text .= $meta['page_layouts_2_column_2'][0];
        }

        $text = strip_shortcodes($text);
        $text = excerpt_remove_blocks($text);

        /** This filter is documented in wp-includes/post-template.php */
        $text = apply_filters('the_content', $text);
        $text = str_replace(']]>', ']]&gt;', $text);

        /* translators: Maximum number of words used in a post excerpt. */
        $excerpt_length = intval(_x('55', 'excerpt_length'));

        /**
         * Filters the maximum number of words in a post excerpt.
         *
         * @since 2.7.0
         *
         * @param int $number The maximum number of words. Default 55.
         */
        $excerpt_length = (int) apply_filters('excerpt_length', $excerpt_length);

        /**
         * Filters the string in the "more" link displayed after a trimmed excerpt.
         *
         * @since 2.9.0
         *
         * @param string $more_string The string shown within the more link.
         */
        $excerpt_more = apply_filters('excerpt_more', ' ' . '[&hellip;]');
        $text         = wp_trim_words($text, $excerpt_length, $excerpt_more);
    }

    return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
}

// Get excerpt from a page with ACF content if excerpt isn't defined already
function get_the_advanced_acf_excerpt($post = null)
{
    $post = get_post($post);
    if (empty($post)) {
        return '';
    }

    if (post_password_required($post)) {
        return __('There is no excerpt because this is a protected post.');
    }

    if (!empty($post->post_excerpt)) {
        return apply_filters('get_the_excerpt', $post->post_excerpt, $post);
    } else {
        return wp_trim_advanced_acf_excerpt();
    }
}
