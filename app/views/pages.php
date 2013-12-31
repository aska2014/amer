<?php

return array(

    'default' => array( 'template' => 'main',
                        'header' => 'header.top | header.logo | header.bg_separator',
                        'upper-body' => 'upper_body.menu',
                        'sidebar' => 'sidebar.menu | sidebar.advertisement | sidebar.chat',
                        'footer' => 'footer.socials | footer.copyrights | footer.contacts | footer.special'),


    'home' => array( 'header' => 'header.top | header.logo | header.advanced_search',
                     'upper-body' => 'upper_body.latest_news | upper_body.menu | upper_body.offer',
                     'inner-body' => 'inner_body.advertisement | inner_body.slider | inner_body.special_offers'),


    'slider/show' => array('inner-body' => 'inner_body.one_slider'),


    'user/estates' => array('inner-body' => 'inner_body.all_estates'),


    'user/bookmarks' => array('inner-body' => 'inner_body.all_estates'),


    'estate/amer-group-specials' => array('inner-body' => 'inner_body.all_estates'),


    'estate/special-offers' => array('inner-body' => 'inner_body.all_estates'),


    'estate/all' => array('inner-body' => 'inner_body.all_estates'),


    'estate/show' => array('inner-body' => 'inner_body.one_estate'),


    'estate/upgrade' => array('inner-body' => 'inner_body.upgrade_estate'),


    'estate/edit' => array('inner-body' => 'inner_body.add_estate'),


    'estate/create' => array('inner-body' => 'inner_body.add_estate'),


    'news/all' => array('inner-body' => 'inner_body.all_news'),


    'news/show' => array('inner-body' => 'inner_body.one_news'),


    'login/show' => array('inner-body' => 'inner_body.login_register'),

    'register/forget-password' => array('inner-body' => 'inner_body.forget_password'),
    'register/change-password' => array('inner-body' => 'inner_body.change_password'),


    'contact-us' => array('inner-body' => 'inner_body.contact_us'),


    'search' => array('header' => 'header.top | header.logo | header.advanced_search',
                      'inner-body' => 'inner_body.all_estates'),


    'banner/request' => array('inner-body' => 'inner_body.request_banner'),


    'page' => array('inner-body' => 'inner_body.page'),


    'under-construction' => array('header' => 'header.top | header.n_logo | header.bg_separator',
                                  'upper-body' => 'inner_body.under_construction',
                                  'sidebar' => '',
                                  'inner-body' => '')

);