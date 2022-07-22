<?php
function create_site() {
    $labels = array(
        'name'               => '网址导航',
        'singular_name'      => '网址导航',
        'add_new'            => '新增网址',
        'add_new_item'       => '新增网址',
        'edit_item'          => '编辑网址',
        'new_item'           => '新网址',
        'all_items'          => '所有网址',
        'view_item'          => '查看网址',
        'search_items'       => '搜索网址',
        'not_found'          => '没有找到有关网址',
        'not_found_in_trash' => '回收站里面没有相关网址',
        'parent_item_colon'  => '',
        'menu_name'          => '网址'
    );
    $args = array(
        'labels'        => $labels,
        'description'   => '我们网站的网址导航信息',
        'public'        => true,
        'menu_position' => 5,
        'supports'      => array('title',''),
        'menu_icon'     => 'dashicons-welcome-view-site',
        'has_archive'   => true
    );
    register_post_type( 'site', $args );
}
add_action( 'init', 'create_site' );

function create_site_tax() {
    $labels = array(
        'name'              =>'网址分类',
        'singular_name'     =>'网址分类',
        'search_items'      =>'搜索分类' ,
        'all_items'         =>'所有分类' ,
        'parent_item'       =>'该分类的上级分类' ,
        'parent_item_colon' =>'该分类的上级分类：' ,
        'edit_item'         =>'编辑分类' ,
        'update_item'       =>'更新分类' ,
        'add_new_item'      =>'添加新分类' ,
        'new_item_name'     =>'新分类' ,
        'menu_name'         =>'网址分类' ,
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
    );
    register_taxonomy( 'site_category', 'site', $args );

        $terms = get_terms( array(
            'taxonomy' => 'site_category',
            'hide_empty' => false,
        ) );
        $site_category_array = [];
        foreach ($terms as $term){
            $name = $term->name ;
            $id =  $term->term_id ;
            $site_category_array[$id] = $name;
        }
        update_option('site_category_array',$site_category_array) ;


}
add_action( 'init', 'create_site_tax', 0 );

