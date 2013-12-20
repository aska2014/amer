<?php

use Estate\Estate;
use Estate\EstateCategory;

return array(

    // Home page
    array('home', 'home.html'),

    // Slider show
    array('slider/show', 'slider-([0-9]+).html', Slider::getClass()),

    // User estates
    array('user/estates', 'user/estates.html'),
    array('user/bookmarks', 'user/bookmarks.html'),

    // Estates
    array('estate/all', 'estates-([0-9]+).html', EstateCategory::getClass()),
    array('estate/show', 'estate-([0-9]+).html', Estate::getClass()),

    array('estate/amer-group-specials', 'amer-group-specials.html'),

    // Estate operations
    array('estate/create', 'create-estate.html'),
    array('estate/edit', 'edit-estate/([0-9]+)', Estate::getClass()),
    array('estate/upgrade', 'upgrade-estate/([0-9]+)', Estate::getClass()),

    // News
    array('news/all', 'all-news.html'),
    array('news/show', 'news-([0-9]+).html', News::getClass()),

    // Login and register show
    array('login/show', 'login-register.html'),

    // Contact us page
    array('contact-us', 'contact-us.html'),

    // Advanced search
    array('search', 'search.html'),

    // Request banner
    array('banner/request', 'request-banner.html'),

    // Under construction page
    array('under-construction', 'under-construction.html')
);