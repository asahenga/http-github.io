<?php
function user_info() {
    add_menu_page(
        '关于作者',
        '关于作者',
        'administrator',
        'author_info',
        '',
        'dashicons-admin-users',
        99991
    );
    add_submenu_page( 'author_info', '关于作者', '关于作者', 'administrator', 'author_info', function(){
        include "info.php";
    });

}
add_action( 'admin_menu', 'user_info',1 );
add_theme_support( 'customize-selective-refresh-widgets' );
add_theme_support( 'post-thumbnails' );
add_filter( 'pre_option_link_manager_enabled', '__return_true' );
