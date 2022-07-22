<?php

register_nav_menus(array(
    'main_menu' => '主菜单',
));
// 以数组的方式获取wordpress的menu

function xyz_get_menu_array($menu_location_name) {
    $current_menu = xyz_get_menu_name_by_location($menu_location_name) ;
    $array_menu = wp_get_nav_menu_items($current_menu);
    if(is_array($array_menu)){
        $menu = array();
        foreach ($array_menu as $m) {
            if (empty($m->menu_item_parent)) {
                $menu[$m->ID] = array();
                $menu[$m->ID]['ID']      =   $m->ID;
                $menu[$m->ID]['title']       =   $m->title;
                $menu[$m->ID]['url']         =   $m->url;
                $menu[$m->ID]['classes']     =   $m->classes;
                $menu[$m->ID]['children']    =   array();
            }
        }
        $submenu = array();
        foreach ($array_menu as $m) {
            if ($m->menu_item_parent) {
                $submenu[$m->ID] = array();
                $submenu[$m->ID]['ID']       =   $m->ID;
                $submenu[$m->ID]['title']    =   $m->title;
                $submenu[$m->ID]['url']  =   $m->url;
                $submenu[$m->ID]['classes']  =   $m->classes;
                $menu[$m->menu_item_parent]['children'][$m->ID] = $submenu[$m->ID];
            }
        }
        return $menu;
    }

}

function xyz_get_menu_name_by_location($menu_location_name){
    $locations = get_nav_menu_locations();
    $menu = wp_get_nav_menu_object( $locations[ $menu_location_name ] );
    return $menu->name;
}
function is_menu_loaction_has_menu($menu_location_name){
    $menu_name = xyz_get_menu_name_by_location($menu_location_name);
    if(isset($menu_name)){
        return true;
    }else{
        return false;
    }
}

function menu_item_class_select(){
    global $pagenow;
    if ($pagenow == "nav-menus.php"){
        ?>
        <script>
            jQuery('#menu-to-edit .field-css-classes > label').prop ('firstChild').nodeValue = '图标',
        </script>
        <?php
    }
}
add_action('admin_footer','menu_item_class_select');

