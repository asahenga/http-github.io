<?php

//  获取站点链接
function the_site_link(){
    echo get_the_site_link();
}
function get_the_site_link(){
    $options = get_option('vik_customize');
    $switcher = $options['transfer_page'];
    if($switcher){
        return get_the_permalink();
    }else{
        return get_post_meta(get_the_ID(),'web_link','true');
    }
}


//  获取站点logo
function the_site_logo_url(){
    echo get_the_site_logo_url();
}
function get_the_site_logo_url(){
    $site_logo_url = get_post_meta(get_the_ID(),'web_logo','true')['url'];
    if(empty($site_logo_url)){
        $site_logo_url = get_bloginfo('template_url').'/static/img/a1.jog';
    }
    return $site_logo_url;
}


//  获取站点描述
function the_site_desc(){
    echo get_the_site_desc();
}
function get_the_site_desc(){
    $site_desc = get_post_meta(get_the_ID(),'web_desc','true');
    if(empty($site_desc)){
        $site_desc = get_the_title().'官方网站';
    }
    return $site_desc;
}

