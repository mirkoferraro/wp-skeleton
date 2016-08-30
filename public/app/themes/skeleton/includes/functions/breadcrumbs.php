<?php
check_directly_access();

function breadcrumbs($delimiter = ' &#62; ') {
    $breadcrumbs = array();

    if (!is_home() && !is_front_page() || is_paged()) {
        global $post;
        $breadcrumbs[] = array(__('Home'), get_home_url());

        if (is_category()) {
            global $wp_query;
            $cat_obj = $wp_query->get_queried_object();
            $thisCat = $cat_obj->term_id;
            $thisCat = get_category($thisCat);
            $parentCat = get_category($thisCat->parent);
            if ($thisCat->parent != 0) {
                $breadcrumbs[] = get_category_parents($parentCat, true, ''.$delimiter.'');
            }
            $breadcrumbs[] = single_cat_title('', false);
        } elseif (is_day()) {
            $breadcrumbs[] = array(get_the_time('Y'), get_year_link(get_the_time('Y')));
            $breadcrumbs[] = array(get_the_time('F'), get_month_link(get_the_time('Y'), get_the_time('m')));
            $breadcrumbs[] = get_the_time('d');
        } elseif (is_month()) {
            $breadcrumbs[] = array(get_the_time('Y'), get_year_link(get_the_time('Y')));
            $breadcrumbs[] = get_the_time('F');
        } elseif (is_year()) {
            $breadcrumbs[] = get_the_time('Y');
        } elseif (is_attachment()) {
            $breadcrumbs[] = get_the_title();
        }

        if (is_single()) {
            $cat = get_the_category();
            if (isset($cat[0])) {
                $breadcrumbs[] = get_category_parents($cat[0], true, '');
            }
            $breadcrumbs[] = array(get_the_title(), null);
        } elseif (is_page()) {
            if ($post->post_parent) {
                $parent_id = $post->post_parent;
                $bcs = array();
                while ($parent_id) {
                    $page = get_page($parent_id);
                    $bcs[] = array(get_the_title($page->ID), get_permalink($page->ID));
                    $parent_id = $page->post_parent;
                }
                foreach(array_reverse($bcs) as $bc)
                    $breadcrumbs[] = $bc;
                $breadcrumbs[] = get_the_title();
            } else {
                $breadcrumbs[] = get_the_title();
            }
        } elseif (is_archive()) {
            $post_type     = get_post_type();
            $post_type_obj = get_post_type_object(get_post_type());

            if (is_tax()) {
                foreach (get_the_taxonomies() as $taxonomy => $title) {
                    $tax = get_taxonomy($taxonomy);
                    $breadcrumbs[] = $tax->labels->name;

                    $terms = get_the_terms($post->id, 'qcategories');
                    foreach ($terms as $term) {
                        $breadcrumbs[] = $term->name;
                    }
                }
            }
            else if (!is_category()) {
                if (is_post_type_archive($post_type)) {
                    $breadcrumbs[] = $post_type_obj->labels->name;
                } else {
                    $breadcrumbs[] = array($post_type_obj->labels->name, get_post_type_archive_link($post_type));
                    $breadcrumbs[] = get_the_title();
                }
            }
        } elseif (is_search()) {
            $breadcrumbs[] = __('Search Results For:', 'limelight').' '.get_search_query();
        } elseif (is_tag()) {
            $breadcrumbs[] = single_tag_title();
        } elseif (is_author()) {
            global $author;
            $breadcrumbs[] = get_userdata($author)->display_name;
        } elseif (is_404()) {
            $breadcrumbs[] = '404 Not Found';
        }
    }

    $count = count($breadcrumbs);
    if ( $count ) {
        $l               = $count - 1;
        $breadcrumbs[$l] = "<span class=\"current\">" . (is_array($breadcrumbs[$l]) ? $breadcrumbs[$l][0] : $breadcrumbs[$l]) . "</span>";
        $breadcrumbs     = array_filter($breadcrumbs, function($b){ return is_array($b) ? !empty($b[0]) && !empty($b[1]) : isset($b); });
        $breadcrumbs     = array_map(function($b){ return is_array($b) ? "<a href=\"".$b[1]."\">".$b[0]."</a>" : $b; }, $breadcrumbs);
    }

    ?>
    <nav id="breadcrumbs" class="breadcrumbs"><?= implode($delimiter, $breadcrumbs) ?> </nav>
    <?php
}
