<?php



if( class_exists( 'CSF' ) ) {
    $prefix = 'vik_customize';
    CSF::createCustomizeOptions($prefix);
    CSF::createSection($prefix, array(
        'title'          => '资料设置',
        'transport'      => 'refresh',
        'capability'     => 'manage_options',
        'save_defaults'  => true,
        'enqueue_webfont'=> true,
        'async_webfont'  => true,
        'output_css'     => true,
        'assign'         => 'title_tagline',
        'fields'         => array(

            array(
                'id'      => 'logo',
                'type'    => 'media',
                'title'   => '网站LOGO',
                'library' => 'image',
                'url'     => false,

            ),
            array(
                'id'    => 'transfer_page',
                'type'  => 'switcher',
                'title' => '是否启用中间页',
                'default' => true,

            ),

            array(
                'id'    => 'weather_switcher',
                'type'  => 'switcher',
                'title' => '是否启用天气预报',
                'default' => true,

            ),

            array(
                'id'      => 'qq',
                'type'    => 'text',
                'title'   => 'QQ',
                'default' => '865852099',
            ),
            array(
                'id'      => 'weibo',
                'type'    => 'text',
                'title'   => '微博链接',
                'default' => 'https://www.weixingv.com',
            ),
            array(
                'id'      => 'bilibili',
                'type'    => 'text',
                'title'   => 'B站链接',
                'default' => 'https://www.weixingv.com',
            ),
            array(
                'id'      => 'zhihu',
                'type'    => 'text',
                'title'   => '知乎链接',
                'default' => 'https://www.weixingv.com',
            ),

        )
    ));

    CSF::createSection($prefix, array(
        'title'          => '首页布局',
        'transport'      => 'refresh',
        'capability'     => 'manage_options',
        'save_defaults'  => true,
        'enqueue_webfont'=> true,
        'async_webfont'  => true,
        'output_css'     => true,
        'assign'         => 'title_tagline',
        'fields'         => array(
            array(
                'id'     => 'index_content_group',
                'type'   => 'group',
                'title'  => '首页布局',
                'fields' => array(
                    array(
                        'id'         => 'section_title',
                        'type'       => 'text',
                        'title'      => '模块名称',
                        'default'    => '新建模块'
                    ),
                    array(
                        'id'         => 'section_category',
                        'type'       => 'radio',
                        'inline'     => true,
                        'title'      => '模块类型',
                        'options'    => array(

                            'banner' => '广告',
                            'site'   => '站点导航',
                            'post'   => '文章',
                            'friend_link'   => '友情链接',

                        ),
                        'default'    => 'banner'
                    ),

//  广告选项数据填写
                    array(
                        'id'           => 'banner_subtitle',
                        'type'         => 'text',
                        'title'        => '模块副标题',
                        'dependency'   => array('section_category', '==', 'banner'),
                    ),
                    array(
                        'id'           => 'banner_link',
                        'type'         => 'text',
                        'title'        => '模块跳转链接',
                        'subtitle'     => 'http://或https://',
                        'dependency'   => array('section_category', '==', 'banner'),
                    ),
                    array(
                        'id'           => 'banner_background',
                        'type'         => 'media',
                        'title'        => '广告图片',
                        'library'      => 'image',
                        'url'          => false,
                        'dependency'   => array('section_category', '==', 'banner'),
                    ),

//  站点导航选项数据填写
                    array(
                        'id'            => 'section_site_category_data',
                        'type'          => 'select',
                        'title'         => '调用数据',
                        'dependency'   => array('section_category', '==', 'site'),
                        'placeholder'  => '请选择站点分类',
                        'options'      => get_option('site_category_array'),
                    ),

//  文章选项数据填写
                    array(
                        'id'            => 'section_post_category_data',
                        'type'          => 'select',
                        'title'         => '调用数据',
                        'dependency'   => array('section_category', '==', 'post'),
                        'placeholder'  => '请选择站点分类',
                        'options'     => 'categories',
                    ),



                ),
            ),
        )
    ));

}

function add_blue_pencil( $wp_customize ) {

    $wp_customize->selective_refresh->add_partial(
        'vik_customize[logo]',
        array(
            'selector'        => '.navbar-brand',
        )
    );

    $wp_customize->selective_refresh->add_partial(
        'vik_customize[weather_switcher]',
        array(
            'selector'        => '#he-plugin-simple',
        )
    );
    $wp_customize->selective_refresh->add_partial(
        'vik_customize[qq]',
        array(
            'selector'        => '.social_list',
        )
    );

}
add_action( 'customize_register', 'add_blue_pencil' );