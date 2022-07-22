<?php

// 防止该文件直接被访问
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

function vik_add_title($sep = '&raquo;', $display = true, $seplocation = ''){

        if ((is_home() || is_front_page())) {

            $title =  get_bloginfo('name') . '-' . get_bloginfo('description');

        }
        if (is_single()||is_page()) {
            $title = get_the_title() . '-' . get_bloginfo('name');
        }
        if (is_archive()) {
            $title = get_the_archive_title() . '-' . get_bloginfo('name');
        }
        // If there's a month
        if (is_archive() && !empty($m)) {

            global $wp_locale;
            $my_year = substr($m, 0, 4);
            $my_month = $wp_locale->get_month(substr($m, 4, 2));
            $my_day = intval(substr($m, 6, 2));

            // If there's a year
            if (is_archive() && !empty($year)) {
                $title = $year;

                if (!empty($monthnum)) {
                    $title .= $sep . $wp_locale->get_month($monthnum);
                }
                if (!empty($day)) {
                    $title .= $sep . zeroise($day, 2);
                }
            }
            // If it's a search
            if (is_search()) {
                /* translators: 1: separator, 2: search phrase */
                $search = get_query_var('s');
                $title = sprintf(__('搜索：'), strip_tags($search));
            }

            // If it's a 404 page
            if (is_404()) {
                $title = '404错误！页面未找到';
            }
        }
        echo "<title>$title</title>";


}


add_action('wp_head','vik_add_title');
