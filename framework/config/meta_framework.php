<?php
if( class_exists( 'CSF' ) ) {
    $site_options = 'xyz_site_meta';

    CSF::createMetabox($site_options, array(
        'title'     => '站点信息',
        'post_type' => 'site',
        'data_type' => 'unserialize',
        'theme'     => 'light',
    ));
    CSF::createSection($site_options, array(
        'title'     => '站点信息',
        'fields'    => array(
            array(
                'id'      => 'web_logo',
                'type'    => 'media',
                'title'   => 'LOGO',
                'library' => 'image',
                'url'     => false,
            ),

            array(
                'id'      => 'web_desc',
                'type'    => 'wp_editor',
                'title'   => '描述',
            ),
            array(
                'id'      => 'web_link',
                'type'    => 'text',
                'title'   => '链接',
                'desc'    => '需要带上http://或者https://',
            ),
            array(
                'id'      => 'qrcode',
                'type'    => 'media',
                'title'   => '二维码',
                'library' => 'image',
                'url'     => false,
            ),
        )
    ) );

}
