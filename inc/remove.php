<?php

// remove wp emoji
remove_action('wp_head', 'print_emoji_detection_script', 7 );
remove_action('admin_print_scripts','print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');

//禁止加载s.w.org并移动dns-prefetch
function remove_dns_prefetch( $hints, $relation_type ) {
    if ( 'dns-prefetch' === $relation_type ) {
        return array_diff( wp_dependencies_unique_hosts(), $hints );
    }
    return $hints;
}
add_filter( 'wp_resource_hints', 'remove_dns_prefetch', 10, 2 );
//remove wp_generator
remove_action('wp_head','wp_generator');
//remove wlwmanifest
remove_action('wp_head', 'wlwmanifest_link');
//removes EditURI/RSD (Really Simple Discovery) link.
remove_action('wp_head', 'rsd_link');
//removes edd
remove_action('wp_head', 'edd_version_in_header');


function disable_embeds_init() {
    /* @var WP $wp */
    global $wp;
// Remove the embed query var.
    $wp->public_query_vars = array_diff( $wp->public_query_vars, array(
        'embed',
    ) );
// Remove the REST API endpoint.
    remove_action( 'rest_api_init', 'wp_oembed_register_route' );
// Turn off
    add_filter( 'embed_oembed_discover', '__return_false' );
// Don't filter oEmbed results.
    remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
// Remove oEmbed discovery links.
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
// Remove oEmbed-specific JavaScript from the front-end and back-end.
    remove_action( 'wp_head', 'wp_oembed_add_host_js' );
    add_filter( 'tiny_mce_plugins', 'disable_embeds_tiny_mce_plugin' );
// Remove all embeds rewrite rules.
    add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
}

add_action( 'init', 'disable_embeds_init', 9999 );


function disable_embeds_tiny_mce_plugin( $plugins ) {
    return array_diff( $plugins, array( 'wpembed' ) );
}

function disable_embeds_rewrites( $rules ) {
    foreach ( $rules as $rule => $rewrite ) {
        if ( false !== strpos( $rewrite, 'embed=true' ) ) {
            unset( $rules[ $rule ] );
        }
    }
    return $rules;
}

function disable_embeds_remove_rewrite_rules() {
    add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
    flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'disable_embeds_remove_rewrite_rules' );

function disable_embeds_flush_rewrite_rules() {
    remove_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
    flush_rewrite_rules();
}

register_deactivation_hook( __FILE__, 'disable_embeds_flush_rewrite_rules' );


// 移除block
function remove_block_library_css() {
    wp_dequeue_style( 'wp-block-library' );
}
add_action( 'wp_enqueue_scripts', 'remove_block_library_css', 100 );

//移除shortlink
remove_action('wp_head','wp_shortlink_wp_head',10,0);
remove_action('template_redirect','wp_shortlink_header',11,0);

# 清除wp所有自带的customize选项
# ------------------------------------------------------------------------------
function remove_default_settings_customize( $wp_customize ) {
    $wp_customize->remove_section( 'title_tagline');
    $wp_customize->remove_section( 'colors');
    $wp_customize->remove_section( 'header_image');
    $wp_customize->remove_section( 'background_image');
    $wp_customize->remove_panel( 'nav_menus');
    $wp_customize->remove_section( 'static_front_page');
    $wp_customize->remove_section( 'custom_css');
    $wp_customize->remove_panel( 'widgets' );
}
add_action( 'customize_register', 'remove_default_settings_customize',50 );
//后台禁止加载谷歌字体
function wp_style_del_web( $src, $handle ) {
    if( strpos(strtolower($src),'fonts.googleapis.com') ){
        $src='';
    }
    return $src;
}
add_filter( 'style_loader_src', 'wp_style_del_web', 2, 2 );
//js处理
function wp_script_del_web( $src, $handle ) {
    $src_low = strtolower($src);
    if( strpos($src_low,'maps.googleapis.com') ){
        return  str_replace('maps.googleapis.com','ditu.google.cn',$src_low);  //google地图
    }
    if( strpos($src_low,'ajax.googleapis.com') ){
        return  str_replace('ajax.googleapis.com','ajax.useso.com',$src_low);  //google库用360替代
    }
    if( strpos($src_low,'twitter.com') || strpos($src_low,'facebook.com')  || strpos($src_low,'youtube.com') ){
        return '';        //无法访问直接去除
    }
    return $src;
}
add_filter( 'script_loader_src', 'wp_script_del_web', 2, 2 );