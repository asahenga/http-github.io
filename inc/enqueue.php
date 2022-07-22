<?php
function vplus_enqueue_sources() {
   // wp_deregister_script('jquery');
    wp_enqueue_style ( 'site'      ,get_template_directory_uri()."/static/css/site.css"        ,array(), false, 'all');
    wp_enqueue_style ( 'font-awesome' ,get_template_directory_uri()."/static/lab/font-awesome/css/font-awesome.min.css",array(), '4.7.0', 'all');
    wp_enqueue_script( 'jquery'   );
    wp_enqueue_script( 'site'      ,get_template_directory_uri()."/static/js/site.min.js"          ,array(), false, true);
}
add_action('wp_enqueue_scripts' , 'vplus_enqueue_sources' , 2);
